<?php
error_reporting(E_ERROR | E_PARSE);
class Bitacora_Model {

	public function __construct(){

			//parent::__construct();
	}

	public function guardar(){
		date_default_timezone_set('America/Guatemala');
		$info = json_decode(str_replace("\\", "", $_POST['info']));
		$dispositivo = dispositivo_orm::where('ip', $info->ip)[0];
		$data = $info->data;
		$datosArray = explode("|", $data);

		//Sensor Oxigeno
		$sensorPulso = medida_sensor_orm::find(1);
		$sensorOxigeno = medida_sensor_orm::find(2);

		//Sensor Oxigeno
		$sensorTemperatura = medida_sensor_orm::find(3);
		//Sensor Aire
		$sensorFlujoAire = medida_sensor_orm::find(6);
		//Sensor esfigmomanómetro
		$sensorDiastole = medida_sensor_orm::find(5);
		$sensorSistole = medida_sensor_orm::find(4);

		$datosPulsiometro = explode(",",$datosArray[0]);
		$fechaHora = new DateTime();

		$dataPulso = array(
			'id' => '',
			'usuario' => $dispositivo->usuario,
			'medida_sensor' => $sensorPulso->id,
			'dato' => $datosPulsiometro[0],
			'fecha_hora' => $fechaHora->format('Y-m-d H:i:s'),
		);

		$dataOxigeno = array(
			'id' => '',
			'usuario' => $dispositivo->usuario,
			'medida_sensor' => $sensorOxigeno->id,
			'dato' => $datosPulsiometro[1],
			'fecha_hora' => $fechaHora->format('Y-m-d H:i:s'),
		);

		$dataTemperatura = array(
			'id' => '',
			'usuario' => $dispositivo->usuario,
			'medida_sensor' => $sensorTemperatura->id,
			'dato' => $datosArray[1],
			'fecha_hora' => $fechaHora->format('Y-m-d H:i:s'),
		);

		$dataAirFlow = array(
			'id' => '',
			'usuario' => $dispositivo->usuario,
			'medida_sensor' => $sensorFlujoAire->id,
			'dato' => $datosArray[2],
			'fecha_hora' => $fechaHora->format('Y-m-d H:i:s'),
		);

		$datosEsfigmomanometro = explode(",",$datosArray[3]);
		$dataSistole = array(
			'id' => '',
			'usuario' => $dispositivo->usuario,
			'medida_sensor' => $sensorSistole->id,
			'dato' => $datosEsfigmomanometro[0],
			'fecha_hora' => $fechaHora->format('Y-m-d H:i:s'),
		);

		$dataDiastole = array(
			'id' => '',
			'usuario' => $dispositivo->usuario,
			'medida_sensor' => $sensorDiastole->id,
			'dato' => $datosEsfigmomanometro[1],
			'fecha_hora' => $fechaHora->format('Y-m-d H:i:s'),
		);

		$bitacoraPulso = new bitacora_orm($dataPulso);
		$bitacoraPulso->save();

		$bitacoraOxigeno = new bitacora_orm($dataOxigeno);
		$bitacoraOxigeno->save();

		$bitacoraTemperatura = new bitacora_orm($dataTemperatura);
		$bitacoraTemperatura->save();

		$bitacoraFlujoAire = new bitacora_orm($dataAirFlow);
		$bitacoraFlujoAire->save();

		$bitacoraSistole = new bitacora_orm($dataSistole);
		$bitacoraSistole->save();

		$bitacoraDiastole = new bitacora_orm($dataDiastole);
		$bitacoraDiastole->save();

		echo "Guardado Exitosamente";

	}

	public function historico(){
		header('Content-Type: application/json');
		$bitacoras = bitacora_orm::all();
		$listado = array();
		if($bitacoras ==null || count($bitacoras) == 0){
			header("HTTP/1.0 404 Not Found");
			http_response_code(404);
			return json_encode($listado);
		}
		foreach ($bitacoras as $bitacora) {
			$listado [] = array(
				'id' => $bitacora->id,
				'usuario' => array(
					'id' => $bitacora->obj_usuario->id,
					'rol' => $bitacora->obj_usuario->rol,
					'nombre' => $bitacora->obj_usuario->nombre,
					'login' => $bitacora->obj_usuario->login,
					'password' => $bitacora->obj_usuario->password,
					'direccion' => $bitacora->obj_usuario->direccion,
					'telefono' => $bitacora->obj_usuario->telefono,
					'estado' => $bitacora->obj_usuario->estado
				),
				'medidaSensor' => array(
					'id' => $bitacora->obj_medida_sensor->id,
					'sensor' => array(
						'id'=>$bitacora->obj_medida_sensor->obj_sensor->id,
						'titulo'=>$bitacora->obj_medida_sensor->obj_sensor->titulo,
						'descripcion' => $bitacora->obj_medida_sensor->obj_sensor->descripcion,
						'sensorType'=>$bitacora->obj_medida_sensor->obj_sensor->tipo,
						'estado'=>$bitacora->obj_medida_sensor->obj_sensor->estado,
					),
					'unidadMedida' => array(
						'id'=>$bitacora->obj_medida_sensor->obj_unidad_medida->id,
						'titulo'=>$bitacora->obj_medida_sensor->obj_unidad_medida->titulo,
						'estado'=>$bitacora->obj_medida_sensor->obj_unidad_medida->estado,
					),
					'estado' => $bitacora->obj_medida_sensor->estado
				),
				'id' => $bitacora->obj_medida_sensor->id,
				'dato' => $bitacora->dato,
				'fechaHora' => $bitacora->fecha_hora,
			);
		}

		echo json_encode($listado);
	}

	public function monitor_vivo(){
		header('Content-Type: application/json');
		$general = new general_orm();
		$bitacoras = $general::query("select * from bitacora where CAST(fecha_hora AS DATE) = CURDATE() order by fecha_hora desc limit 6");
		$listado = array();
		if($bitacoras ==null || count($bitacoras) == 0){
			header("HTTP/1.0 404 Not Found");
			http_response_code(404);
			return json_encode($listado);
		}
		foreach ($bitacoras as $bitacora) {
			$usuario = usuario_orm::find($bitacora['usuario']);
			$medidaSensor = medida_sensor_orm::find($bitacora['medida_sensor']);
			$listado [] = array(
				'id' => $bitacora['id'],
				'usuario' => array(
					'id' => $usuario->id,
					'rol' => $usuario->rol,
					'nombre' => $usuario->nombre,
					'login' => $usuario->login,
					'password' => $usuario->password,
					'direccion' => $usuario->direccion,
					'telefono' => $usuario->telefono,
					'estado' => $usuario->estado
				),
				'medidaSensor' => array(
					'id' => $medidaSensor->id,
					'sensor' => array(
						'id'=>$medidaSensor->obj_sensor->id,
						'titulo'=>$medidaSensor->obj_sensor->titulo,
						'sensorType'=>$medidaSensor->obj_sensor->tipo,
						'descripcion' => $medidaSensor->obj_sensor->descripcion,
						'estado'=>$medidaSensor->obj_sensor->estado,
					),
					'unidadMedida' => array(
						'id'=>$medidaSensor->obj_unidad_medida->id,
						'titulo'=>$medidaSensor->obj_unidad_medida->titulo,
						'estado'=>$medidaSensor->obj_unidad_medida->estado,
					),
					'estado' => $medidaSensor->estado
				),
				'dato' => $bitacora['dato'],
				'fechaHora' => $bitacora['fecha_hora']
			);
		}

		echo json_encode($listado);
	}

	public function historico_resumen(){
		header('Content-Type: application/json');
		$general = new general_orm();
		$consulta = 'select id, usuario, medida_sensor, avg(dato) as dato, CONCAT(YEAR(fecha_hora),"-" ,MONTH(fecha_hora), "-", 30) as fecha_hora from bitacora group by medida_sensor, YEAR(fecha_hora), MONTH(fecha_hora)';
		$bitacoras = $general::query($consulta);
		$listado = array();
		if($bitacoras ==null || count($bitacoras) == 0){
			header("HTTP/1.0 404 Not Found");
			http_response_code(404);
			return json_encode($listado);
		}
		foreach ($bitacoras as $bitacora) {
			$usuario = usuario_orm::find($bitacora['usuario']);
			$medidaSensor = medida_sensor_orm::find($bitacora['medida_sensor']);
			$listado [] = array(
				'id' => $bitacora['id'],
				'usuario' => array(
					'id' => $usuario->id,
					'rol' => $usuario->rol,
					'nombre' => $usuario->nombre,
					'login' => $usuario->login,
					'password' => $usuario->password,
					'direccion' => $usuario->direccion,
					'telefono' => $usuario->telefono,
					'estado' => $usuario->estado
				),
				'medidaSensor' => array(
					'id' => $medidaSensor->id,
					'sensor' => array(
						'id'=>$medidaSensor->obj_sensor->id,
						'titulo'=>$medidaSensor->obj_sensor->titulo,
						'descripcion' => $medidaSensor->obj_sensor->descripcion,
						'sensorType'=>$medidaSensor->obj_sensor->tipo,
						'estado'=>$medidaSensor->obj_sensor->estado,
					),
					'unidadMedida' => array(
						'id'=>$medidaSensor->obj_unidad_medida->id,
						'titulo'=>$medidaSensor->obj_unidad_medida->titulo,
						'estado'=>$medidaSensor->obj_unidad_medida->estado,
					),
					'estado' => $medidaSensor->estado
				),
				'dato' => $bitacora['dato'],
				'fechaHora' => $bitacora['fecha_hora']
			);
		}

		echo json_encode($listado);
	}



}

?>
