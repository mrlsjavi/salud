<?php


class Usuario_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info = json_decode($_POST['info']);
		

		$data = array(
			'id'=>'',
			'nombre'=>$info->nombre,
			'login'=>$info->login,
			'password'=>md5($info->password),
			'rol'=>$info->rol,
			'estado'=>1);


		$usuario = new usuario_orm($data);

		$result = $usuario->save();

	 	echo json_encode($result);
	}


	public function traer_roles(){
		$roles = rol_orm::where('estado', 1);
		$select = "<option value='0'>Seleccione:</option>";

		if($roles){
			foreach($roles as $r){
				$select = $select."<option value='".$r->id."'>".$r->nombre."</option>";
			}
		}

		echo $select;
	}

	public function llenar_tabla(){
		$usuarios = usuario_orm::where('estado', 1);

		$tabla = '<div class="panel panel-default"><div class="panel-body"><table id="javier" class="table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Login</th>
                <th>Rol</th>
                <th>Editar</th>
                <th>Clave</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
               	<th>Nombre</th>
                <th>Rol</th>
                <th>Login</th>
                <th>Editar</th>
                <th>Clave</th>
                <th>Eliminar</th>
                
            </tr>
        </tfoot>
        <tbody id="">
         	
         	
        ';

        //validar si hay respuest
		foreach ($usuarios as $u) {
			$tabla  = $tabla."<tr>
									<td>".$u->nombre."</td>
									<td>".$u->login."
									<td>".$u->obj_rol->nombre."
									<td class = 'editar'   id='".$u->id."'><span class='btn btn-success'>Editar</span></td>
									<td class = 'clave'   id='".$u->id."'><span class='btn btn-warning'>Cambiar</span></td>
									<td class = 'eliminar' id='".$u->id."'><span class='btn btn-danger'>Eliminar</span></td>";
		}

		$tabla = $tabla.'</tbody>
   		</table></div></div>';
		echo $tabla;
	}

	public function traer_dato(){
		$info = json_decode($_POST['info']);

		$usuario = usuario_orm::where("id", $info->id);
		
		


		$result = array('cod' => 1, 'datos' => $usuario);

	 	echo json_encode($result);
	}

	public function actualizar(){
		$info = json_decode($_POST['info']);

		$general = new general_orm;
		$result = $general::query("update usuario set nombre = '".$info->nombre."', login = '".$info->login."', rol =".$info->rol." where id = ".$info->id);

		$respuesta = '';
		if($result){
			$respuesta = array('cod' => 1, 'msj' => "guardado con Exito");
		}
		else{
			$respuesta = array('cod' => 1, 'msj' => "Un Error ha ocurrido");
		}



		

	 	echo json_encode($respuesta);
	}

	public function eliminar(){
		$info = json_decode($_POST['info']);

		$result = usuario_orm::eliminar_logico($info->id);

	 	echo json_encode($result);
	}

	public function clave(){
		$info = json_decode($_POST['info']);

		$general = new general_orm;
		$result = $general::query("update usuario set password = '".md5($info->pass)."' where id = ".$info->id);
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
