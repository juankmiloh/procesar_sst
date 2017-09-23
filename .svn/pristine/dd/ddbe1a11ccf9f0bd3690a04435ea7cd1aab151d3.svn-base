
    /**
     * Función para cargar y poder editar un evento
     * @returns {undefined}
     */
    function editRow(id){
        
         //Esta linea remueve todo los roles asignados.... 
        document.getElementById("multiselect_leftAll").click(); 
        
        $("#botonCrear").prop("disabled",true);
        $("#prueb_id").prop("disabled",true);
        $("#eve_id").prop("disabled",true);
        
        
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
                            if(key == "eve_id"){
                                $("#"+key).val(obj[key]).trigger('change');
                            } else if(key == "tipo_deporte_id"){
                                $("#"+key).val(obj[key]).change();
                            }  else if( key == "dep_id"){
                                //Se agrega un delay para que se logre cargar los deportes
                                var tempkey = key;
                                setTimeout(function(){ 
                                    $("#"+tempkey).val(obj[tempkey]).change();
                                }, 1000);
                            }  else if( key == "prueb_id"){
                                //Se agrega un delay para que se logre cargar los deportes
                                var tempPrueba = key;
                                setTimeout(function(){ 
                                    $("#"+tempPrueba).val(obj[tempPrueba]).change();
                                }, 2000);
                            }  else {
                                $("#"+key).val(obj[key]);
                            }
                        }
                    }
                    
                    /**
                     * Llena la lista con los escenarios del campeonato
                     */
                    var escenario = obj[0];
                    for(var i = 0; i < escenario.length; i++){
                        $('#multiselect_to').append($('<option>', {
                            value: escenario[i]['esc_id'],
                            text: $("#multiselect option[value='"+escenario[i]['esc_id']+"']").text()
                        }));
                        $("#multiselect option[value='"+escenario[i]['esc_id']+"']").remove();
                    }
                    
                    $("#botonCrear").prop("disabled",false);
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    /**
     * Consulta las fechas de un evento seleccionado
     */
    function getDatesFromEvent(idEvento){
        var url = $("#urlEventoFechas").val();
        $.ajax({
                url: url,
                data: {idEvento : idEvento},
                success: function (response) {
                    var obj = jQuery.parseJSON( response );
                    var fechaInicio = obj['eve_fecha_ini'].split("-");
                    var fechaFin = obj['eve_fecha_fin'].split("-");
                    
                    $('#camp_fecha_inicio').datepicker('setStartDate', new Date(fechaInicio[0],fechaInicio[1]-1, fechaInicio[2]));
                    $('#camp_fecha_inicio').datepicker('setEndDate', new Date(fechaFin[0],fechaFin[1]-1, fechaFin[2]));
                    
                    $('#camp_fecha_fin').datepicker('setStartDate', new Date(fechaInicio[0],fechaInicio[1]-1, fechaInicio[2]));
                    $('#camp_fecha_fin').datepicker('setEndDate', new Date(fechaFin[0],fechaFin[1]-1, fechaFin[2]));
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    /**
     * Cambia el estado del registro 
     * @returns {undefined}
     */
    function cambiarEstado(idRegistro, estado){
        var url = $("#urlEditData").val();
        $.ajax({
                url: url,
                data: {idCampeonato : idRegistro, estado : estado},
                success: function (response) {
                    $('#list-datos').DataTable().ajax.reload();
                    
                },
                error: function (error, tx) {
                        console.log(tx);
                }
        });
    }
    
    function listarFases(id){
        var url = $("#listarFases").val();
        window.location.href = url+"&idCamp="+id;
    }
    
    
    /**
     * Limpia el formulario de eventos
     * @returns {undefined}
     */
    function cleanForm(){
        
         //Esta linea remueve todo los roles asignados.... 
        document.getElementById("multiselect_leftAll").click();
        
         $("#msn").text("");
         $("#eve_id").val("").change();
         $("#cat_id").val("").change();
         $("#tipo_deporte_id").val("").change();
         $("#dep_id").html("");
         $("#prueb_id").html("");
         
         $("#prueb_id").prop("disabled",false);
         $("#eve_id").prop("disabled",false);
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
             $( "#eve_id" ).focus();
            msn = EVENTO_SEL;
        } else if(validarListaSeleccionada("tipo_deporte_id")){
            $( "#tipo_deporte_id" ).focus();
            msn = TIPO_DEPORTE_SEL;
        }  else if(validarListaSeleccionada("genero_id")){
            $( "#genero_id" ).focus();
            msn = GENERO_SEL;
        } else if(validarListaSeleccionada("cat_id")){
            $( "#cat_id" ).focus();
            msn = CATEGORIA_SEL;
        } else if(validarListaSeleccionada("prueb_id")){
            $( "#prueb_id" ).focus();
            msn = PRUEBA_SEL;
        } else if(validarFechaNoVacia("camp_fecha_inicio")){
            $( "#camp_fecha_inicio" ).focus();
            msn = FECHA_INICIO;
        } else if(validarFechaNoVacia("camp_fecha_fin")){
            $( "#camp_fecha_fin" ).focus();
            msn = FECHA_FIN;
        } else if(validarListaMultipleSeleccionada("multiselect_to")){
            $( "#multiselect_to" ).focus();
            msn = ESCENARIOS_SEL;
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
            
            data += "&dep_id="+$("#dep_id").val();

            $.ajax({
                url: url,
                data: data,
                success: function (response) {
                    if(response == true){
                        $("#msn").css('color', 'green');
                        $("#msn").css('font-weight', 'bold');
                        $("#msn").css('font-size', '22px');
                        
                        if($("#idRegistro").val() == ""){
                            $("#msn").text(CAMPEONATO_EXITO);
                        } else {
                            $("#msn").text(CAMPEONATO_EXITO_EDITAR);
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
