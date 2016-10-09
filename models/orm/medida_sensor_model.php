<?php

class Medida_Sensor_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info = json_decode($_POST['info']);
		$id = $info->nuevos;
		$sensor = $info->rol;

		$general = new general_orm;

		//tengo que recibir el id del rol tambien
		$longitud =  count($id);
		$nuevos='';
		for($i=0; $i<$longitud; $i++){
			if($i == ($longitud-1)){
				$nuevos = $nuevos.$id[$i];
			}
			else{
				$nuevos = $nuevos.$id[$i].',';
			}
			
		}

		//caso 1 agregar logico
		$result = $general::query("select id 
									from medida_sensor
									where unidad_medida in (".$nuevos.")
									and estado = 0
									and sensor = ".$sensor);

		if($result){
			foreach($result as $r){
				$general::query("update medida_sensor set estado = 1 where id =".$r['id']);
			}
		}
		$result = '';
		//caso2 eliminado logico
		$result = $general::query("select id 
									from medida_sensor
									where unidad_medida not in (".$nuevos.")
									and estado = 1
									and sensor = ".$sensor);

		if($result){
			foreach ($result as $r) {
				medida_sensor_orm::eliminar_logico($r['id']);
			}
		}
		$result = '';
		//caso 3 agregar los nuevos
		$result = $general::query("select p.id 
									from unidad_medida as p
									where p.id not in (select unidad_medida 
															from medida_sensor 
															where unidad_medida in (".$nuevos.")
															and sensor = ".$sensor."
															and estado = 1)
									and p.id in (".$nuevos.")");

		if($result){
			foreach($result as $r){
				$data = array(
					'id'=>'',
					'sensor'=>$sensor,
					'unidad_medida'=>$r['id'],
					'estado'=>1);
				$permiso = new medida_sensor_orm($data);
				$result = $permiso->save();
			}
		}

		echo "Cambios realizados";

//		echo $nuevos;
		//echo $id[0];
		

		/*$data = array(
			'id'=>'',
			'nombre'=>$info->nombre,
			'estado'=>1);


		$rol = new rol_orm($data);

		$result = $rol->save();

	 	echo json_encode($result);*/
	}


	public function llenar_tabla(){
		$roles = rol_orm::where('estado', 1);

		$tabla = '<table id="javier" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Eliminar</th>
                
            </tr>
        </tfoot>
        <tbody id="">
         	
         	
        ';

        //validar si hay respuest
		foreach ($roles as $r) {
			$tabla  = $tabla."<tr>
									<td>".$r->nombre."</td>
									<td class = 'editar'   id='".$r->id."'>Editar</td>
									<td class = 'eliminar' id='".$r->id."'>Eliminar</td>";
		}

		$tabla = $tabla.'</tbody>
   		</table>';
		echo $tabla;
	}

	public function traer_sensor(){
		$sensor = sensor_orm::where('estado', 1);
		$select = "<option value='0'>Seleccione:</option>";

		if($sensor){
			foreach($sensor as $s){
				$select = $select."<option value='".$s->id."'>".$s->titulo."</option>";
			}
		}

		echo $select;
	}

	public function traer_paginas(){
		
		$info = json_decode($_POST['info']);
		$sensor = $info->id;
		//tengo que validar si ese rol tiene o no tiene ya roles asignados

		$general = new general_orm;
		$result = $general::query("select u.id, u.titulo
										from unidad_medida as u 
										where u.id not in (select unidad_medida 
															from medida_sensor where sensor = ".$sensor."
															and estado  = 1)");

		
			$tabla = '<div class="div">
						<select name="origen[]" id="origen" multiple="multiple" size="8" class="select">';
			if($result){
				foreach($result as $r){
					$tabla = $tabla.'<option value="'.$r['id'].'">'.$r['titulo'].'</option>';
								
				}
			}
			$tabla = $tabla.'</select>
		</div>
		<div class ="div">
			<input type="button" class="pasar izq" value="Pasar »"><input type="button" class="quitar der" value="« Quitar"><br />
			<input type="button" class="pasartodos izq" value="Todos »"><input type="button" class="quitartodos der" value="« Todos">
		</div>
		<div class="div">
			<select name="destino[]" id="destino" multiple="multiple" size="8" class="select">';

			$result = $general::query("select u.id, u.titulo 
										from unidad_medida as u 
										join medida_sensor as ms on ms.unidad_medida = u.id where ms.sensor = ".$sensor." and ms.estado = 1
										and u.estado = 1");

			if($result){
			
			foreach($result as $r){
				$tabla = $tabla.'<option value="'.$r['id'].'">'.$r['titulo'].'</option>';
							
			}

			}	
			$tabla = $tabla.'</select>
		</div>
		<p class="clear"><input type="submit" class="submit" value="Guardar Cambios"></p>';
		

		echo $tabla;
	
	

	}
}

?>