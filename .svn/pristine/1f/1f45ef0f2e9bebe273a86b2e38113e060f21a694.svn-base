    var idEquipo; //PK del equipo
    var numEquipo; // 1 - equipo local, 2 - equipo visitante
    var faseTieneEncuentros; // FK fase_tiene_encuentros
    var deporte;
    /**
     * Abre el modal de resultados y carga las lista de jugadores. 
     * numEquipo: 1 equipo local, 2 equipo visitante
     */
    function openModal(idEqui, numEquip, fte, nombreEquipo, dpte){
        
        idEquipo = idEqui;
        numEquipo = numEquip;
        faseTieneEncuentros = fte;
        deporte = dpte;
        
        $("#nombreEquipo").text(nombreEquipo);
        $('#rol_p_id').val("");
        
        $.LoadingOverlay('show');
        //Limpia la tabla de resultados
        $("#goles_equipo").find("tr:gt(0)").remove();
        $('#dep_id').find('option').remove().end().append('<option value="">Seleccione</option>').val("").trigger('change');
        $('#pts_id').val("");
        $("#minuto").val("");
        $('#tiempo').val("");
        
//        $.ajax({
//            url: $("#urlConsultarJugadores").val(),
//            data: {id : idEquipo, rol : 0},
//            success: function (response) {
//                $("#dep_id").html(response);
                //Carga los resultados del encuentro,equipo
                $.ajax({
                    url: $("#urlConsultarSucesos").val(),
                    data: {idEquipo : idEqui, fte : faseTieneEncuentros, numEquipo : numEquipo},
                    success: function (response) {

                        var data = jQuery.parseJSON(response);

                        for(var i = 0; i < data.length; i++){
                            //Construye la tabla con los eventos existentes. 
                            var nombreDeportista = data[i]['nombre'];
                            var suceso = data[i]['pts_suceso'];
                            var minuto = data[i]['etr_minuto'];
                            var tiempo = data[i]['etr_tiempo'];

                            //Botón eliminar
                            var eliminar = '<span class="label label-danger" onclick="removeRow('+data[i]['etr_id']+');"><i class="icon-circle-with-cross"></i></span>'; 

                            $('#goles_equipo tr:last').after('<tr id="myTableRow'+data[i]['etr_id']+'"><td></td><td>'+nombreDeportista+'</td><td>'+suceso+'</td><td>'+minuto+'</td><td>'+tiempo+'</td><td>'+eliminar+'</td></tr>');

                        }
                        $.LoadingOverlay('hide');
                        $('#modalRegResul').modal('show');
                    },
                    error: function (error, tx) {
                            console.log(tx);
                            $.LoadingOverlay('hide');
                    }
                });
//            },
//            error: function (error, tx) {
//                    console.log(tx);
//            }
//        });
        
    }
    
    /**
     * Carga el archivo de resultados 
     */
    function cargarArchivoResultados(idFaseTieneEncuentros){
        
        var file_data = $('#sortpicture'+idFaseTieneEncuentros).prop('files')[0]; 
        
        if(file_data != undefined){
            var form_data = new FormData();                  
            form_data.append('file', file_data);

            var url = $("#urlArchivoResultados").val()+"&idFaseTieneEncuentros="+idFaseTieneEncuentros;

            $.ajax({
                        url: url, // point to server-side PHP script 
                        data: form_data,  
                        contentType:false,
                        cache: false,
                        processData:false,
                        type: 'POST',
                        success: function(php_script_response){
                            $("#check"+idFaseTieneEncuentros).prop("checked", true);
                            alert(php_script_response); // display response from the PHP script, if any
                        }
             });
         } else {
             alert("Debe seleccionar un archivo");
         }
    }
    
    function buscarJugadores(rol){
        $.LoadingOverlay('show');
        $.ajax({
            url: $("#urlConsultarJugadores").val(),
            data: {id : idEquipo, rol : rol},
            success: function (response) {
                $("#dep_id").html(response);

                //Despues de cargar los deportistas/entrenadores cargue los sucesos asociados a su rol... 
                if(rol != undefined && rol != ""){
                    $.ajax({
                        url: $("#urlConsultarSucesosRol").val(),
                        data: {deporte : deporte, rol : rol},
                        success: function (response) {
                            $("#pts_id").html(response);
                            $.LoadingOverlay('hide');
                        },
                        error: function (error, tx) {
                                console.log(tx);
                                $.LoadingOverlay('hide');
                        }
                    });
                } else {
                    $.LoadingOverlay('hide');
                }
            },
            error: function (error, tx) {
                    console.log(tx);
                    $.LoadingOverlay('hide');
            }
        });
    }
    
    function agregarJugadorGol(idEquipo, idFTE){
        
        if(validarListaSeleccionada("dep_id")){
            alert("Seleccione un deportista");
        } else if(validarListaSeleccionada("pts_id")){
            alert("Seleccione un suceso");
        } else if(!($("#minuto").val() > 0)){
            alert("Indique el minuto");
        }  else if(validarListaSeleccionada("tiempo")){
            alert("Seleccione el tiempo");
        } else {
            guardarResultado();
        }
    }
    
    /**
     * Guarda el resultado cargado
     * @returns {undefined}
     */
    function guardarResultado(deportista, suceso){
        
        var deportista = $('#dep_id').val();
        var suceso = $('#pts_id').val();
        
        $.ajax({
            url: $("#urlGuardarResultados").val(),
            data: {idEquipo : idEquipo,  numEquipo : numEquipo, idJugador : deportista,
                fte : faseTieneEncuentros, suceso : suceso, minuto : $("#minuto").val(), tiempo : $('#tiempo').val()},
            success: function (response) {
                    if(response >= 1){
                        
                        var nombreDeportista = $('#dep_id option:selected').text();
                        var suceso = $('#pts_id option:selected').text();
                        var minuto = $("#minuto").val();
                        var tiempo = $('#tiempo option:selected').text();

                        //Botón eliminar
                        var eliminar = '<span class="label label-danger" onclick="removeRow('+response+');"><i class="icon-circle-with-cross"></i></span>'; 

                        //Limpia las listas
                        $('#rol_p_id').val("");
                        $('#dep_id').html("");
                        $('#pts_id').html("");
                        $("#minuto").val("");
                        $('#tiempo').val("");

                        $('#goles_equipo tr:last').after('<tr id="myTableRow'+response+'"><td></td><td>'+nombreDeportista+'</td><td>'+suceso+'</td><td>'+minuto+'</td><td>'+tiempo+'</td><td>'+eliminar+'</td></tr>');
                        
                        updateMarcador();
                        
                    }  else {
                        alert("Ocurrio un error guardando el registro");
                    }
            },
            error: function (error, tx) {
                    console.log(tx);
                    removeRow(deportista);
            }
        });
        
    }
    
    /**
    * Consultamos como quedo el marcador de agregar el suceso
    */
    function updateMarcador(){
        $.ajax({
            url: $("#urlConsultarResultados").val(),
            data: {fte : faseTieneEncuentros},
            success: function (response) {
                var obj = jQuery.parseJSON( response );
                $("#equip1_"+faseTieneEncuentros).html(obj["tfs_gf_1"]);
                $("#equip2_"+faseTieneEncuentros).html(obj["tfs_gf_2"]);
            }, error: function (error, tx) {
                    console.log(tx);
            }
        });
    }
    
    /**
     * Elimina una fila de la tabla de goles y amonestaciones
     * @param {type} idJugador
     * @returns {undefined}
     */
    function removeRow(idSuceso){
        
        $.ajax({
            url: $("#urlEliminarSucesos").val(),
            data: {id : idSuceso},
            success: function (response) {
                    updateMarcador();
                    $('#myTableRow'+idSuceso).remove();
            },
            error: function (error, tx) {
                    console.log(error);
            }
        });
        
        
    }
    
    