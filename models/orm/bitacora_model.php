<?php

class Bitacora_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info =   json_decode(str_replace("\\", "", $_POST['info']));
		print_r($info);
		
		//var_dump($info);
		/*foreach ($info as $i) {
			# code...
			echo $i->sensor;
		}*/

		
		
	}


	
}

?>