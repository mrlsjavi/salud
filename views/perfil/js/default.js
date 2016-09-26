$(document).ready(function(){
	window.onload = function(){
		llenar_campos();
	};

	$("#btn_guardar").click(function(){
	
		var datos = {nombre: $("#txt_nombre").val(), login:$("#txt_login").val(), direccion:$("#txt_direccion").val(), telefono:$("#txt_telefono").val()};
		var datos_json = JSON.stringify(datos);
		
		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"perfil/actualizar",
			dataType:"json",
			success: function(res){
				alert(res.msj);
				llenar_campos();

				
				
			}

		});
    	
    });

    $("#btn_clave").click(function(){
    	var r = confirm("Desea cambiar su clave? ");
		if(r == true){//tengo que ir a por los datos
			mostrarVentanaClave();
		}
    });

	$("#btn_ActualizarClave").click(function(){
	   		var datos = {pass:$("#txt_EditarPass").val()};
				var datos_json = JSON.stringify(datos)
				
				enviar = {info: datos_json};
				//alert("d");
				$.ajax({
					type: "POST",
					data: enviar,
					url:"perfil/clave",
					dataType:"json",
					success: function(res){
						alert(res.msj);
						ocultarVentanaClave();
						
						$("#txt_EditarPass").val('');

						//exit;
						
				}

			});
	  
	   });

	function mostrarVentanaClave(){
	    var ventana = document.getElementById('dv_clave');
	    ventana.style.marginTop = "100px";
	    ventana.style.left = ((document.body.clientWidth-350) / 2) +"px";

	    ventana.style.display = 'block';
	}

	function ocultarVentanaClave(){
		    var ventana = document.getElementById('dv_clave');
		    ventana.style.marginTop = "100px";
		    ventana.style.left = ((document.body.clientWidth-350) / 2) +"px";
		    ventana.style.display = 'none';
	}

	function llenar_campos(){

		//alert("d");
		$.ajax({
			type: "POST",
			//data: enviar,
			url:"perfil/datos",
			dataType:"json",
			success: function(res){
				//alert(res.msj);
				console.log(res);
				$("#txt_nombre").val(res.datos[0]['nombre']);
				$("#txt_login").val(res.datos[0]['login']);
				$("#txt_direccion").val(res.datos[0]['direccion']);
				$("#txt_telefono").val(res.datos[0]['telefono']);
				
				
				
			}

		});

	}

});