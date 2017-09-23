    
    $('.click').click(function() {
        setTimeout(calcular,700);
    });
    
    /**
     * Función para cargar y poder editar un evento
     * @returns {undefined}
     */
    function editRow(id){
        
         //Esta linea remueve todo los roles asignados.... 
        $("#multiselect").html("");
        
        $("#crearEventoBtn").prop("disabled",true);
        $('#modalForm').modal();
        
        var url = $("#urlGuardar").val();
        
        var idPromocion = $("#idRegistro").val();
        
        $("#msnEvento").text("");
        $.ajax({
                //type: 'POST',
                url: url,
                data: {id : idPromocion},
                success: function (response) {
                    
                    /**
                     * Llena la lista con los equipos promocionados
                     */
                    var equipos = jQuery.parseJSON( response );
                    $("#asignadas").text("Sedes asignadas ("+equipos.length+")");
                    for(var i = 0; i < equipos.length; i++){
                        var html = "<option data-toggle='tooltip"+i+"' data-container='#tooltip_container' title='"+equipos[i]["prueb_nombre"]+"' value='"+equipos[i]['equi_id']+"'>"+equipos[i]['ent_nombre']+ " - " + equipos[i]['prueb_nombre']+"</option>";
                        $('#multiselect_to').append(html);
                        $('[data-toggle="tooltip'+i+'"]').tooltip();
                    }
                    
                    $("#crearEventoBtn").prop("disabled",false);
                    
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    function calcular(){
        $("#asignadas").text("Sedes asignadas ("+ $('#multiselect_to option').size() +")");
        $("#consultadas").text("Entidades ("+ $('#multiselect option').size() +")");
    }
    
    /**
    * Modifica el estado de la promoción. 
    * @returns {undefined}
    */
    function buscarPromociones(idPeriodo){
        
       var url = $("#urlConsultarEquipos").val();
       var dpto = $("#dpto_id").val();
       var muni = $("#muni_id").val();
       var fase = $("#tp_id").val();
       
        $("#msn").text("");
       
       if(fase == "" || fase == undefined){
            $("#msn").css('color', 'red');
            $("#msn").css('font-weight', 'bold');
            $("#msn").text("Seleccione la fase anterior");
       } else if(dpto == "" || dpto == undefined){
            $("#msn").css('color', 'red');
            $("#msn").css('font-weight', 'bold');
            $("#msn").text("Seleccione el departamento");
       } else {
           $.LoadingOverlay('show');
            $.ajax({
                    url: url,
                    data: {idPeriodo : idPeriodo, dpto : dpto, muni : muni,  fase : fase},
                    success: function (response) {
                         $("#multiselect").html(response);
                         var size = $('#multiselect option').size();
                         $("#consultadas").text("Entidades ("+size+")");
                         for(var i = 0; i < size; i++){
                             $('[data-toggle="tooltip'+i+'"]').tooltip();
                         }
                         $.LoadingOverlay('hide');
                    },
                    error: function (error, tx) {
                        $.LoadingOverlay('hide');
                        console.log(tx);
                    }
            });
        }
    }
  
    
    /**
     * Limpia el formulario de eventos
     * @returns {undefined}
     */
    function cleanForm(){
        
         var $inputs = $('#formulario  :input');
         $inputs.each(function ()
         {
             $(this).val("");
         });
         
        $("#dpto_id").val("").change();
        $("#muni_id").val("").change();
        
        $("#multiselect_to").html("");
        
         $("#msn").text("");
    }

    /*
     * Función para crear un nuevo registro
     * @returns {undefined}
     */
    function nuevoRegistro(idPromocion){
        
        $.LoadingOverlay('show');
        
        event.preventDefault();
        var msn = "";
        
        //Deshabilita el botón de guardar
        $("#botonCrear").prop("disabled",true);
        
        /*
         * Validaciones del formulario
         */
        if(validarListaMultipleSeleccionada("multiselect_to")){
            msn = ENTIDAD_SEL;
        }  
        
        
        if(msn != ""){ //SI hubo errores muestre las alertas
            $("#msn").css('color', 'red');
            $("#msn").css('font-weight', 'bold');
            $("#msn").text(msn);
            
            //Habilita el botón de guardar
            $("#botonCrear").prop("disabled",false);
            $.LoadingOverlay('hide');
            return;
        } else { //Si no hubo errores envie el formulario
            
            var data = $('select#multiselect_to').val();
            var url = $("#urlGuardar").val();
            var csrf = $("#csrf").val();
            var idRegistro = $("#idRegistro").val();

            $.ajax({
                url: url,
                data: {data : data, _csrf: csrf, idRegistro : idRegistro},
                type: 'POST',
                success: function (response) {
                    $.LoadingOverlay('hide');
                    if(response == true){
                        $("#msn").css('color', 'green');
                        $("#msn").css('font-weight', 'bold');
                        $("#msn").css('font-size', '22px');
                        
                        $("#msn").text(EQUPOS_PROMOCIONADOS);
                        
                        setTimeout(function(){
                            $('#list-datos').DataTable().ajax.reload();
                            $('#modalForm').modal("hide");
                            cleanForm();
                            $("#botonCrear").prop("disabled",false);
                        }, 1000);
                    } else {
                        $("#botonCrear").prop("disabled",false);
                        $("#msn").css('color', 'red');
                        $("#msn").css('font-weight', 'bold');
                        $("#msn").css('font-size', '22px');
                        $("#msn").text(response);
                    }
                },
                error: function (error, tx) {
                        $.LoadingOverlay('hide');
                        $("#msn").css('color', 'red');
                        $("#msn").css('font-weight', 'bold');
                        $("#msn").css('font-size', '22px');
                        $("#msn").text(ERROR);
                }
            });
        }
    }
   