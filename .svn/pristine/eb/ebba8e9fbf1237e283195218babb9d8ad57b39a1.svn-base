
    /**
     * Función para cargar y poder editar un evento
     * @returns {undefined}
     */
    function editRow(id){
        

        //Esta linea remueve todo los roles asignados.... 
        document.getElementById("multiselect_leftAll").click();
        
        $("#botonCrear").prop("disabled",true);
        $('#modal-registro').modal();
        var url = $("#urlEditar").val();
        $("#idRegistro").val(id);
        $("#msnResultado").text("");
        $.ajax({
                url: url,
                data: {id : id},
                success: function (response) {
                    var obj = jQuery.parseJSON( response );
                    $("#nombre_usuario").val(obj['usu_nombres']);
                    $("#apellido_usuario").val(obj['usu_apellidos']);
                    $("#tipo_doc").val(obj['usu_tipo_doc']);
                    $("#documento_usuario").val(obj['usu_num_doc']);
                    $("#correo").val(obj['usu_correo']);
                    $("#estado").val(obj['usu_estado']);
                    
                    //Contraseña falsa
                    $("#pass1_usuario").val("*************");
                    $("#pass2_usuario").val("*************");
                    
                    $("#pass1_usuario").prop('disabled', true);
                    $("#pass2_usuario").prop('disabled', true);
                    
                    
                    /**
                     * Llena la lista con los roles del usuario
                     * @type Object|
                     */
                    var roles = obj[0];
                    for(var i = 0; i < roles.length; i++){
                        $('#multiselect_to').append($('<option>', {
                            value: roles[i]['rol_id'],
                            text: $("#multiselect option[value='"+roles[i]['rol_id']+"']").text()
                        }));
                        $("#multiselect option[value='"+roles[i]['rol_id']+"']").remove();
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
        
        
         var $inputs = $('#formulario  :input');
         $inputs.each(function ()
         {
             $(this).val("");
         });
         
         $("#msnResultado").text("");
         
         //Borrados personalizados del formulario
         document.getElementById("multiselect_leftAll").click(); 
         $("#pass1_usuario").prop('disabled', false);
         $("#pass2_usuario").prop('disabled', false);
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
        if(validarLongitudMax("nombre_usuario", 55)){
            msn = MAX_LENGHT_USU_NOMBRE;
        } else if (validarLongitudMin("nombre_usuario", 3)){
            msn = MIN_LENGHT_USU_NOMBRE;
        } else if(validarLongitudMax("apellido_usuario", 55)){
            msn = MAX_LENGHT_USU_APELLIDO;
        } else if (validarLongitudMin("apellido_usuario", 3)){
            msn = MIN_LENGHT_USU_APELLIDO;
        }  else if(validarListaSeleccionada("tipo_doc")){
            msn = TIPO_DOC_USU;
        } else if(validarLongitudMax("documento_usuario", 15)){
            msn = MAX_LENGHT_DOC_USU;
        } else if (validarLongitudMin("documento_usuario", 7)){
            msn = MIN_LENGHT_DOC_USU;
        } else if(validarListaMultipleSeleccionada("multiselect_to")){
            msn = ROLES_USU;
        } else if (validarLongitudMin("pass1_usuario", 8)){
            msn = CONTRASENA;
        } else if($("#pass1_usuario").val() != $("#pass2_usuario").val()){
            msn = CONTRASENA_CONFI;
        }
        
        
        if(msn != ""){ //SI hubo errores muestre las alertas
            $("#msnResultado").css('color', 'red');
            $("#msnResultado").css('font-weight', 'bold');
            $("#msnResultado").text(msn);
            
            //Habilita el botón de guardar
            $("#botonCrear").prop("disabled",false);
            
            return;
        } else { //Si no hubo errores envie el formulario
            
            var data = $("#formulario").serialize();
            var url = $("#urlCrear").val();

            $.ajax({
                //type: 'POST',
                url: url,
                data: data,
                success: function (response) {
                    if(response == true){
                        $("#msnResultado").css('color', 'green');
                        $("#msnResultado").css('font-weight', 'bold');
                        $("#msnResultado").css('font-size', '22px');
                        
                        if($("#idRegistro").val() == ""){
                            $("#msnResultado").text(USU_EXITO);
                        } else {
                            $("#msnResultado").text(USU_EXITO_EDICION);
                        }
                        
                        setTimeout(function(){
                            $('#list-registros').DataTable().ajax.reload();
                            $('#modal-registro').modal("hide");
                            cleanForm();
                            $("#botonCrear").prop("disabled",false);
                        }, 1000);
                    } else {
                        $("#botonCrear").prop("disabled",false);
                        $("#msnResultado").css('color', 'red');
                        $("#msnResultado").css('font-weight', 'bold');
                        $("#msnResultado").css('font-size', '22px');
                        $("#msnResultado").text(response);
                    }
                },
                error: function (error, tx) {
                        $("#msnResultado").css('color', 'red');
                        $("#msnResultado").css('font-weight', 'bold');
                        $("#msnResultado").css('font-size', '22px');
                        $("#msnResultado").text(ERROR);
                }
            });
        }
    }
