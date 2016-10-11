$(document).ready(function(){
	window.onload = function(){
			tiempo_real();
			llenar_select();
			//historial();
			//llenar_tabla();
			//exportar();


	};

	setInterval(tiempo_real, 300000);

	function prueba (){
		alert("va uno");
	}

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
		var datos = {sensor: $("#slt_sensor").val(), anio:$("#slt_anio").val()};
		var datos_json = JSON.stringify(datos);
		
		enviar = {info: datos_json};
		$.ajax({
			type: "POST",
			data: enviar,
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

	

	$("#btn_buscar").click(function(){
		if($("#slt_sensor").val() != 0){
			llenar_tabla();
			historial();
		}
		else{
			alert("seleccioine un sensor valido");
		}		
	});

	function  llenar_tabla(){
		var datos = {sensor: $("#slt_sensor").val(), mes:$("#slt_mes").val(), anio:$("#slt_anio").val()};
		var datos_json = JSON.stringify(datos);
		
		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"live/llenar_tabla",
	//		dataType:"json",
			success: function(res){
				$("#dv_tabla").empty();
				$("#dv_tabla").append(res);
				generar_pdf();
				

				
				
			}

		});
	}

	
		$("#btn_excel").click(function(){
		//$('#javier').tableExport({type:'pdf',escape:'false'});
		var datos = {sensor: $("#slt_sensor").val(), mes:$("#slt_mes").val(), anio:$("#slt_anio").val()};
		var datos_json = JSON.stringify(datos);
		
		enviar = {info: datos_json};
		//alert("d");
		$.ajax({
			type: "POST",
			data: enviar,
			url:"live/llenar_tabla",
	//		dataType:"json",
			success: function(res){
				generar_excel(res);
				

				
				
			}

		});
			
		});

		function generar_excel(tabla){
			var htmls = "";
            var uri = 'data:application/vnd.ms-excel;base64,';
            var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'; 
            var base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            };

            var format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            };
            //voy a ir a traerlo
           // htmls = "<table><thead><tr><th>Nombre</th></tr></thead><tbody><tr><td>javier</td><td>javier</td><td>javier</td></tr></tbody></table>";
           	htmls = tabla;
            //;
            var ctx = {
                worksheet : 'Worksheet',
                table : htmls
            }


            var link = document.createElement("a");
            link.download = "export.xls";
            link.href = uri + base64(format(template, ctx));
            link.click();
		}

		function generar_pdf(){
			$("#btn_pdf").click(function(){
				$('#tb_historial').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});
			})	
			
		}


		
	
	

	 
})

