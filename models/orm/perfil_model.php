<?php

class Perfil_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function actualizar(){
		@session_start();
		$info = json_decode($_POST['info']);
		$pass = '';
		$identificador = '';
		$usuario = usuario_orm::where('id', Session::get('id'));
		foreach ($usuario as $u) {
       
        	$pass = $u->password;
        	$identificador = $u->identificador;
        }

		$data = array(
			'id'=>Session::get('id'),
			'rol'=>2,
			'nombre'=>$info->nombre,
			'login'=>$info->login,
			'password'=>$pass,
			'direccion'=>$info->direccion,
			'telefono'=>$info->telefono,
			'identificador'=>$identificador,
			'estado'=>1);


		$usuario = new usuario_orm($data);

		$result = $usuario->save();

	 	echo json_encode($result);
	}

	public function datos(){
		@session_start();
		$usuario = usuario_orm::where('id', Session::get('id'));

		$result = array('cod' => 1, 'datos' => $usuario);

	 	echo json_encode($result);
	}

	public function clave(){
		@session_start();
		$info = json_decode($_POST['info']);

		$general = new general_orm;
		$result = $general::query("update usuario set password = '".md5($info->pass)."' where id = ".Session::get('id'));
		//$query="update usuario set password = '".md5($info->pass)."' where id = ".$info->id;

		$respuesta = '';
		if($result){
			$respuesta = array('cod' => 1, 'msj' => "guardado con Exito");
		}
		else{
			$respuesta = array('cod' => 1, 'msj' => "Un Error ha ocurrido");
		}

		


		

	 	echo json_encode($respuesta);
	}

	

}

?>