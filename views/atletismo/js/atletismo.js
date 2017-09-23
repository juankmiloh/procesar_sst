function asignarNumero(usu_id,id){
	formato(id);
	if($("#"+id).val()==""){
		alert(DEBE_INGRESAR_NUMERO);
		return false;
	}	
	$.ajax({
		url: $("#urlAsignarNum").val(),
		data: "dep_id="+usu_id+"&num="+$("#"+id).val(),
		success:function(response){
			if(response == "-3"){
				alert(NUMERO_YA_ASIGNADO);
				$("#"+id).val("");
			}else{
				alert(NUMERO_ASIGNADO_EXITO);
				$("#"+id).prop("readonly",true);
			}			
		}
	});
}

function formato(id){	
	var z = "";
	var num = $("#"+id).val();
	while(num.length < 4 && num!=""){
		z = "0";
		num = z+num;
	}
	$("#"+id).val(num);	
}

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

function habilitarCampo(id){
	if( $("#num"+id.replace("btn","")).is("[readonly]")){
		$("#num"+id.replace("btn","")).prop('readonly',false);	
		$("#"+id).css("filter","grayscale(100%)");
	}else{
		$("#num"+id.replace("btn","")).prop('readonly',true);
		$("#"+id).css("filter","grayscale(0%)");
	}	
}

function vaciarCampo(usu_id,id){	
	$.ajax({
		url:$("#urlLimpiarNumero").val(),
		data:"dep_id="+id.replace("btnd",""),
		success:function(response){
			if(response == 1){
				alert(NUMERO_BORRADO_EXITO);
				$("#"+id.replace("btnd","num")).val("");
			}			
		}
	});
	
}

function listarMunicipios(id){	 
	$.ajax({
		url: $("#urlMunicipiosJugadores").val(),
		data: "dpto_id="+id,
		success:function(response){
			var obj = jQuery.parseJSON( response ); 
			var view = "<select style='width:100%;' id='municipios_id2' name='municipios_id2' class='form-control filter'><option value=''>"+TODO+"</option>";
			var num = 0;
			while(obj['muni'+num] != null){
				view += "<option value='"+obj['muni'+num]['municipios_id']+"'>"+obj['muni'+num]['municipios_name']+"</option>";
				num++;
			}
			
			view +="</select>";
			view = view.replace("/\r|\n/", "");			 
			$('#list-jugadores thead tr:eq(1) th:eq(1)').html(view);	
			$('#municipios_id2').select2();
			$('.filter, .select2').on('click', function(e){
	            e.stopPropagation();    
	        });		
	        // Buscar los valores ingresados
	        var table1 = $('#list-jugadores').DataTable();
	        table1.columns().every(function (index) {
	            $('#list-jugadores thead tr:eq(1) th:eq(' + index + ') select').on('change', function () {
	                    table1.column($(this).parent().index() + ':visible')
	                        .search(this.value).draw();
	            });	            	                
	        });
		}
	});
}

/*
 *	Función para generar filtrar tabla enviándole un GET y recargando la acción del DataTable
 */
function generarTable(idDepto){	
	var url =  $("#urlTable").val()+"&idDepto="+idDepto // urlTable: atletismo/datadeportistas
	$('#list-jugadores').DataTable().ajax.url(url).load();	
}

function generarReporte(){	
	$.ajax({		
		type: 'POST',
		url: $("#urlGeneracionReporte").val(),
		data: $("#formularioAsignarNum").serialize(),
		success:function(response){
			if(response != false){	
				if(response.substr(response.length-3, 3) == "pdf"){
					window.open(response);
				}else{
					window.location = response;
				}
			}
		}
	});
}