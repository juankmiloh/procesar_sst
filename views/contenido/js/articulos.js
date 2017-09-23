    /**
     * Limpia los campos 
     */
    function cleanForm(){
         $('#editor1').val("");
         $("#eve_id").val("");
         $("#art_titulo").val("");
         $("#art_desc").val("");
         $("#art_resena").val("");
         $("#art_foto_ruta").val("");
         CKEDITOR.instances.editor1.setData("");
         $("#idRegistro").val("");
         $("#msn").text("");
    }

    /**
     * Edita una fila
     * @returns {undefined}
     */
    function editRow(id){
        
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
                            if(key == "art_contenido"){
                                CKEDITOR.instances.editor1.setData(obj[key]);
                            } else if(key == "art_foto_ruta"){
                                //
                            }  else {
                                if($("#"+key) != null){ 
                                    $("#"+key).val(obj[key]);
                                }
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
            data: {idDel : id},
            success: function (response) {
                $('#list-datos').DataTable().ajax.reload();
            },
            error: function (error, tx) {
                    console.log(error);
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
        
        var filename = $("#art_foto_ruta").val();
        var extension = filename.replace(/^.*\./, '');
        if (extension == filename) {
            extension = '';
        } else {
            extension = extension.toLowerCase();
        }
        
        
        /*
         * Validaciones del formulario
         */
        if(validarListaSeleccionada("eve_id")){
            msn = SEL_VAL;
        } else if(validaCampoNoVacio("art_titulo")){
            msn = CAMPO_VACIO;
        } else if(validarLongitudMax("art_titulo", 255)){
            msn = LONG_MAX;
        } else if(validaCampoNoVacio("art_desc")){
            msn = CAMPO_VACIO;
        } else if(validarLongitudMax("art_desc", 150)){
            msn = LONG_MAX;
        } else if(validaCampoNoVacio("art_resena")){
            msn = CAMPO_VACIO;
        } else if(validarLongitudMax("art_resena", 255)){
            msn = LONG_MAX;
        } else if(extension != "png" && extension != "jpg" && extension != "jpeg" && $("#idRegistro").val() == ""){
            msn = ARCHIVO_IMG;
            $("#art_foto_ruta").offset().top;
            $("#art_foto_ruta").focus();
        } else if(CKEDITOR.instances.editor1.getData().length <= 7){
            msn = "El contenido no puede estar vacio";
        } 

        
        
        if(msn != ""){ //SI hubo errores muestre las alertas
            $("#msn").css('color', 'red');
            $("#msn").css('font-weight', 'bold');
            $("#msn").text(msn);
            
            //Habilita el botón de guardar
            $("#botonCrear").prop("disabled",false);
            
            return;
        } else { //Si no hubo errores envie el formulario
            
            $("#art_contenido").val(CKEDITOR.instances.editor1.getData());
            
            var data = $("#formulario").serializeArray();
            var url = $("#urlEditData").val();
//            
//            var form_data = new FormData();   
//            
//            var file_data = $('#art_foto_ruta').prop('files')[0];   
//            //var form_data = $("#formulario");                  
//            data.append('file', file_data);

            var formData = new FormData();
            $(data).each(function (index, element) {
                formData.append(element.name, element.value);
            });
            
            var file_data = $('#art_foto_ruta').prop('files')[0];   
            formData.append('file', file_data);
            
            $.ajax({
                url: url,
                data: formData,
                contentType:false,
                cache: false,
                processData:false,
                type: 'POST',
                success: function (response) {
                    if(response == true){
                        $("#msn").css('color', 'green');
                        $("#msn").css('font-weight', 'bold');
                        $("#msn").css('font-size', '22px');
                        
                        if($("#idRegistro").val() == ""){
                            $("#msn").text(REGISTRO_EXITO);
                        } else {
                            $("#msn").text(ENLACE_EXITO_EDICION);
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