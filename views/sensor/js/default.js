$(document).ready(function(){

	window.onload = function(){
		llenar_tabla();
	};

	$("#btn_guardar").click(function(){
		var datos = {titulo: $("#txt_titulo").val(), descripcion: $("#txt_descripcion").val(), tipo: $("#txt_codigo").val()};
		var datos_json = JSON.stringify(datos);

		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"sensor/guardar",
			dataType:"json",
			success: function(res){
				alert(res.msj);
				/*if(res.cod ==1){
				alert(res.msj);
			}
			else{
			alert("ha ocurrido un problema");
		}*/
		llenar_tabla();
		$("#txt_titulo").val('');
		$("#txt_descripcion").val('');
		$("#txt_tipo").val('');
	}

});

});


function data_table(){
	$('#javier').DataTable( {
		"ordering": false,
		"pagingType": "full_numbers",

		"language": {
			"search": "Buscar",
			"info": "Mostrando _START_ de _END_ registros",
			"lengthMenu":     "Mostrar _MENU_ ",
			"emptyTable":     "Sin registros",
			"infoEmpty":      "Sin paginas que mostrar",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"zeroRecords":    "busqueda sin resultados",
			"infoFiltered":   "(filtrado de _MAX_ registros)",
			"paginate": {
				"first":      "Primera",
				"last":       "Ultima",
				"next":       "Siguiente",
				"previous":   "Anterior"
			}
		},


	} );
}


//para que cargue la funcion de editar y eliminar en todas las paginas
function eliminar_editar (){
	$(".paginate_button").click(function(){
		//alert("paginando");
		eliminar_editar();
		click_editar();
		click_eliminar();
	});
}


function llenar_tabla(){
	// $.ajax({
	// 	type: "POST",
	// 	url:"sensor/traer_usuarios",
	// 	success: function(res){
	// 		var usuario = $("#txt_usuario");
	// 		var datos = JSON.parse(res.trim());
	// 		$.each(datos.datos, function(data) {
	// 			usuario.append($("<option />").val(this.id).text(this.nombre));
	// 		});
	//
	// 	}
	// });
	$.ajax({
		type: "POST",
		url:"sensor/llenar_tabla",
		//dataType:"json",
		success: function(res){
			$("#dv_tabla").empty();
			$("#dv_tabla").append(res);

			data_table();
			click_editar();
			click_eliminar();
			eliminar_editar();

			/*if(res.cod ==1){
			alert(res.msj);
		}
		else{
		alert("ha ocurrido un problema");
	}*/

}

});
}

function click_editar(){
	$(".editar").click(function(){
		var r = confirm("Desea editar el registro? ");
		if(r === true){//tengo que ir a por los datos
			var datos = {id: $(this).attr("id")};
			var datos_json = JSON.stringify(datos);

			enviar = {info: datos_json};
			//alert("d");
			$.ajax({
				type: "POST",
				data: enviar,
				url:"sensor/traer_dato",
				dataType:"json",
				success: function(res){
					$("#txt_EditarTitulo").val(res.datos.titulo);
					$("#txt_EditarDescripcion").val(res.datos.descripcion);
					$("#txt_EditarCodigo").val(res.datos.tipo);

					$("#txt_EditarId").val(res.datos.id);
					mostrarVentana();
					editar();


				}

			});
		}
	});
}

function editar (){

	$("#btn_actualizar").click(function(){
		var datos = {id: $("#txt_EditarId").val(), titulo:$("#txt_EditarTitulo").val(), descripcion:$("#txt_EditarDescripcion").val(), tipo: $("#txt_EditarCodigo").val()};
		var datos_json = JSON.stringify(datos);

		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"sensor/actualizar",
			dataType:"json",
			success: function(res){
				alert(res.msj);
				ocultarVentana();
				llenar_tabla();
				//exit;

			}

		});

	});
}



function mostrarVentana(){
	var ventana = document.getElementById('dv_edicion');
	ventana.style.marginTop = "100px";
	// ventana.style.left = ((document.body.clientWidth-350) / 2) +"px";

	ventana.style.display = 'block';
}

function ocultarVentana(){
	var ventana = document.getElementById('dv_edicion');
	ventana.style.marginTop = "100px";
	// ventana.style.left = ((document.body.clientWidth-350) / 2) +"px";
	ventana.style.display = 'none';
}

function click_eliminar(){
	$(".eliminar").click(function(){
		var r = confirm("Seguro que desea eliminar este registro?"); //inidcar cual
		if(r === true){
			var datos = {id: $(this).attr("id")};
			var datos_json = JSON.stringify(datos);

			enviar = {info: datos_json};
			//alert("d");
			$.ajax({
				type: "POST",
				data: enviar,
				url:"sensor/eliminar",
				dataType:"json",
				success: function(res){
					//console.log(res);
					//alert(res.datos[0]['nombre']);
					alert(res.msj);
					llenar_tabla();
					//actualizar tabla
				}

			});

		}

	});
}




});
