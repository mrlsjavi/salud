<?php

class Rol_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info = json_decode($_POST['info']);

		$data = array(
			'id'=>'',
			'nombre'=>$info->nombre,
			'estado'=>1);


		$rol = new rol_orm($data);

		$result = $rol->save();

	 	echo json_encode($result);
	}


	public function llenar_tabla(){
		$roles = rol_orm::where('estado', 1);

		$tabla = '<div class="panel panel-default"><div class="panel-body"><table id="javier" class="display" cellspacing="0" width="100%">
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
									<td class = 'editar'   id='".$r->id."' data-toggle='modal' data-target='#dv_edicion' ><span class='btn btn-success'>Editar<span></td>
									<td class = 'eliminar' id='".$r->id."'><span class='btn btn-danger'>Eliminar</span></td>";
		}

		$tabla = $tabla.'</tbody>
   		</table></div></div>';
		echo $tabla;
	}


	public function eliminar(){
		$info = json_decode($_POST['info']);

		$result = rol_orm::eliminar_logico($info->id);

	 	echo json_encode($result);
	}

	public function traer_dato(){
		$info = json_decode($_POST['info']);

		$rol = rol_orm::where("id", $info->id);
		


		$result = array('cod' => 1, 'datos' => $rol);

	 	echo json_encode($result);
	}

	public function actualizar(){
		$info = json_decode($_POST['info']);

		$data = array(
			'id'=>$info->id,
			'nombre'=>$info->nombre,
			'estado'=>1);


		$rol = new rol_orm($data);

		$result = $rol->save();

	 	echo json_encode($result);
	}

}

?>
