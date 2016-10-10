<?php

class Bitacora_Model {

	public function __construct(){

			//parent::__construct();

	}

	public function guardar(){
		$info = json_decode(str_replace("\\", "", $_POST['info']));
		$dispositivo = dispositivo_orm::where('ip', $info->ip);

		$data = $info->data;
		$datosArray = explode("|", $data);

		//Sensor Oxigeno
		$sensorOxigeno = sensor_orm::find(1);
		//Sensor Oxigeno
		$sensorTemperatura = sensor_orm::find(2);
		//Sensor Aire
		$sensorFlujoAire = sensor_orm::find(3);
		//Sensor Aire
		$sensorPresion = sensor_orm::find(4);

		


		$
		//var_dump($info);
		/*foreach ($info as $i) {
			# code...
			echo $i->sensor;
		}*/



	}



}

?>
