
    /**
     * Función para cargar y poder editar un evento
     * @returns {undefined}
     */
    function editRow(id){
        
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
                    $("#nombre_menu").val(obj['menu_nombre']);
                    $("#detalle_menu").val(obj['menu_descripcion']);
                    $("#estado").val(obj['menu_estado']);
                    
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
        if(validarLongitudMax("nombre_menu", 25)){
            msn = MAX_LENGHT_MENU_NOMBRE;
        } else if (validarLongitudMin("nombre_menu", 5)){
            msn = MIN_LENGHT_MENU_NOMBRE;
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
                url: url,
                data: data,
                success: function (response) {
                    if(response == true){
                        $("#msnResultado").css('color', 'green');
                        $("#msnResultado").css('font-weight', 'bold');
                        $("#msnResultado").css('font-size', '22px');
                        
                        if($("#idRegistro").val() == ""){
                            $("#msnResultado").text(MENU_EXITO);
                        } else {
                            $("#msnResultado").text(MENU_EXITO_EDICION);
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
