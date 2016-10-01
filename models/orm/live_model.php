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
		//ir a traer los valores
$graficos = '<h2>Vivo</h2>

	<div id="dv_izquierda" style="float:left">
		<div id="dv_oxigeno">
  		
			<div class="circles">

			    <div class="second circle">
			      <strong></strong>
			      <span>Oxigeno en<br> Sangre</span>
			    </div>
	   
		 	</div>
		</div>

		<br/>
		<br/>
		<div id="dv_temperatura">
			<div class="progress-bar">
				<strong>36</strong><i>º F</i>
				<br/>
				<span class="titulos">Temperatura </span>
			</div>

		</div>

	</div>


	<div id="dv_derecha" style="float:right">
			<div id="dv_pulso">		
				<img src= "'.URL.'public/images/pulso.gif" width="350" height="75"/>
				<strong>93</strong><i>bpm</i>
				<br/>
				<span class="titulos">Pulso</span>
			</div>
			<br/>
			<br/>
			<div id="dv_respiraciones">
				<strong>33</strong><i>bpm</i>
				<br/>
				<span class="titulos">Respiraciones</span>
			</div>
	</div>
  	

	<script type="text/javascript">
		$(".second.circle").circleProgress({
			  value: 0.50,
			  fill:{
			  	gradient: ["red", "orange"]
			  }
			  
			}).on("circle-animation-progress", function(event, progress) {
			  $(this).find("strong").html(parseInt(50 * progress) + "<i>%</i>");
			});
	</script>

	

	<script type="text/javascript">
		$(".progress-bar").gradientProgressBar({

				  value: 1.0, // percentage

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


	public function historial(){
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

 		echo $graficos;
	}


}

?>