    /**
     * Función para cargar y poder editar un evento
     * @returns {undefined}
     */
    function editRow(id){
        
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
                            if(key == "param_id"){
                                $("#"+key).val(obj[key]).trigger('change');
                            }  else {
                                $("#"+key).val(obj[key]);
                            }
                        }
                    }
                    
                    $("#botonCrear").prop("disabled",false);
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    function deleteRow(id){
        var url = $("#urlEditData").val();
        $.ajax({
                url: url,
                data: {idDelete : id},
                success: function (response) {
                    if(response != "1"){
                        alert(response);
                    }
                    $('#list-datos').DataTable().ajax.reload();
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
        
         var $inputs = $('#formulario  :input');
         $inputs.each(function ()
         {
             $(this).val("");
         });
         
         $("#msn").text("");
         $("#ts_id").val("");
         $("#pts_rol").val("");
    }

    /*
     * Función para crear un nuevo registro
     * @returns {undefined}
     */
    function nuevoRegistro(){
        
        event.preventDefault();
        var msn = "";
        
        $("#idParam").val($("#parametro").val());
        
        //Deshabilita el botón de guardar
        $("#botonCrear").prop("disabled",true);
        
        /*
         * Validaciones del formulario
         */
        if(validarLongitudMin("pts_suceso", 5)){
            msn = MIN_LENGHT_USU_NOMBRE;
        } else if(validarLongitudMax("pts_suceso", 90)){
            msn = MAX_LENGHT_USU_NOMBRE;
        } else if(validaCampoNoVacio("pts_suceso_valor")){
            msn = INGRESE_VALOR;
        } else if(validarListaSeleccionada("ts_id")){
            msn = SEL_TS;
        } else if(validarListaSeleccionada("pts_rol")){
            msn = ROL_NECESARIO;
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
