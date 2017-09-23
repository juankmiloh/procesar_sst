
    /**
     * Función para cargar y poder editar un evento
     * @returns {undefined}
     */
    function editRow(id){
        
        alert("Operación no permitida");
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
         
         $("#msn").text("");
         $("#dpto_id").val("").change();
         $("#muni_id").html("");
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
        if(validarLongitudMax("sede_nombre", 80)){
            msn = SEDE_NAME_MAX;
        } else if (validarLongitudMin("sede_nombre", 5)){
            msn = SEDE_NAME_MIN;
        } else if(validarListaSeleccionada("dpto_id")){
            msn = DPTO_SEL;
        } else if(validarListaSeleccionada("muni_id")){
            msn = MUNI_SEL;
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
                            $("#msn").text(SEDE_EXITO);
                        } else {
                            $("#msn").text(SEDE_EXITO_EDIT);
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
