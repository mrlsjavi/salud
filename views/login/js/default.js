$(document).ready(function(){

	$("#btn_clave").click(function(){
		r = confirm("Desea recuperar su password?")
		if(r== 1){
			mostrarVentanaClave();
		}
	});

	$("#btn_MandarClave").click(function(){
		var datos = {login:$("#txt_login").val()};
		var datos_json = JSON.stringify(datos);
		
		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"login/clave",
			//dataType:"json",
			success: function(res){
				alert(res);
				$("#txt_login").val('');
				ocultarVentanaClave();
				
				

				
				
			}

		});
	})

	$("#btn_cancelar").click(function(){
		ocultarVentanaClave();
		$("#txt_login").val(null);
		
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

});