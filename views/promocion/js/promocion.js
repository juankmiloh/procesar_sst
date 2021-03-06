
    /**
     * Función para cargar y poder editar un evento
     * NO se permite cambiar el periodo de inscripciones, porque si lo hace cuando ya vamos en campeonatos, fases, resultados 
     * afecta todo. 
     * @returns {undefined}
     */
    function editRow(id){
        $("#title").html(EDITAR_PROMOCION);
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
                    for (var key in obj) {
                        if($("#"+key) != null){
                            $("#"+key).val(obj[key]);
                        }
                    }
                    $( "#pi_id" ).prop( "disabled", true );
                    $("#botonCrear").prop("disabled",false);
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    /**
     * Modifica el estado de la promoción. 
     * @returns {undefined}
     */
    function cambiarEstado(idRegistro, estado){
        var url = $("#urlEditData").val();
        $.ajax({
                url: url,
                data: {idPromocion : idRegistro, estado : estado},
                success: function (response) {
                    $('#list-datos').DataTable().ajax.reload();
                    
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    /**
     * Redirecciona a la vista de ver equipos promocionados
     * @returns {undefined}
     */
    function verpromocionados(idPromocion){
         var url = $("#urlVerPrmocionados").val();
         window.location.href = url+"&idPromocion="+idPromocion;
    }
    
    /**
     * Limpia el formulario de eventos
     * @returns {undefined}
     */
    function cleanForm(){
        
        $("#title").html(CREAR_PROMOCION);
        
         var $inputs = $('#formulario  :input');
         $inputs.each(function ()
         {
             $(this).val("");
         });
         $( "#pi_id" ).prop( "disabled", false );
         $("#msn").text("");
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
        if(validarLongitudMin("prom_nombre", 5)){
            msn = PROMOCION_NOMBRE_MIN;
        } else if(validarLongitudMax("prom_nombre", 80)){
            msn = PROMOCION_NOMBRE_MAX;
        } else if(validarListaSeleccionada("tipo_fase_id")){
            msn = PROMOCION_FASE;
        } else if (validarListaSeleccionada("pi_id")){
            msn = PROMOCION_PI;
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
                            $("#msn").text(PROMOCION_EXITO);
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
