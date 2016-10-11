<?php

require_once('ORM.php');
    require_once('config.php');
    require_once('general_orm.php');
    require_once('rol_orm.php');
    require_once('usuario_orm.php');
    require_once('alerta_orm.php');
    require_once('medida_sensor_orm.php');
    require_once('sensor_orm.php');
    require_once('unidad_medida_orm.php');
    
$user = usuario_orm::where_login(trim('mrlssjavi@gmail.com'), trim(md5('javier')));

	if($user){
		//echo "entro";
		$result = array('cod'=> 1, 'data' =>$user);
		print_r(json_encode($result));
				
	}
	else{
		$result = array('cod'=> 0, 'data' =>'');	
		print_r(json_encode($result));
	}


?>