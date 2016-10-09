$(document).ready(function(){

	window.onload = function(){
		llenar_tabla();
		sensores();
	};
    
    $("#btn_guardar").click(function(){

    	 if($("#slt_sensor").val() == 0){
			alert("Seleccione un sensor");
			//ocultar div 
			//ocultarVentana();
		}
		else{
			var datos = {nombre: $("#txt_nombre").val(), sensor:$("#slt_sensor").val(), min:$("#txt_min").val(), max:$("#txt_max").val()};
			var datos_json = JSON.stringify(datos)
			
			enviar = {info: datos_json};
			//alert("d");
			$.ajax({
				type: "POST",
				data: enviar,
				url:"alerta/guardar",
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
					$("#txt_nombre").val(null);
					$("#txt_min").val(null);
					$("#txt_max").val(null);
					$("#slt_sensor").val('0').attr('selected', 'selected');
				}

			});
		}
    	

    });



    function sensores(){
    	$.ajax({
			type: "POST",
			//data: enviar,
			url:"alerta/sensores",
			//dataType:"json",
			success: function(res){
				$("#slt_sensor").append(res);
				$("#slt_EditarSensor").append(res);
				
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
			
			url:"alerta/llenar_tabla",
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
					url:"alerta/traer_dato",
					dataType:"json",
					success: function(res){
						console.log(res);
						
						$("#txt_EditarNombre").val(res.datos[0]['nombre']);
						$("#txt_EditarId").val(res.datos[0]['id']);
						$("#slt_EditarSensor").val(res.datos[0]['medida_sensor']).attr('selected', 'selected');
						$("#txt_EditarMin").val(res.datos[0]['umbral_min']);
						$("#txt_EditarMax").val(res.datos[0]['umbral_max']);
						mostrarVentana();
						editar();

						
					}

				});
   			}
   		});	
   }

   function editar (){

	   $("#btn_actualizar").click(function(){
	   		var datos = {nombre: $("#txt_EditarNombre").val(), sensor:$("#slt_EditarSensor").val(), min:$("#txt_EditarMin").val(), max:$("#txt_EditarMax").val(), id:$("#txt_EditarId").val()};
			var datos_json = JSON.stringify(datos)
			
				enviar = {info: datos_json};
				//alert("d");
				$.ajax({
					type: "POST",
					data: enviar,
					url:"alerta/actualizar",
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
				url:"alerta/eliminar",
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

