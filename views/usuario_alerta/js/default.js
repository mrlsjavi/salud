$(document).ready(function(){

	window.onload = function(){
		llenar_tabla();
		alertas();
	};
    
    $("#btn_guardar").click(function(){
    	//verificar_usuario();
    	verificar_usuario();
    });

    function verificar_usuario(){
    	var datos = {usuario: $("#txt_usuario").val()};
		var datos_json = JSON.stringify(datos)
		
		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"usuario_alerta/verificar_usuario",
			//dataType:"json",
			success: function(res){
				if(res == 1){
					//vamo a guardar 
					guardar();
					llenar_tabla();
					$("#txt_usuario").val(null);
					$("#txt_correo").val(null);
					$("#slt_alerta").val('0').attr('selected', 'selected');
				}
				else{
					alert("No valido");
				}
				
			}

		});
    }

    function guardar(){
    	var checkbox= 0;
    	if($("#box").prop('checked')){
    		checkbox= 1;
    	}
    	else{
    		checkbox= 0;
    	}

    	var datos = {usuario: $("#txt_usuario").val(), alerta:$("#slt_alerta").val(), correo:$("#txt_correo").val(), notificacion: checkbox};
		var datos_json = JSON.stringify(datos)
		
		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"usuario_alerta/guardar",
			dataType:"json",
			success: function(res){
				alert(res.msj);
				
			}

		});
    }

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
    	$.ajax({
			type: "POST",
			
			url:"usuario_alerta/llenar_tabla",
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
   			if(r == true){//tengo que ir a por los datos
   				var datos = {id: $(this).attr("id")};
				var datos_json = JSON.stringify(datos)
				
				enviar = {info: datos_json};
				//alert("d");
				$.ajax({
					type: "POST",
					data: enviar,
					url:"usuario_alerta/traer_dato",
					dataType:"json",
					success: function(res){
						
						
						$("#txt_EditarUsuario").val(res.datos[0]['obj_usuario']['nombre']);
						$("#slt_EditarAlerta").val(res.datos[0]['alerta']).attr('selected', 'selected');
						$("#txt_EditarId").val(res.datos[0]['id']);
						$("#txt_EditarCorreo").val(res.datos[0]['mail']);
						if(res.datos[0]['notificacion'] == 1){
							$("#EditarBox").prop('checked', true);
						}
						else{
							$("#EditarBox").prop('checked', false);
						}
					
						mostrarVentana();
						editar();

						
					}

				});
   			}
   		});	
   }

   function editar (){

	   $("#btn_actualizar").click(function(){
	   	var checkbox= 0;
    	if($("#EditarBox").prop('checked')){
    		checkbox= 1;
    	}
    	else{
    		checkbox= 0;
    	}

	   		var datos = {id: $("#txt_EditarId").val(), correo:$("#txt_EditarCorreo").val(), notificacion:checkbox};
				var datos_json = JSON.stringify(datos)
				
				enviar = {info: datos_json};
				//alert("d");
				$.ajax({
					type: "POST",
					data: enviar,
					url:"usuario_alerta/actualizar",
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
	    ventana.style.left = ((document.body.clientWidth-350) / 2) +"px";

	    ventana.style.display = 'block';
	}

	function ocultarVentana(){
	    var ventana = document.getElementById('dv_edicion');
	    ventana.style.marginTop = "100px";
	    ventana.style.left = ((document.body.clientWidth-350) / 2) +"px";
	    ventana.style.display = 'none';
	}

   function click_eliminar(){
   	$(".eliminar").click(function(){
   		var r = confirm("Seguro que desea eliminar este registro?"); //inidcar cual 
   		if(r == true){
   			var datos = {id: $(this).attr("id")};
			var datos_json = JSON.stringify(datos)
			
			enviar = {info: datos_json};
			//alert("d");
			$.ajax({
				type: "POST",
				data: enviar,
				url:"usuario_alerta/eliminar",
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

   function alertas(){
   		$.ajax({
			type: "POST",
			//data: enviar,
			url:"usuario_alerta/traer_alertas",
			//dataType:"json",
			success: function(res){
				
				
			$("#slt_alerta").append(res);
			$("#slt_EditarAlerta").append(res);

				
			}

		});
   }







});

