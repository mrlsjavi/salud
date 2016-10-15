<?php

class Registro_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info = json_decode($_POST['info']);
		   $general = new general_orm;

		 $r = $general::query("select Max(identificador) as identificador from usuario");
		   $identificador = '';
		   foreach ($r as $id) {
		      $identificador = $id['identificador']+1;
		   }
		  // echo "el identificador es :".$identificador;

		$data = array(
			'id'=>'',
			'rol'=>2,
			'nombre'=>$info->nombre,
			'login'=>$info->login, 
			'password'=>md5($info->password),
			'direccion'=>$info->direccion, 
			'telefono'=>$info->telefono,
			'identificador'=>$identificador,
			'estado'=>1);


		$registro = new usuario_orm($data);

		$result = $registro->save();

		$headers = "From: HWW@healthwithoutworries.com";
        $correo_destino= trim($info->login);

        $titulo = "Bienvenido a HWW";
        $mensaje  = "Gracias por registrase en HWW";

		$enviado = mail($correo_destino, $titulo, $mensaje, $headers);

	 	echo json_encode($result);
	}

	public function verificar_correo(){
		$info = json_decode($_POST['info']);
		$general = new general_orm;
		$result  = $general::query("select * from usuario where login ='".trim($info->correo)."' and estado = 1");
		if($result){
			echo "1";

		}
		else {
			echo "2";
		}

	}




	
}

?>