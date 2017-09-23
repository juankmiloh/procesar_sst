
    /**
     * Función para cargar y poder editar un evento
     * @returns {undefined}
     */
    function editRow(id){
        
         //Esta linea remueve todo los campeonatos asignados.... 
        document.getElementById("multiselect_leftAll").click(); 
        $('#multiselect').find('option').remove();
        
        $("#botonCrear").prop("disabled",true);
        $('#modalForm').modal();
        var url = $("#urlEditData").val();
        $("#idRegistro").val(id);
        $("#msn").text("");
        $.ajax({
                url: url,
                data: {id : id},
                success: function (response) {
                    var obj = jQuery.parseJSON( response );
                    $("#usu_id").val(obj['usu_id']).trigger('change');
                    $("#eve_id").val(obj[0]['eve_id']).trigger('change');
                    
                    /**
                     * Llena la lista con los campeonatos del usuario
                     */
                    var campeonatos = obj[1];
                    for(var i = 0; i < campeonatos.length; i++){
                        $('#multiselect_to').append($('<option>', {
                            value: campeonatos[i]['camp_id'],
                            text: campeonatos[i]['camp_nombre']
                        }));
                    }
                    
                    $("#botonCrear").prop("disabled",false);
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    /**
     * Limpia el formulario de eventos
     * @returns {undefined}
     */
    function cleanForm(){
        
         //Esta linea remueve todo los campeonatos asignados.... 
        document.getElementById("multiselect_leftAll").click();
        $('#multiselect').find('option').remove();
        
         var $inputs = $('#formulario  :input');
         $inputs.each(function ()
         {
             $(this).val("");
         });
         
         $("#msn").text("");
         $("#usu_id").val("").change();
         $("#eve_id").val("").change();
         $("#dep_id").val("").change();
    }

    /*
     * Función para crear un nuevo registro
     * @returns {undefined}
     */
    function nuevoRegistro(){
        
        event.preventDefault();
        var msn = "";
        
        //Deshabilita el botón de guardar
        $("#botonCrear").prop("disabled",true);
        
        /*
         * Validaciones del formulario
         */
         if(validarListaSeleccionada("eve_id")){
            msn = EVENTO_SEL;
        } else if(validarListaSeleccionada("dep_id")){
            msn = DEPORTE_SEL;
        } else if(validarListaSeleccionada("usu_id")){
            msn = SELEC_USUARIO;
        } else if(validarListaMultipleSeleccionada("multiselect_to")){
            msn = SELEC_CAMPEONATOS;
        }
        
        
        if(msn != ""){ //SI hubo errores muestre las alertas
            $("#msn").css('color', 'red');
            $("#msn").css('font-weight', 'bold');
            $("#msn").text(msn);
            
            //Habilita el botón de guardar
            $("#botonCrear").prop("disabled",false);
            
            return;
        } else { //Si no hubo errores envie el formulario
            
            var data = $("#formulario").serialize();
            var url = $("#urlEditData").val();

            $.ajax({
                url: url,
                data: data,
                success: function (response) {
                    if(response == true){
                        $("#msn").css('color', 'green');
                        $("#msn").css('font-weight', 'bold');
                        $("#msn").css('font-size', '22px');
                        
                        if($("#idRegistro").val() == ""){
                            $("#msn").text(REGISTRO_EXITO);
                        } else {
                            $("#msn").text(REGISTRO_EXITO_EDICION);
                        }
                        
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
                        $("#msn").css('color', 'red');
                        $("#msn").css('font-weight', 'bold');
                        $("#msn").css('font-size', '22px');
                        $("#msn").text(ERROR);
                }
            });
        }
    }
