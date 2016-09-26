<?php
error_reporting(E_ERROR | E_PARSE);
class Sensor_Model {

	public function __construct(){

			//parent::__construct();

	}

	public function guardar(){
		$info = json_decode($_POST['info']);

		$data = array(
			'id'=>'',
			'titulo'=>$info->titulo,
			'descripcion'=>$info->descripcion,
			'estado'=>1);

		$sensor = new sensor_orm($data);

		$result = $sensor->save();

		echo json_encode($result);
	}


	public function llenar_tabla(){
		$sensores = sensor_orm::where('estado', 1);
		$tabla = '<table id="javier" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Titulo</th>
								<th>Descripcion</th>
                <th>Editar</th>
                <th>Eliminar</th>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Titulo</th>
								<th>Descripcion</th>
                <th>Editar</th>
                <th>Eliminar</th>

            </tr>
        </tfoot>
        <tbody id="">


        ';

        //validar si hay respuest
		if($sensores!=null && count($sensores) > 0){
			foreach ($sensores as $s) {
				$tabla  = $tabla."<tr style=\"text-align: center;\">
										<td>".$s->titulo."</td>
										<td>".$s->descripcion."</td>
										<td class = 'editar'   id='".$s->id."'>Editar</td>
										<td class = 'eliminar' id='".$s->id."'>Eliminar</td>";
			}
		}

		$tabla = $tabla.'</tbody>
   		</table>';
		echo $tabla;
	}


	public function eliminar(){
		$info = json_decode($_POST['info']);

		$result = sensor_orm::eliminar_logico($info->id);

	 	echo json_encode($result);
	}

	public function traer_dato(){
		$info = json_decode($_POST['info']);
		$sensor = sensor_orm::find($info->id);

		$result = array('cod' => 1, 'datos' => $sensor);

	 	echo json_encode($result);
	}

	public function traer_usuarios(){
		$usuarios = usuario_orm::where('estado', 1);

		$result = array('cod' => 1, 'datos' => $usuarios);

		echo json_encode($result);
	}

	public function actualizar(){
		$info = json_decode($_POST['info']);

		$data = array(
			'id'=>$info->id,
			'titulo'=>$info->titulo,
			'descripcion'=>$info->descripcion,
			'estado'=>1);


		$sensor = new sensor_orm($data);
		$result = $sensor->save();

		echo json_encode($result);
	}

}

?>
