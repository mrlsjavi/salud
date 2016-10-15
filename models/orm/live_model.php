<?php

class Live_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info = json_decode($_POST['info']);

		$data = array(
			'id'=>'',
			'nombre'=>$info->nombre,
			'estado'=>1);


		$rol = new rol_orm($data);

		$result = $rol->save();

	 	echo json_encode($result);
	}

	public function vivo(){
		@session_start();
		$oxigeno = 0;
		$oxigeno_fecha = '';

		$temperatura = 0;
		$temperatura_fecha = '';
		$temperatura_unidad = '';

		$respiracion = 0;
		$respiracion_fecha = '';
		$respiracion_unidad = '';

		$pulso = 0;
		$pulso_fecha = '';
		$pulso_unidad = '';
		//ir a traer los valores
		$general = new general_orm;
		//-----------oxigeno
		$result = $general::query("select s.titulo, b.dato, um.titulo as unidad, b.fecha_hora
							from bitacora as b
							join usuario as u on b.usuario = u.id and u.id = ".Session::get('id')." 
							join medida_sensor as ms on b.medida_sensor = ms.id 
							join sensor as s on ms.sensor = s.id and s.titulo = 'oxigeno'
							join unidad_medida as um on ms.unidad_medida = um.id 
							order by b.id desc
							limit 1");

		if($result){
				foreach($result as $r){
					$oxigeno = $r['dato']/100;
					$oxigeno_fecha = $r['fecha_hora'];

					
				}
			}
		//-----------fin de oxigeno
			
		//-----------temperatura
		$result = $general::query("select s.titulo, b.dato, um.titulo as unidad, b.fecha_hora
							from bitacora as b
							join usuario as u on b.usuario = u.id and u.id = ".Session::get('id')." 
							join medida_sensor as ms on b.medida_sensor = ms.id 
							join sensor as s on ms.sensor = s.id and s.titulo = 'temperatura'
							join unidad_medida as um on ms.unidad_medida = um.id 
							order by b.id desc
							limit 1");

		if($result){
				foreach($result as $r){
					$temperatura = $r['dato']/100;
					$temperatura_fecha = $r['fecha_hora'];
					$temperatura_unidad  =$r['unidad'];
					
				}
			}
		//-----------fin de temperatura

		//-----------pulso
		$result = $general::query("select s.titulo, b.dato, um.titulo as unidad, b.fecha_hora
							from bitacora as b
							join usuario as u on b.usuario = u.id and u.id = ".Session::get('id')." 
							join medida_sensor as ms on b.medida_sensor = ms.id 
							join sensor as s on ms.sensor = s.id and s.titulo = 'pulso'
							join unidad_medida as um on ms.unidad_medida = um.id 
							order by b.id desc
							limit 1");

		if($result){
				foreach($result as $r){
					$pulso = $r['dato'];
					$pulso_fecha = $r['fecha_hora'];
					$pulso_unidad  =$r['unidad'];
					
				}
			}
		//-----------fin de pulso

		//-----------respiracion
		$result = $general::query("select s.titulo, b.dato, um.titulo as unidad, b.fecha_hora
							from bitacora as b
							join usuario as u on b.usuario = u.id and u.id = ".Session::get('id')." 
							join medida_sensor as ms on b.medida_sensor = ms.id 
							join sensor as s on ms.sensor = s.id and s.titulo = 'respiracion'
							join unidad_medida as um on ms.unidad_medida = um.id 
							order by b.id desc
							limit 1");

		if($result){
				foreach($result as $r){
					$respiracion = $r['dato'];
					$respiracion_fecha = $r['fecha_hora'];
					$respiracion_unidad  =$r['unidad'];
					
				}
			}
		//-----------fin de respiracion

		//mostrar resultados 
$graficos = '<h2>Monitor en Tiempo Real</h2>

	<div id="dv_izquierda" style="float:left">
		<div id="dv_oxigeno">
  		
			<div class="circles">

			    <div class="second circle">
			      <strong></strong>
			      <span>Oxigeno en<br> Sangre</span>
			      <span>'.$oxigeno_fecha.'</span>
			    </div>
	   
		 	</div>
		</div>

		<br/>
		<br/>
		<div id="dv_temperatura">
			<div class="progress-bar">
				<strong>'.($temperatura*100).'</strong><i>º '.$temperatura_unidad.'</i>
				<br/>
				<span class="titulos">Temperatura </span>
				<span class="titulos">'.$temperatura_fecha.'</span>
			</div>

		</div>

	</div>


	<div id="dv_derecha" style="float:right">
			<div id="dv_pulso">		
				<img src= "'.URL.'public/images/pulso.gif" width="350" height="75"/>
				<strong>'.$pulso.'</strong><i> '.$pulso_unidad.'</i>
				<br/>
				<span class="titulos">Pulso</span>
				<span class="titulos">'.$pulso_fecha.'</span>
			</div>
			<br/>
			<br/>
			<div id="dv_respiraciones">
				<strong>'.$respiracion.'</strong><i> '.$respiracion_unidad.'</i>
				<br/>
				<span class="titulos">Respiraciones</span>
				<span class="titulos">'.$respiracion_fecha.'</span>
			</div>
	</div>
  	

	<script type="text/javascript">
		$(".second.circle").circleProgress({
			  value: '.$oxigeno.',
			  fill:{
			  	gradient: ["red", "orange"]
			  }
			  
			}).on("circle-animation-progress", function(event, progress) {
			  $(this).find("strong").html(parseInt('.($oxigeno*100).' * progress) + "<i>%</i>");
			});
	</script>

	

	<script type="text/javascript">
		$(".progress-bar").gradientProgressBar({

				  value: '.$temperatura.', // percentage

				  size: 300, // width

				  fill: { // gradient fill

				      gradient: ["green", "yellow", "red"]

				  }

		});

	</script>
	<br/>
	<br/>';

	echo $graficos;
	}


	public function select(){
		$sensor = sensor_orm::where('estado', 1);
		$select = "<option value='0'>Seleccione:</option>";

		if($sensor){
			foreach($sensor as $s){
				$select = $select."<option value='".$s->id."'>".$s->titulo."</option>";
			}
		}

		echo $select;
	}


	public function generar_puntos(){
		
		$meses = array();
		for($i = 0; $i<12; $i++){
			$meses[$i] = 0;

		}
		
		for($i = 1; $i<13; $i++){
			$datos = $general::query("select avg(b.dato) as dato
										from bitacora as b 
										join medida_sensor as ms on b.medida_sensor = ms.id and ms.sensor = ".$info->sensor."
										join sensor as s on ms.sensor = s.id
										join unidad_medida as um on ms.unidad_medida = um.id 
										where b.usuario =  2 and YEAR(b.fecha_hora) = '".$info->anio."' and MONTH(b.fecha_hora) ='".$i."' 
										Group by um.titulo");

			if($datos){
				foreach($datos as $d){
					$meses[$i-1] = $d['dato'];
					
				}
			}
		}

		//escribir datos en los puntos 
		$puntos1 = "data : [".$meses[0].",".$meses[1].",".$meses[2].",".$meses[3].",".$meses[4].",".$meses[5].",".$meses[6].",".$meses[7].",".$meses[8].",".$meses[9].",".$meses[10].",".$meses[11]."]";

			
	}

	

	
	

	public function historial(){
		@session_start();
		$info = json_decode($_POST['info']);
		$general = new general_orm();
		if($info->sensor==3){
				$meses = array();
				$meses2 = array();
				for($i = 0; $i<12; $i++){
					$meses[$i] = 0;
					$meses2[$i] = 0;

				}
				//sistolica
				for($i = 1; $i<13; $i++){
					$datos = $general::query("select avg(b.dato) as dato
												from bitacora as b 
												join medida_sensor as ms on b.medida_sensor = ms.id and ms.sensor = ".$info->sensor."
												join sensor as s on ms.sensor = s.id
												join unidad_medida as um on ms.unidad_medida = um.id and um.titulo = 'sistolica'
												where b.usuario =  ".Session::get('id')." and YEAR(b.fecha_hora) = '".$info->anio."' and MONTH(b.fecha_hora) ='".$i."' 
												Group by um.titulo");

					if($datos){
						foreach($datos as $d){
							$meses[$i-1] = $d['dato'];
							
						}
					}
				}
				//distolica
				for($i = 1; $i<13; $i++){
					$datos = $general::query("select avg(b.dato) as dato
												from bitacora as b 
												join medida_sensor as ms on b.medida_sensor = ms.id and ms.sensor = ".$info->sensor."
												join sensor as s on ms.sensor = s.id
												join unidad_medida as um on ms.unidad_medida = um.id and um.titulo = 'distolica'
												where b.usuario =  ".Session::get('id')." and YEAR(b.fecha_hora) = '".$info->anio."' and MONTH(b.fecha_hora) ='".$i."' 
												Group by um.titulo");

					if($datos){
						foreach($datos as $d){
							$meses2[$i-1] = $d['dato'];
							
						}
					}
				}
				//escribir datos en los puntos 
				$puntos1 = "data : [".$meses[0].",".$meses[1].",".$meses[2].",".$meses[3].",".$meses[4].",".$meses[5].",".$meses[6].",".$meses[7].",".$meses[8].",".$meses[9].",".$meses[10].",".$meses[11]."]";
				$puntos2 = "data : [".$meses2[0].",".$meses2[1].",".$meses2[2].",".$meses2[3].",".$meses2[4].",".$meses2[5].",".$meses2[6].",".$meses2[7].",".$meses2[8].",".$meses2[9].",".$meses2[10].",".$meses2[11]."]";

				
				
				$graficos = '<div id="canvas-holder">
		 		<canvas id="chart-area4" width="800" height="300"></canvas>
		 		
			</div>

			<script type="text/javascript">
		 			var lineChartData = {
					labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
					datasets : [
						{
							label: "Primera serie de datos",
							fillColor : "rgba(220,220,220,0.2)",
							strokeColor : "#6b9dfa",
							pointColor : "#1e45d7",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(220,220,220,1)",
							'.$puntos1.'
						},
						{
							label: "Segunda serie de datos",
							fillColor : "rgba(151,187,205,0.2)",
							strokeColor : "#e9e225",
							pointColor : "#faab12",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(151,187,205,1)",
							'.$puntos2.'
						}
					]

				}

				var ctx4 = document.getElementById("chart-area4").getContext("2d");
				//window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:true});
				window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:false});

		 		</script>';

		 		echo $graficos;
		}
		else{

		$meses = array();
		for($i = 0; $i<12; $i++){
			$meses[$i] = 0;

		}
		
		for($i = 1; $i<13; $i++){
			$datos = $general::query("select avg(b.dato) as dato
										from bitacora as b 
										join medida_sensor as ms on b.medida_sensor = ms.id and ms.sensor = ".$info->sensor."
										join sensor as s on ms.sensor = s.id
										join unidad_medida as um on ms.unidad_medida = um.id 
										where b.usuario =  ".Session::get('id')." and YEAR(b.fecha_hora) = '".$info->anio."' and MONTH(b.fecha_hora) ='".$i."' 
										Group by um.titulo");

			if($datos){
				foreach($datos as $d){
					$meses[$i-1] = $d['dato'];
					
				}
			}
		}

		//escribir datos en los puntos 
		$puntos1 = "data : [".$meses[0].",".$meses[1].",".$meses[2].",".$meses[3].",".$meses[4].",".$meses[5].",".$meses[6].",".$meses[7].",".$meses[8].",".$meses[9].",".$meses[10].",".$meses[11]."]";

		
		
		$graficos = '<div id="canvas-holder">
 		<canvas id="chart-area4" width="800" height="300"></canvas>
 		
	</div>

	<script type="text/javascript">
 			var lineChartData = {
			labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			datasets : [
				{
					label: "Primera serie de datos",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "#6b9dfa",
					pointColor : "#1e45d7",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					'.$puntos1.'
				}
				
			]

		}

		var ctx4 = document.getElementById("chart-area4").getContext("2d");
		//window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:true});
		window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:false});

 		</script>';

 		echo $graficos;
		}
	}

	/*
		$graficos = '<div id="canvas-holder">
 		<canvas id="chart-area4" width="600" height="300"></canvas>
 		
	</div>

	<script type="text/javascript">
 			var lineChartData = {
			labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio"],
			datasets : [
				{
					label: "Primera serie de datos",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "#6b9dfa",
					pointColor : "#1e45d7",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [90,30,10,80,15,5,15]
				},
				{
					label: "Segunda serie de datos",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "#e9e225",
					pointColor : "#faab12",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [40,50,70,40,85,55,15]
				}
			]

		}

		var ctx4 = document.getElementById("chart-area4").getContext("2d");
		//window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:true});
		window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:false});

 		</script>';
	*/


	public function llenar_tabla(){
		@session_start();
		$info = json_decode($_POST['info']);
		$general = new general_orm();
		$tiene_datos = 0;


		$tabla = "<table id='tb_historial' class='table table-striped'>
					<thead>
						<tr>
							<th>Dia</th>
							<th>Unidad</th>
							<th>Promedio</th>
							
							
						</tr>
					</thead>
					<tbody>";

		for($i=1; $i<32; $i++){
			$datos = $general::query("select avg(b.dato) as dato, um.titulo, DAY(b.fecha_hora) as dia
										from bitacora as b 
										join medida_sensor as ms on b.medida_sensor = ms.id and ms.sensor = ".$info->sensor."
										join sensor as s on ms.sensor = s.id
										join unidad_medida as um on ms.unidad_medida = um.id 
										where b.usuario =  ".Session::get('id')." and YEAR(b.fecha_hora) = '".$info->anio."' and MONTH(b.fecha_hora) ='".$info->mes."' and DAY(b.fecha_hora) = '".$i."' 
										Group by um.titulo");

			if($datos){
				$tiene_datos++;
				foreach($datos as $d){
					$tabla = $tabla."<tr>
										<td>".$d['dia']."</td>
										<td>".$d['titulo']."</td>
										<td>".$d['dato']."</td>
									</tr>";
				}
			}
		}

		if($tiene_datos == 0){
			$tabla = $tabla."<tr><td colspan='3'>No tiene registros</td></tr>";
		}

		

		$tabla = $tabla."</tbody>
						</table>";

		echo $tabla;
	}


}

?>