<?php

class Alerta_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info = json_decode($_POST['info']);

		$data = array(
			'id'=>'',
			'nombre'=>$info->nombre,
			'medida_sensor'=>$info->sensor,
			'umbral_min'=>$info->min,
			'umbral_max'=>$info->max,
			'estado'=>1);


		$alerta = new alerta_orm($data);

		$result = $alerta->save();

	 	echo json_encode($result);
	}


	public function llenar_tabla(){
		$alerta = alerta_orm::where('estado', 1);

		$tabla = '<table id="javier" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Sensor</th>
                <th>Medida</th>
                <th>Min</th>
                <th>Max</th>
                <th>Editar</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
            	<th>Nombre</th>
            	<th>Sensor</th>
                <th>Medida</th>
                <th>Min</th>
                <th>Max</th>
                <th>Editar</th>
                <th>Eliminar</th>
                
            </tr>
        </tfoot>
        <tbody id="">
         	
         	
        ';

        //validar si hay respuest
		foreach ($alerta as $a) {
			$tabla  = $tabla."<tr>
									<td>".$a->nombre."</td>
									<td>".$a->obj_medida_sensor->obj_sensor->titulo."</td>
									<td>".$a->obj_medida_sensor->obj_unidad_medida->titulo."</td>
									<td>".$a->umbral_min."</td>
									<td>".$a->umbral_max."</td>
									<td class = 'editar'   id='".$a->id."'>Editar</td>
									<td class = 'eliminar' id='".$a->id."'>Eliminar</td>";
		}

		$tabla = $tabla.'</tbody>
   		</table>';
		echo $tabla;
	}


	public function eliminar(){
		$info = json_decode($_POST['info']);

		$result = alerta_orm::eliminar_logico($info->id);

	 	echo json_encode($result);
	}

	public function traer_dato(){
		$info = json_decode($_POST['info']);

		$alerta = alerta_orm::where("id", $info->id);
		


		$result = array('cod' => 1, 'datos' => $alerta);

	 	echo json_encode($result);
	}

	public function actualizar(){
		$info = json_decode($_POST['info']);

		$data = array(
			'id'=>$info->id,
			'nombre'=>$info->nombre,
			'medida_sensor'=>$info->sensor,
			'umbral_min'=>$info->min,
			'umbral_max'=>$info->max,
			'estado'=>1);


		$alerta = new alerta_orm($data);

		$result = $alerta->save();

	 	echo json_encode($result);
	}

	public function sensores(){
		$general = new general_orm;

		$result = $general::query("select ms.id, s.titulo as sensor, ud.titulo as medida 
										from medida_sensor as ms 
										join unidad_medida as ud on ms.unidad_medida = ud.id and ud.estado =  1
										join sensor as s on ms.sensor = s.id and s.estado = 1
										where ms.estado =  1");

		$select = "<option value='0'>Seleccione:</option>";
		if($result){
			foreach($result as $r){
				$select = $select."<option value='".$r['id']."'>".$r['sensor']."-".$r['medida']."</option>";
			}
		}

		echo $select;
	}

}

?>