$(document).ready(function(){  
 
    // Limpiar alertas al seleccionar un input 
    $("input, select, .selectpicker, textarea").click(function(){     
        $("input").css("border-color","");
        $("textarea").css("border-color","");
        $("select").css("border-color","");
        $(".selectpicker").selectpicker('setStyle','btn-danger', 'remove');
        $(".selectpicker").selectpicker('setStyle','btn-default');
        $("p").text(""); 
    });
});

/*
 *  Limpia el modal de editar escenario cada vez que es abierto
 */
function cleanModalEditarEscenario(){
    $("#nombre_esc").val("");
    $("#direccion_esc").val("");
    $("#observaciones_esc").val("");
    $("#nombre_ce").val("");
    $("#apellidos_ce").val("");
    $("#telefono_ce").val("");
    $("#celular_ce").val("");
    $("#mmail").val("");
    $("#msnFechasValidar").text("");    
    $("#div-add-contact").css('display','none');
    $("#btn-loc").css('display','none');
    $("#btn-save").prop('disabled', true);
    $("#select-depor").prop('disabled', true);
    $("#ciud").text("");
    $("#depto").text("");
    $("#deporte-escenario").html("");
    $(".cuerpo-diss").html("");
    $(".city").html("<select class='form-control' disabled><option>"+CIUDAD+"</option></select>");
    $("#depar").val("");
    $("#select-depor").val("");
    $("#msnLocacionEditar").text("");
    $("#fecha-inic").val("");
    $("#fecha-fina").val("");
    $("#horario").selectpicker('deselectAll');
    $("#add_disp").css("display", "none");
    $("input").css("border-color","");
    $("select").css("border-color","");
    $("#horario").selectpicker('setStyle', 'btn-danger','remove');
    $("#horario").selectpicker('setStyle', 'btn-default');
    $("#msnModifEscenario").text("");
    $("#msnNuevoContacto").text("");
    $("#foto").text("");
    $("#nueva-foto").val("");
}

/**
 * Limpia el formulario creación de escenarios
 * @returns {undefined}
 */
function cleanEscenario(){
    //Limpiar campos 
    $("#esc_nombre").val("");
    $("#esc_direccion").val("");
    $("#depa").val("");    
    $("#depor").val("");
    $("#ce_nombre").val("");
    $("#ce_apellidos").val("");
    $("#ce_telefono").val("");
    $("#ce_celular").val("");
    $("#email").val("");
    $(".cuerpo-dis").text("");
    $(".ciudad").html("<select class='form-control' disabled><option>"+SELECCIONE+"</option></select>");    
    $("#msnNuevoEscenario").text("");    
    $("#message-texta").val("");
    $("#fecha-ini").val("");
    $("#fecha-fin").val("");
    $("#horas").selectpicker('deselectAll');
    $("input").css("border-color","");
    $("select").css("border-color","");
    $("#msnFechasValidar1").text("");
    $("#horas").selectpicker('setStyle', 'btn-danger','remove');
    $("#horas").selectpicker('setStyle', 'btn-default');
    $("#deport").selectpicker('setStyle', 'btn-danger','remove');
    $("#deport").selectpicker('setStyle', 'btn-default');
    $("#deport").selectpicker('deselectAll');
    $("#foto-escenario").val("");
}

/**
 *  Muestra el escenario seleccionado con sus características
 *  parámetro: id Escenario
 */
function editRow(id){   
    cleanModalEditarEscenario(); 
    $('#modalVerEscenario').modal();         
    $.ajax({
        url: $("#urlModalEditar").val(),
        data: "id="+id,
        success:function(response){                
            $("#btn-save").prop('disabled', false); 
            $("#select-depor").prop('disabled', false);
            $("#btn-loc").css('display','block');   
            $("#add_disp").css("display", "block"); 
            var obj = jQuery.parseJSON( response ); 
            $("#idEscenario").val(obj['escenario']['esc_id']);  
            $("#nombre_esc").val(obj['escenario']['esc_nombre']);
            $("#direccion_esc").val(obj['escenario']['esc_direccion']);
            $("#observaciones_esc").val(obj['escenario']['esc_observaciones']);
            $("#ciud").text(obj['ciudad']['municipios_name']);
            $("#depto").text(obj['depto']['dptos_name']);
            if(obj['contacto'] != null){
                $("#id_contact").val(obj['contacto']['ce_id']);
                $("#nombre_ce").val(obj['contacto']['ce_nombre']);
                $("#apellidos_ce").val(obj['contacto']['ce_apellidos']);
                $("#telefono_ce").val(obj['contacto']['ce_telefono']);
                $("#celular_ce").val(obj['contacto']['ce_celular']);
                $("#mmail").val(obj['contacto']['ce_email']);   
                $("#verificador").val("1");                 
            }else{                
                $("#verificador").val("0");
                $("#div-add-contact").css('display','block');
            }               
            var foto = "";
            var clase = "";
            var title = "";            
            if(obj['escenario']['esc_foto_ruta'] != null){
                foto = obj['escenario']['esc_foto_ruta'].substring(1);
                clase = "foto-esc";
                title = CLICK_VER_IMAGEN;
            }else{
                foto = "uploads/escenarios/no_disp.jpg";
            }            
            $("#foto").html("<img class='"+clase+"' src='"+foto+"' title='"+title+"'>");  
            var num = 0;   
            var view = ""; 
            while(obj['dep'+num] != null){                
                view += "<tr id='fila"+obj['dep'+num]['dep_id']+"'>"+
                            "<td><label>"+obj['dep'+num]['dep_nombre']+"</label></td>"+
                            "<td>"+                                            
                                "<span id='"+obj['dep'+num]['dep_id']+"' class='btn btn-danger btn-xs' onclick='borrarDeporteEscenario(this.id,"+obj['escenario']['esc_id']+");'>"+
                                    "<span class='icon-circle-with-cross'></span>"+
                                "</span>"+
                            "</td>"+
                        "</tr>";
                num++;
            } 
            num = 0; 
            var num1 = 0;       
            $("#deporte-escenario").html(view);
            view = "";
            while(obj['disp'+num] != null){
                view +="<tr class='fil-disp'>"+
                            "<th scope='row'>"+(num+1)+"</th>"+
                            "<td>"+
                                "<div class='input-group'>"+
                                    "<input id='fi"+obj['disp'+num]['de_id']+"' class='form-control fecha' type=text value='"+obj['disp'+num]['de_fecha_ini']+"' readonly>"+
                                    "<span class='input-group-addon'>"+
                                        "<span class='icon-calendar'></span>"+
                                    "</span>"+
                                "</div>"+
                            "</td>"+
                            "<td>"+
                                "<div class='input-group'>"+
                                    "<input id='ff"+obj['disp'+num]['de_id']+"' class='form-control fecha' type=text value='"+obj['disp'+num]['de_fecha_fin']+"' readonly>"+
                                    "<span class='input-group-addon'>"+
                                        "<span class='icon-calendar'></span>"+
                                    "</span>"+
                                "</div>"+
                            "</td>"+
                            "<td>"+
                                "<select id='sel"+obj['disp'+num]['de_id']+"' class='selectpicker sel' multiple multiple title='"+SELECCIONE+"'>";
                var num2 = 0;
                while(obj['horas'+num2] != null){
                    view += "<option id='"+obj['disp'+num]['de_id']+"hor"+obj['horas'+num2]['hor_id']+"' value='"+obj['horas'+num2]['hor_id']+"' ";
                    while(obj['disTiHo'+num+''+num1] != null){
                        if(obj['horas'+num2]['hor_id'] == obj['disTiHo'+num+''+num1]['hor_id']){
                            view += "selected";
                        }                        
                        num1++;                    
                    } 
                    num1 = 0;
                    view +=">"+obj['horas'+num2]['hor_nombre_12_horas']+"</option>";                   
                    num2++;
                }                
                view+=          "</select>"+
                            "</td>"+
                            "<td>"+
                                "<table><tr>"+
                                    "<td>"+
                                        "<span id='modif"+obj['disp'+num]['de_id']+"'  class='btn btn-success btn-xs' onclick='modificarFecha(this.id,"+obj['disp'+num]['esc_id']+");'>"+
                                            "<span class='icon-cached'></span>"+
                                        "</span>"+
                                    "</td><td>&nbsp;</td><td>"+
                                        "<span id='bor"+obj['disp'+num]['de_id']+"' class='btn btn-danger btn-xs' onclick='borrarFecha(this.id,"+obj['disp'+num]['esc_id']+");'>"+
                                            "<span class='icon-circle-with-cross'></span>"+
                                        "</span>"+
                                    "</td>"+
                                "</tr></table>"+
                            "</td>"+
                        "</tr>";
                num++;
            }
            $(".cuerpo-diss").html(view);
            $(".fecha").datepicker({
                format:'yyyy-mm-dd',
                autoclose: true,
                todayBtn: 'linked',
                changeMonth: true,
                changeYear: true,
                startDate: new Date()
            });            
            $(".selector").selectpicker(); 
            $(".sel").selectpicker();                             
        }        
    });    
}

/*
 *  Modificación de un registro de la fecha de disponibilidad
 *  parámetro: idDis disponibilidad, idEsc escenario
 */
function modificarFecha(idDis,idEsc){
    var idDis = idDis.replace("modif","");
    var fechaIni = $("#fi"+idDis).val();
    var fechaFin = $("#ff"+idDis).val();    
    var hora = "";
    for(var i = 1; i <= 24; i++){
        if($("#"+idDis+"hor"+i).is(":selected")){
            hora+="&h"+i+"="+$("#"+idDis+"hor"+i).val();             
        }
    }        
    var data = "idDis="+idDis+"&idEsc="+idEsc+"&fi="+fechaIni+"&ff="+fechaFin;
    var url = $("#urlModifDisp").val();
    data = data+hora;
    if(idEsc == 0){
        if(!validarFormDisponibilidad('fi'+idDis,'ff'+idDis,'sel'+idDis,'msnFechasValidar1')){
            return false;
        }
        if(verificarFecha(fechaIni, fechaFin, idEsc, hora,idDis, "msnFechasValidar1") == 0){            
            return false;                     
        }
        $(".cuerpo-dis").text(ACTUALIZANDO);
    }else{
        if(!validarFormDisponibilidad('fi'+idDis,'ff'+idDis,'sel'+idDis,'msnFechasValidar')){
            return false;
        }
        if(verificarFecha(fechaIni, fechaFin, idEsc, hora,idDis, "msnFechasValidar") == 0){            
            return false;                     
        }
        $(".cuerpo-diss").text(ACTUALIZANDO);
    }
    $.ajax({
        url: url, 
        data: data, 
        success:function(response){                     
            response = JSON.parse(response);
            if(idEsc == 0){
                $(".cuerpo-dis").html(response);    
            }else{
                $(".cuerpo-diss").html(response);
            } 
            $(".fecha").datepicker({
                todayBtn: 'linked',
                changeMonth: true,
                changeYear: true,
                format:'yyyy-mm-dd',
                startDate: new Date()
            });
            $(".sel").selectpicker();            
        }
    });   
}

/*
 *  Se borra un registro de fecha de la disponibilidad
 *  parámetro: idDis a borrar, idEsc escenario
 */
function borrarFecha(idDis, idEsc){
    var idDis = idDis.replace("bor","");
    var url = $("#urlBorrarDisp").val();    
    if(idEsc == 0){
        $(".cuerpo-dis").text(ACTUALIZANDO);
    }else{
        $(".cuerpo-diss").text(ACTUALIZANDO);
    }    
    $.ajax({
        url: url,
        data: "idDis="+idDis+"&idEsc="+idEsc,
        success:function(response){
            response = JSON.parse(response);
            if(idEsc == 0){
                $(".cuerpo-dis").html(response);    
            }else{
                $(".cuerpo-diss").html(response);
            }            
            $(".fecha").datepicker({
                todayBtn: 'linked',
                changeMonth: true,
                changeYear: true,
                format:'yyyy-mm-dd',                 
                startDate: new Date()
            });
            $(".sel").selectpicker();
            setTimeout(function(){
                $("#msnDispMinima").text("");
                $("#msj-u").remove();
            },2000);
        }
    });
}

/*
 *  Se agrega una nueva fecha para la disponibilidad 
 *  parámetro: id del escenario
 */
function agregarFecha(id){    
    if(id == 0){
        var fechaIni = $("#fecha-ini").val();
        var fechaFin = $("#fecha-fin").val();
        var hora = "";
        var hSelect = false;
        for(var i = 1; i <= 24; i++){
            if($("#hor"+i).is(":selected")){
                hora += "&h"+i+"="+$("#hor"+i).val();
            }
        }
        if(!validarFormDisponibilidad('fecha-ini','fecha-fin', 'horas','msnFechasValidar1')){
            return false;
        }                
        if(verificarFecha(fechaIni, fechaFin, id, hora,0, "msnFechasValidar1") == 0){            
            return false;                     
        }                
        $(".cuerpo-dis").text(ACTUALIZANDO);             
    }else{
        var fechaIni = $("#fecha-inic").val();
        var fechaFin = $("#fecha-fina").val();
        var hora = "";
        for(var i = 1; i <= 24; i++){
            if($("#ho"+i).is(":selected")){
                hora += "&h"+i+"="+$("#ho"+i).val();
            }
        } 
        if(!validarFormDisponibilidad('fecha-inic','fecha-fina','horario','msnFechasValidar')){
            return false;
        } 
        if(verificarFecha(fechaIni, fechaFin, id, hora,0, "msnFechasValidar") == 0){            
            return false;
        }                             
        $(".cuerpo-diss").text(ACTUALIZANDO); 
    }     
    data = "idEsc="+id+"&fi="+fechaIni+"&ff="+fechaFin+hora;       
    $.ajax({
        url:$("#urlNuevaDisponibilidad").val(),
        data:data,
        success:function(response){            
            response = JSON.parse(response);  
            if(id == 0){
                $(".cuerpo-dis").html(response);
                $("#fecha-fin").val("").datepicker('refresh');
                $("#fecha-ini").val("").datepicker('refresh')              
            }else{
                $(".cuerpo-diss").html(response);
                $("#fecha-inic").val("").datepicker('refresh');
                $("#fecha-fina").val("").datepicker('refresh');
            }                                              
            $(".fecha").datepicker({
                todayBtn: 'linked',
                changeMonth: true,
                changeYear: true,
                format:'yyyy-mm-dd',
                autoclose: true,
                startDate: new Date()
            });
            $(".sel").selectpicker();     
            $(".selector").selectpicker('deselectAll');
        }
    });
}

/*
 *  Valida la agregación de una nueva disponibilidad
 *  parámetros: fecha inicio, fecha fin, lista horas, idMensaje
 */
function validarFormDisponibilidad(fechaInicio,fechaFin,horas,idMensaje){
    var msn = "";
    if(validarLongitudMin(fechaInicio,1) ){        
        msn = FECHA_INICIO_DISPONIBILIDAD;
    }else if(validarLongitudMin(fechaFin,1)){
        msn = FECHA_FIN_DISPONIBILIDAD;
    }else if(validarFechaFinalMayor(fechaInicio,fechaFin)){
        msn = FECHA_INICIAL_FECHA_FINAL_VALIDACION;
    }else if(validaSelect(horas)){
        msn = HORARIO_NO_SELECCIONADO;
    }   

    if(msn != ""){        
        $("#"+idMensaje).css('font-weight','bold');
        $("#"+idMensaje).css('color','red');
        $("#"+idMensaje).text(msn);
        return false;
    }else{
        $("#"+idMensaje).text("");
        return true;
    }
}

/*
 *   Se guarda el escenario 
 */
function guardarEscenario(){    
    if(!validarFormEsc()){
        return false;
    }
    var data = $("#form-add-escenario").serializeArray();
    var formData = new FormData();   
    $(data).each(function(index, element){
        formData.append(element.name, element.value);
    });    
    var file = $("#foto-escenario").prop('files')[0];
    formData.append('file', file);
        
    $("#msnNuevoEscenario1").css('color', 'black');
    $("#msnNuevoEscenario1").css('font-weight', 'bold');
    $("#msnNuevoEscenario1").css('font-size', '15px');
    $("#msnNuevoEscenario1").text(PROCESANDO);
    event.preventDefault();    
    $.ajax({        
        url:$("#urlNuevoEscenario").val(),
        data: formData,
        contentType:false,
        cache: false,
        processData:false,
        type: 'POST',
        success:function(response){                      
                            
            $("#msnNuevoEscenario1").css('color', 'green');
            $("#msnNuevoEscenario1").css('font-weight', 'bold');
            $("#msnNuevoEscenario1").css('font-size', '22px');
            if(response == true){
                $("#msnNuevoEscenario1").text(ESCENARIO_EXITO);    
            }else{
                $("#msnNuevoEscenario1").text(ESCENARIO_EXITO_NO_IMG);    
            } 
            setTimeout(function(){
                $("#msnNuevoEscenario1").text("");
                $('#list-escenario').DataTable().ajax.reload();
                $('#modalForm').modal("hide");
                cleanEscenario();                
            }, 2000);             
        }
    });   
}

/*
 *  Muestra las ciudades de acuerdo al departamento seleccionado
 *  parámetros: id departamento, tipo de consulta para reutilizar función
 */
function mostrarCiudad(id, tipo){
    if(tipo == 1){
        $(".ciudad").html("<select class='form-control' disabled><option>"+CARGANDO+"</option></select>");
    }else if(tipo == 2){
        $(".city").html("<select class='form-control' disabled><option>"+CARGANDO+"</option></select>");
    }    
    $.ajax({
        url:$("#urlMostrarCiudad").val(),
        data: "id="+id+"&tip="+tipo,
        success:function(response){
            response = JSON.parse(response);
            if(tipo == 1){
                $(".ciudad").html(response);
            }else if(tipo == 2){
                $(".city").html(response);
            }
        }
    });
}

/*
*   Valida los campos de guardar escenario con el 
*   para luego permitir el registro en guardarEscenario()
*/
function validarFormEsc(){  

    var filename = $("#foto-escenario").val();
    var extension = filename.replace(/^.*\./, '');
    if (extension == filename) {
        extension = '';
    } else {
        extension = extension.toLowerCase();
    }

    var msn = "";
    if(validarLongitudMin('esc_nombre',5)){
        msn = MIN_NOMBRE_ESCENARIO;         
    } else if(validarListaSeleccionada('depa')){
        msn = DEPARTAMENTO_ESCENARIO;
    }else if(validarListaSeleccionada('ciud')){
        msn =  CIUDAD_ESCENARIO;       
    }else if(validarLongitudMin('esc_direccion',1)){
        msn = DIRECCION_ESCENARIO;
    }else if(validaSelect('deport')){
        msn = DEPORTES_ESCENARIO;        
    }else if(extension != "png" && extension != "jpg" && extension != "jpeg"){
        $("#foto-escenario").css("border-color","red");
        msn = ARCHIVO_IMG;
    }
    if(msn != ""){
        $("#msnNuevoEscenario").css('color', 'red');
        $("#msnNuevoEscenario").css('font-weight', 'bold');
        $("#msnNuevoEscenario").css('font-size', '15px');
        $("#msnNuevoEscenario").text(msn);        
        $("#modalForm").animate({ scrollTop: 0 }, 300);
        return false;
    }else{
        return true;
    }
}

/*
 *  Función para validar los datos para ingresar un nuevo contacto
 *  Parámetros nombre, apellido, teléfono, celular, email del contacto; idMsn campo para alerta
 */
function validarFormContact(nombre, apellido, telefono, celular, email, idMsn){
    var msn = "";
    if(validarLongitudMin(nombre,1)){
        msn = MIN_NOMBRE_CONTACTO;
    }else if(validarLongitudMin(apellido,1)){
        msn = MIN_APELLIDO_CONTACTO;
    }else if(validarLongitudMin(telefono,7)){
        msn = MIN_TELEFONO_CONTACTO;
    }else if(validarLongitudMin(celular,10)){
        msn = MIN_CELULAR_CONTACTO;
    }else if(validarLongitudMin(email,5)){
        msn = EMAIL_NO_VACIO;
    }
    if(msn != ""){
        $("#"+idMsn).css('color','red');
        $("#"+idMsn).css('font-weight','bold');
        $("#"+idMsn).text(msn);
        return false;
    }else{
        $("#"+idMsn).text();
        return true;
    }
}

/*
 *  Función para validar el tipo de texto introducido
 *  Parámetro evento tecla      
 */

function validarNumero(e){
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9,-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

/*
 * Función para validar el Email
 * Parametros id campo a validar, idMsn campo para mostrar mensaje
 */
function validarEmail(id,idMsn){
    var validaEmail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    var email = document.getElementById(id).value;    
    if(!validaEmail.test(email)){
        document.getElementById(id).value = "";        
        $("#"+id).css({'border-color': 'red'});
        $("#"+idMsn).css('color', 'red');
        $("#"+idMsn).css('font-weight', 'bold');
        $("#"+idMsn).text(EMAIL_VALIDACION);
    }else{
        $("#"+id).css({'border-color': ''});
        $("#"+idMsn).text("");
    }
}

/*
 * Función para agregar un contacto a escenario existente
 * Parámetro id del escenario
 */
function agregarContacto(id){
    if(!validarFormContact('nombre_ce','apellidos_ce','telefono_ce','celular_ce','mmail','msnNuevoContacto')){
        return false;
    }       
    $("#msnNuevoContacto").css('font-weight','bold'); 
    $("#msnNuevoContacto").css('color','black');    
    $("#msnNuevoContacto").css('font-size','15px');    
    $("#msnNuevoContacto").text(PROCESANDO);
    $.ajax({
        url:$("#urlNuevoContacto").val(),
        data:"id="+id+"&n="+$("#nombre_ce").val()+"&a="+$("#apellidos_ce").val()+"&t="+$("#telefono_ce").val()+"&c="+$("#celular_ce").val()+"&e="+$("#mmail").val(),
        success:function(response){ 
            $("#msnNuevoContacto").css('font-weight', 'bold');
            $("#msnNuevoContacto").css('font-size', '22px');                       
            if(response == true){
                $("#msnNuevoContacto").css('color', 'green');
                
                $("#msnNuevoContacto").text(CONTACTO_ESCENARIO_EXITO);
                setTimeout(function(){
                    editRow(id);
                    $('#list-escenario').DataTable().ajax.reload();                                
                    $("#msnNuevoContacto").text("");
                }, 2000); 
            }else{
                $("#msnNuevoContacto").css('color', 'red');
                $("#msnNuevoContacto").text(CONTACTO_ESCENARIO_ERROR);
                setTimeout(function(){
                    $("#msnNuevoContacto").text("");
                },2000);
            }                     
        }
    });
}

/*
 *  Función que se activa en el modal editar escenario
 */
function editarEscenario(id){
    event.preventDefault();
    if(!validarEditarEscenario()){
        return false;
    }
    if($("#verificador").val() == 1){
        if(!validarFormContact('nombre_ce','apellidos_ce','telefono_ce','celular_ce','mmail','msnModifEscenario')){
            return false;
        }
    }
    $("#msnModifEscenario").css('font-weight','bold');
    $("#msnModifEscenario").css('color','black');
    $("#msnModifEscenario").css('font-size','15px');
    $("#msnModifEscenario").text(PROCESANDO);
    $.ajax({
        url:$("#urlModificarEscenario").val(),
        data: "idEsc="+id+"&"+$("#form_escenario").serialize(),
        success:function(response){
            if(response == true){
                $("#msnModifEscenario").css('color', 'green');
                $("#msnModifEscenario").css('font-weight', 'bold');
                $("#msnModifEscenario").css('font-size', '22px');
                $("#msnModifEscenario").text(ESCENARIO_EXITO_EDICION);
                setTimeout(function(){
                    $('#list-escenario').DataTable().ajax.reload();
                    $("#msnModifEscenario").text("");
                },2000);
            }
        }
    });
}

/*
 *  Se desactiva un deporte que actualmente está
 *  ligado al escenario
 */
function borrarDeporteEscenario(idDep, idEsc){
    $("#msnDeportesEditar").css('font-weight','bold');
    $("#msnDeportesEditar").css('color','black');
    $("#msnDeportesEditar").css('font-size','15px');
    $("#msnDeportesEditar").text(PROCESANDO);
    $.ajax({
        url:$("#urlBorrarDeporteEsc").val(),
        data: "idEsc="+idEsc+"&idDep="+idDep,
        success:function(response){
            $("#msnDeportesEditar").css('font-weight','bold');
            $("#msnDeportesEditar").css('font-size','22px');
            if(response == true){
                $("#fila"+idDep).fadeOut(1000);
                $("#msnDeportesEditar").css('color', 'green');
                $("#msnDeportesEditar").css('font-weight','bold');
                $("#msnDeportesEditar").css('font-size','22px');
                $("#msnDeportesEditar").text(DEPORTE_ESCENARIO_BORRAR);
                setTimeout(function(){
                    $("#msnDeportesEditar").text("");
                },2000);
            }else{
                $("#msnDeportesEditar").css('color', 'red');
                $("#msnDeportesEditar").text(DEPORTE_ESCENARIO_BORRAR_ERROR);
                setTimeout(function(){
                    $("#msnDeportesEditar").text("");
                },2000);
            }
        }
    });
}

/*
 *  Función que agrega en nuevo deporte a un escenario
 */
function agregarDeporteEscenario(idDep, idEsc){
    if(idDep == 0){return false;}
    $("#msnDeportesEditar").css('font-weight','bold');
    $("#msnDeportesEditar").css('color','black');
    $("#msnDeportesEditar").css('font-size','15px');
    $("#msnDeportesEditar").text(PROCESANDO);
    $.ajax({
        url:$("#urlAgregarDeporteEscenario").val(),
        data:"idDep="+idDep+"&idEsc="+idEsc,
        success: function(response){
            $("#msnDeportesEditar").css('font-weight','bold');
            $("#msnDeportesEditar").css('font-size','22px');
            if(response == true){
                $("#msnDeportesEditar").css('color', 'green');
                $("#msnDeportesEditar").text(DEPORTE_ESCENARIO_AGREGAR);
                setTimeout(function(){
                    editRow(idEsc);
                    $("#msnDeportesEditar").text("");
                },2000);
            }else{
                $("#msnDeportesEditar").css('color', 'red');
                $("#msnDeportesEditar").text(DEPORTE_ESCENARIO_AGREGAR_ERROR);
                setTimeout(function(){
                    $("#msnDeportesEditar").text("");
                },2000);
            }
        }
    });
}

/*
 *  Cambiar la locación del escenario
 *  parámetro: id escenario
 */
function cambiarLocacion(id){
    if(!validarCambioCiudadEscenario()){return false;}
    $("#msnLocacionEditar").css('font-weight','bold');
    $("#msnLocacionEditar").css('color','black');
    $("#msnLocacionEditar").css('font-size','15px');
    $("#msnLocacionEditar").text(PROCESANDO);
    $.ajax({
        url:$("#urlModificarLocacion").val(),
        data:"idEsc="+id+"&idLoc="+$("#locac").val(),
        success:function(response){
            $("#msnLocacionEditar").css('font-weight','bold');
            $("#msnLocacionEditar").css('font-size','22px');
            if(response==true){
                $("#msnLocacionEditar").css('color', 'green');
                $("#msnLocacionEditar").text(LOCACION_EDITAR);
                setTimeout(function(){
                    editRow(id);
                    $('#list-escenario').DataTable().ajax.reload();
                    $("#msnLocacionEditar").text("");
                },2000);
            }else{
                $("#msnLocacionEditar").css('color', 'red');
                $("#msnLocacionEditar").text(LOCACION_EDITAR_ERROR);
                setTimeout(function(){
                    $("#msnLocacionEditar").text("");
                },2000);
            }
        }
    });
}

/*
 *  Se cambia el estado de un escenario específico
 */
function cambiarEstadoEscenario(idEsc, estadoActual){
    $.ajax({
        url:$("#urlCambiarEstadoEscenario").val(),
        data:"idEsc="+idEsc+"&estAct="+estadoActual,
        success:function(response){
            if(response == true){
                $('#list-escenario').DataTable().ajax.reload();
            }
        }
    });
}

/*
 *  Valida los campos para cambiar la locación
 *  de un escenario particular
 */
function validarCambioCiudadEscenario(){
    var msn = "";
    if(validarListaSeleccionada('depar')){
        msn = DEPARTAMENTO_ESCENARIO;
    }else if(validarListaSeleccionada('locac')){
        msn = CIUDAD_ESCENARIO;
    }
    if(msn != ""){
        $("#msnLocacionEditar").css('font-weight','bold');
        $("#msnLocacionEditar").css('color','red');
        $("#msnLocacionEditar").css('font-size','15px');
        $("#msnLocacionEditar").text(msn);
        return false;
    }else{
        $("#msnLocacionEditar").text("");
        return true;
    }
}

/*
 *  Valida los campos a la hora de
 *  editar un escenario
 */
function validarEditarEscenario(){
    var msn = "";
    if(validarLongitudMin('nombre_esc', 5)){
        msn = MIN_NOMBRE_ESCENARIO;
    }else if(validarLongitudMin('direccion_esc',1)){
        msn = DIRECCION_ESCENARIO;
    }
    if(msn != ""){
        $("#msnModifEscenario").css('font-weight','bold');
        $("#msnModifEscenario").css('color','red');
        $("#msnModifEscenario").css('font-size','15px');
        $("#msnModifEscenario").text(msn);
        $("#modalVerEscenario").animate({ scrollTop: 0 }, 300);
        return false;
    }else{
        $("#msnModifEscenario").text("");
        return true;
    }
}

/*
 *  Función que se activa al seleccionar la fecha inicial
 */
function activarFechaFin(val){
    if(val != ""){
        $("#fecha-fin").prop( "disabled", false );
    }else{
        $("#fecha-fin").prop( "disabled", true );
    }       
}

function verificarFecha(fechaIni, fechaFin, escenario, hora,idDis, msnMsj){   
    var es = 0;  
    $("#"+msnMsj).text("");      
    $.ajax({
        async: false,
        url:$("#urlValidarFechas").val(),
        data:"fi="+fechaIni+"&ff="+fechaFin+"&esc_id="+escenario+"&idDis="+idDis+""+hora,
        success:function(response){                          
            if(response == true){                           
                es = 1;                
            }else{       
                $("#"+msnMsj).css("font-size", "15px");
                $("#"+msnMsj).css("font-weight","bold");         
                $("#"+msnMsj).css("color","red");
                $("#"+msnMsj).text(DISPONIBILIDAD_HORA_CRUZADA);                
                es = 0;                
            }            
        }
    });
    return es;
}

function modificarFoto(id){
    var filename = $("#nueva-foto").val();
    var extension = filename.replace(/^.*\./, '');
    if (extension == filename) {
        extension = '';
    } else {
        extension = extension.toLowerCase();
    }    
    if(extension != "png" && extension != "jpg" && extension != "jpeg"){
        $("#nueva-foto").css("border-color","red");
        $("#msnModifEscenario").css("color","red");
        $("#msnModifEscenario").css("font-weight","bold");
        $("#msnModifEscenario").css("font-size","15px");
        $("#msnModifEscenario").text(ARCHIVO_IMG);
    }
    var data = new Array();
    var formData = new FormData();
    data['idEsc'] = id;
    formData.append('idEsc',id);
    var file = $("#nueva-foto").prop('files')[0];
    formData.append('file', file);
    $.ajax({
        url: $("#urlModificarFoto").val(),
        data: formData,
        contentType:false,
        cache: false,
        processData:false,
        type: 'POST',
        success:function(response){
            if(response == true){
                editRow(id);
            }
        }
    });
}