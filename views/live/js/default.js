$(document).ready(function(){
	window.onload = function(){
			tiempo_real();
			llenar_select();
			historial();
	};


	function tiempo_real(){

		$.ajax({
			type: "POST",
			//data: enviar,
			url:"live/vivo",
			//dataType:"json",
			success: function(res){
				
				
			
				$("#Vivo").empty();
				$("#Vivo").append(res);


				
			}

		});
	}

	function historial(){
		$.ajax({
			type: "POST",
			//data: enviar,
			url:"live/historial",
			//dataType:"json",
			success: function(res){
				
				
			
				$("#dv_graficas").empty();
				$("#dv_graficas").append(res);


				
			}

		});
	}


	function llenar_select(){
		$.ajax({
			type: "POST",
			//data: enviar,
			url:"live/select",
			//dataType:"json",
			success: function(res){
				$("#slt_sensor").append(res);
				
			}

		});

	}

	$("#slt_sensor").change(function(){
		if($("#slt_sensor").val() == 0){
			alert("oculto");
			//ocultar div 
			//ocultarVentana();
		}
		else{
			alert("cargo");
			//cargar_paginas();
			//mostrarVentana();
		}
	});


	function  llenar_tabla(){
		var datos = {nombre: $("#slt_nombre").val(), login:$("#txt_login").val(), password:$("#txt_pass").val(), rol: $("#slt_rol").val()};
		var datos_json = JSON.stringify(datos);
		
		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"usuario/guardar",
			dataType:"json",
			success: function(res){
				alert(res.msj);
				llenar_tabla();
				$("#txt_nombre").val('');
				$("#txt_pass").val('');
				$("#txt_login").val('');
				$("#slt_rol").val('0').attr('selected', 'selected');
				

				
				
			}

		});
	}
})

