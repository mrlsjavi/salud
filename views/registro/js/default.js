$(document).ready(function(){

	$("#btn_guardar").click(function(){
		var datos = {correo:$("#txt_login").val()};
		var datos_json = JSON.stringify(datos);

		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"registro/verificar_correo",
			//dataType:"json",
			success: function(res){
				if(res == 2){
					guardar();
				}
				else{
					alert("El correo electronico ingresado ya pertenece a una cuenta");
				}
				
			}
		});
	});
			

	function guardar(){
		var datos = {nombre: $("#txt_nombre").val(), login:$("#txt_login").val(), password:$("#txt_pass").val(), direccion:$("#txt_direccion").val(), telefono:$("#txt_telefono").val()};
		var datos_json = JSON.stringify(datos);

		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"registro/guardar",
			dataType:"json",
			success: function(res){
				
				if(res.cod == 1){
					alert("Registrado con Exito!");
					$("#txt_nombre").val('');
					$("#txt_pass").val('');
					$("#txt_login").val('');
					$("#txt_direccion").val(null);
					$("#txt_telefono").val(null);
					//header('location: '.URL.'login');
					window.location="http://52.36.27.188/salud/login";

					
				}
				else{
					alert("No ha sido posible registrarlo, intente de nuevo");
				}
			}
		});
	}

});

