<?php


class Bitacora_Model {

	public function __construct(){

			//parent::__construct();

	}

	public function guardar(){
		$info = json_decode($_POST['info']);
		$dispositivo = dispositivo_orm::where('ip', $info->ip);

		foreach ($info->data as $sensor) {
			$data = array(
				'id'=>'',
				'usuario'=>$dispositivo->usuario,
				'medida_sensor'=>$sensor->id_sensor,
				'dato' => $sensor->dato,
				'fecha_hora'=>$info->fecha_hora);
			$bitacora = new bitacora_orm($data);
			$result = $bitacora->save();
		}
	 	//echo json_encode($result);
	}

	public function historial(){
		$info = json_decode($_POST['info']);

		$pagina = bitacora_orm::all();
		$result = array('cod' => 1, 'datos' => $pagina);
	 	echo json_encode($result);
	}

}

?>
