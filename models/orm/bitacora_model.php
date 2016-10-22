<?php
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

		$oxigeno = sensor_orm::where('tipo', 'PO')[0];
		//Sensor Oxigeno
		$medidaSensores = medida_sensor_orm::where('sensor', $oxigeno->id);
		if($medidaSensores[0]->obj_unidad_medida->titulo == '%SPo2'){
				$sensorOxigeno = $medidaSensores[0];
				$sensorPulso = $medidaSensores[1];
		}else{
			$sensorOxigeno = $medidaSensores[1];
			$sensorPulso = $medidaSensores[0];
		}

		$temperatura = sensor_orm::where('tipo', 'TP')[0];
		//Sensor Temperatura
		$sensorTemperatura = medida_sensor_orm::where('sensor', $temperatura->id)[0];

		$aire = sensor_orm::where('tipo', 'BS')[0];
		//Sensor Aire
		$sensorFlujoAire = medida_sensor_orm::where('sensor', $aire->id)[0];


		$presion = sensor_orm::where('tipo', 'BP')[0];
		$medidaSensoresP = medida_sensor_orm::where('sensor', $presion->id);
		//Sensor esfigmomanómetro
		if($medidaSensoresP[0]->obj_unidad_medida->titulo == 'SISmmHg'){
				$sensorSistole = $medidaSensoresP[0];
				$sensorDiastole = $medidaSensoresP[1];
		}else{
			$sensorSistole = $medidaSensoresP[1];
			$sensorDiastole = $medidaSensoresP[0];
		}

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
		//$bitacoraSistole->save();

		$bitacoraDiastole = new bitacora_orm($dataDiastole);
		//$bitacoraDiastole->save();

		$usuarioAlerta = usuario_alerta_orm::where('usuario', $dispositivo->usuario);
		if($usuarioAlerta!=null && count($usuarioAlerta) > 0){
			foreach ($usuarioAlerta as $alerta) {
				$mensaje = "";
				$enviar = false;
				switch ($alerta->obj_alerta->medida_sensor) {
					case $sensorPulso->id:
						if($datosPulsiometro[0] < $alerta->obj_alerta->umbral_min){
							$enviar = true;
							$mensaje = "El ".$alerta->obj_alerta->obj_medida_sensor->obj_unidad_medida->titulo. " se encuentra debajo de: ".$alerta->obj_alerta->umbral_min.", su valor actual es de: ".$datosPulsiometro[0];
						}else if($datosPulsiometro[0] > $alerta->obj_alerta->umbral_max){
							$enviar = true;
							$mensaje = "El ".$alerta->obj_alerta->obj_medida_sensor->obj_unidad_medida->titulo. " se encuentra por encima de: ".$alerta->obj_alerta->umbral_min.", su valor actual es de: ".$datosPulsiometro[0];
						}
						break;
					case $sensorOxigeno->id:
						if($datosPulsiometro[1] < $alerta->obj_alerta->umbral_min) {
							$enviar = true;
							$mensaje = "El ".$alerta->obj_alerta->obj_medida_sensor->obj_unidad_medida->titulo. " se encuentra debajo de: ".$alerta->obj_alerta->umbral_min.", su valor actual es de: ".$datosPulsiometro[1];
						}else if($datosPulsiometro[1] > $alerta->obj_alerta->umbral_max){
							$enviar = true;
							$mensaje = "El ".$alerta->obj_alerta->obj_medida_sensor->obj_unidad_medida->titulo. " se encuentra por encima de: ".$alerta->obj_alerta->umbral_min.", su valor actual es de: ".$datosPulsiometro[1];
						}
						break;
					case $sensorTemperatura->id:
						if($datosArray[1] < $alerta->obj_alerta->umbral_min){
							$enviar = true;
							$mensaje = "El ".$alerta->obj_alerta->obj_medida_sensor->obj_unidad_medida->titulo. " se encuentra debajo de: ".$alerta->obj_alerta->umbral_min.", su valor actual es de: ".$datosArray[1];
						}else if($datosArray[1] > $alerta->obj_alerta->umbral_max){
							$enviar = true;
							$mensaje = "El ".$alerta->obj_alerta->obj_medida_sensor->obj_unidad_medida->titulo. " se encuentra por encima de: ".$alerta->obj_alerta->umbral_min.", su valor actual es de: ".$datosArray[1];
						}
						break;

					case $sensorFlujoAire->id:
						if($datosArray[2] < $alerta->obj_alerta->umbral_min){
							$enviar = true;
							$mensaje = "El ".$alerta->obj_alerta->obj_medida_sensor->obj_unidad_medida->titulo. " se encuentra debajo de: ".$alerta->obj_alerta->umbral_min.", su valor actual es de: ".$datosArray[2];
						}else if($datosArray[2] > $alerta->obj_alerta->umbral_max){
							$enviar = true;
							$mensaje = "El ".$alerta->obj_alerta->obj_medida_sensor->obj_unidad_medida->titulo. " se encuentra por encima de: ".$alerta->obj_alerta->umbral_min.",  su valor actual es de: ".$datosArray[2];
						}
						break;
					}

					if($alerta->mail && $enviar){
						$headers = "From: HWW@healthwithoutworries.com";
						$correo_destino= $alerta->mail;

						$titulo = "Alerta Sensor: ".$alerta->obj_alerta->obj_medida_sensor->obj_sensor->titulo;
						$enviado = mail($correo_destino, $titulo, $mensaje, $headers);
					}
					if($alerta->notificacion && $enviar){
						$url = 'https://fcm.googleapis.com/fcm/send';
						$notificar = notificacion_orm::where('usuario', $dispositivo->usuario)[0];
						$registrationIds = array($notificar->token);
						// prep the bundle
						$msg = array
						(
							'text' 	=> $mensaje,
							'title'		=> $titulo,
							'vibrate'	=> 1,
							'sound'		=> 1,
						);
						$fields = array
						(
							'registration_ids' 	=> $registrationIds,
							'notification'			=> $msg
						);

						$headers = array
						(
							'Authorization: key=AIzaSyCZb_t_DKsOV6oua0LF46pE8PK8HeRXxZc',
							'Content-Type: application/json'
						);

						$ch = curl_init();
						curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
						curl_setopt( $ch,CURLOPT_POST, true );
						curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
						curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
						curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
						curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
						$result = curl_exec($ch );
						curl_close( $ch );
						echo $result;
					}
			 }
		}


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
