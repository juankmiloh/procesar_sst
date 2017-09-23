
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
                        if(key == "ctf_tipo_eliminacion"){
                            $("#"+key).val(obj[key]);
                            if(obj[key] == 1 ){
                                $("#elim_grupos_div").css('display','block');
                            } else {
                                $("#elim_grupos_div").css('display','none');
                            }
                        }
                        else if($("#"+key) != null){
                            $("#"+key).val(obj[key]);
                        }
                    }
                    
                    $("#botonCrear").prop("disabled",false);
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    
    /**
     * Limpia el formulario
     * @returns {undefined}
     */
    function cleanForm(){
        
         var $inputs = $('#formulario  :input');
         $inputs.each(function ()
         {
             $(this).val("");
         });
         
         $("#msn").text("");
         $("#ctf_ida_vuelta").val("").change();
         $("#ctf_tipo_eliminacion").val("").change();
    }
    
    function eliminarFase(idToDelete){
        var url = $("#urlEditData").val();
        $.ajax({
                url: url,
                data: {idToDelete : idToDelete},
                success: function (response) {
                    if(response == "true" || response == true){
                        $('#list-datos').DataTable().ajax.reload();
                    } else {
                        alert(ELIMINAR);
                    }
                },
                error: function (error, tx) {
                    alert(ELIMINAR_ERROR);
                    console.log(tx);
                }
        });
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
        if(validarLongitudMin("ctf_nombre", 5)){
            msn = FASE_NAME_MIN;
        } else if(validarLongitudMax("ctf_nombre", 80)){
            msn = FASE_NAME_MAX;
        } else if(validarListaSeleccionada("ctf_tipo_eliminacion")){
            msn = FASE_TIPO_ELIMINACION;
        } else if(validarListaSeleccionada("ctf_ida_vuelta")){
            msn = FASE_IDA_VUELTA;
        } 
        /**
         * Si el tipo de eliminación es por grupo, solicite los campos adicionales
         */
        else if($("#ctf_tipo_eliminacion").val() == 1){ 
            if(!$.isNumeric($("#ctf_cantidad_grupos").val())){
                msn = SEL_CANTIDAD_GRUPOS;
            } else if(!$.isNumeric($("#ctf_clasificados_grupo").val())){
                msn = SEL_CLASIFICADOS_POR_GRUPO;
            } else if($("#ctf_cantidad_grupos").val() < 1){
                msn = NUM_GRUPOS_POSITIVO;
            } else if($("#ctf_clasificados_grupo").val() < 1){
                msn = NUM_CLASIFICADOS_PSOITIVO;
            }
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
                            $("#msn").text(FASE_EXITO);
                        } else {
                            $("#msn").text(FASE_EXITO_EDITAR);
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
