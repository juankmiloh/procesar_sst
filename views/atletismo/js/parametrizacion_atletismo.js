$(document).ready(function(){

	$("input, select").focus(function(){
		$("p").text("");
		$("input, select").css("border-color", "");
	});
});


function cleanModal(){
	$("#titulo-modal").text(NUEVA_REGLA);
	$(".form-edit").prop("disabled",false);
	$(".form-edit").val("");
	$("#parametro-1").text("");
	$("#parametro-2").text("");
	$("#valor-p-1").val("");
	$("#valor-p-2").val("");
	$("p").text("");
	$("#idRegla").val("");
	filtrarPruebas();
}

function editRow(id){
	$("p").text("");	
	$("input, select").css("border-color", "");
	$("#idRegla").val(id);
	$("#titulo-modal").text(EDITAR_REGLA+" "+id);
	$("#modalNuevaRegla").modal();	
	$.ajax({
		url: $("#urlCargarDatosModal").val(),
		data: "id="+id,
		success:function(response){
			var obj = JSON.parse(response);			
			$("#categoria").val(obj['prueba']['cat_id'])
			$("#genero").val(obj['prueba']['prueb_genero']);			
			$("#prueba").val(obj['prueba']['prueb_id']);
			$(".form-edit").prop("disabled",true);
			$("#parametro-1").text(obj['p1']['par_at_nombre']);
			$("#parametro-2").text(obj['p2']['par_at_nombre']);
			$("#valor-p-1").val(obj['parametrizacion']['param_at_param1_valor']);
			$("#valor-p-2").val(obj['parametrizacion']['param_at_param2_valor']);
		}
	});
}

function filtrarPruebas(){	
	$.ajax({	
		url: $("#urlFiltrarPruebas").val(),
		data:{
			idCategoria : $("#categoria").val(), 
			idGenero : $("#genero").val()},
		success:function(response){
			// alert(JSON.parse(response));
			$("#prueba").html(response);
		}
	});
}

function cambiarEstado(idPar, estado){
	$.ajax({
		type: 'POST',
		url: $("#urlModificarEstado").val(),
		data: "idPar="+idPar+"&estado="+estado,
		success:function(response){
			if(response == true){
				$("#list-parametros").DataTable().ajax.reload();
			}
		}
	});
}

function mostrarParametros(value){
	if(value == 1){
		$("#genero").val(3);
		$("#genero").prop('disabled',true);
	}else{
		$("#genero").val("");
		$("#genero").prop('disabled',false);
	}

	$.ajax({
		type: 'POST',
		url: $("#urlParamTipoPrueba").val(),
		data: "tpr="+value,
		success:function(response){
			var par = JSON.parse(response);
			for(var i = 1; i <= 2; i++){
				var param = "";
				var param_id = "";
				if(par['par'+i] != null){
					param = par['par'+i]['par_at_nombre'];
					param_id = par['par'+i]['par_at_id']
				}
				$("#parametro-"+i).text(param);	
				$("#parametro-"+i+"_id").val(param_id);
			}	
			filtrarPruebas();		
		}
	});
}

function guardarRegla(){
	if(!validarFormNuevaRegla()){
		return false;
	}
	$.ajax({
		type: 'POST',
		url: $("#urlGuardarRegla").val(),
		data: $("#formularioGuardarRegla").serialize(),
		success:function(response){
			if(response == true){
				$("#msnFormRegla").css("color","green");
				$("#msnFormRegla").css("font-weight","bold");
				$("#msnFormRegla").css("font-size","22px");
				$("#msnFormRegla").text(NUEVA_REGLA_EXITO);
				setTimeout(function(){
					$("#msnFormRegla").text("");
					$("#modalNuevaRegla").modal('hide');
					$("#list-parametros").DataTable().ajax.reload();
				}, 2000);								
			}else if(response == "2"){
				$("#msnFormRegla").css("color","red");
				$("#msnFormRegla").css("font-weight","bold");
				$("#msnFormRegla").css("font-size","22px");
				$("#msnFormRegla").text(NUEVA_REGLA_EXISTE);
				$("#prueba").css("border-color","red");
				setTimeout(function(){
					$("#msnFormRegla").text("");					
				}, 2000);
			}else if(response == "3"){
				$("#msnFormRegla").css("color","green");
				$("#msnFormRegla").css("font-weight","bold");
				$("#msnFormRegla").css("font-size","22px");
				$("#msnFormRegla").text(REGLA_EDITAR_EXITO);
				setTimeout(function(){
					$("#msnFormRegla").text("");
					$("#modalNuevaRegla").modal('hide');
					$("#list-parametros").DataTable().ajax.reload();
				}, 2000);
			}
		
		}
	});
}

function validarFormNuevaRegla(){			
	var msn = "";
	if(validarListaSeleccionada('tipo_prueba')){
		msn = TIPO_PRUEBA_SEL;
	}else if(validarListaSeleccionada('prueba')){
		msn = PRUEBA_SEL;
	}else if(validaCampoNoVacio('valor-p-1') || validaCampoNoVacio('valor-p-2')){
		msn = PARAMETRO_MIN;
	}

	if(msn != ""){
		$("#msnFormRegla").css("color","red");
		$("#msnFormRegla").css("font-weight","bold");
		$("#msnFormRegla").css("font-size","15px");
		$("#msnFormRegla").text(msn);
		return false;
	}else{
		$("#msnFormRegla").text("");
		return true;
	}	
}

function verificarSuma(id){
	if($("#valor-p-1").val() == ""){
		$("#valor-p-1").val(1);
	}else if($("#valor-p-2").val() == ""){
		$("#valor-p-2").val(1);
	}
	var suma = parseInt($("#valor-p-1").val()) + parseInt($("#valor-p-2").val());

	// if(suma == parseInt(SUM_PARAMETRIZACION_ATLETISMO)+1){
	// 	$("#"+id).val(parseInt($("#"+id).val())-1);
	// 	$("#msnFormRegla2").css("color","red");
	// 	$("#msnFormRegla2").css("font-weight","bold");
	// 	$("#msnFormRegla2").css("font-size","15px");
	// 	$("#msnFormRegla2").text(PARAMETRO_SUMA_MAX+SUM_PARAMETRIZACION_ATLETISMO);
	// 	$("#valor-p-1").attr({
	// 		'max':$("#valor-p-1").val()
	// 	});
	// 	$("#valor-p-2").attr({
	// 		'max':$("#valor-p-2").val()
	// 	});
	// }else{
	// 	$("#msnFormRegla2").text("");
	// 	$("#valor-p-1").attr({
	// 		'max': ''
	// 	});
	// 	$("#valor-p-2").attr({
	// 		'max': ''
	// 	});
	// }
}