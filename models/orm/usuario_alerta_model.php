<?php

class Usuario_Alerta_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info = json_decode($_POST['info']);

		$usuario = usuario_orm::where('identificador', $info->usuario);
		$id=0;
		if($usuario){
			foreach($usuario as $u){
				$id =  $u->id;
			}
			$data = array(
				'id'=>'',
				'usuario'=>$id,
				'alerta'=>$info->alerta,
				'mail'=>$info->correo,
				'notificacion'=>$info->notificacion,
				'estado'=>1);
			$alerta = new usuario_alerta_orm($data);
			$result = $alerta->save();
			echo json_encode($result);
		}
		

	
	}


	public function llenar_tabla(){
		@session_start();
		//$roles = usuario_alerta_orm::where('estado', 1);
		$general = new general_orm;
		$roles = $general::query("select ua.id, ua.mail, ua.notificacion, u.nombre, a.nombre as alerta from usuario_alerta as ua 
									join usuario as u on ua.usuario = u.id
									join alerta as a on ua.alerta = a.id
									where ua.estado = 1 and ua.usuario =".Session::get('id'));

		$tabla = '<table id="javier" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>alerta</th>
                <th>Correo</th>
                <th>Notificacion</th>
                <th>Editar</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nombre</th>
                <th>alerta</th>
                <th>Correo</th>
                <th>Notificacion</th>
                <th>Editar</th>
                <th>Eliminar</th>
                
            </tr>
        </tfoot>
        <tbody id="">
         	
         	
        ';

        //validar si hay respuest//


$inputchecked = "<input type='checkbox' checked='checked'/>";
$input = "<input type='checkbox'/>";
		foreach ($roles as $r) {
			$tabla  = $tabla."<tr>
									<td>".$r['nombre']."</td>
									<td>".$r['alerta']."</td>
									<td>".$r['mail']."</td>";
			if($r['notificacion'] == 1){
				$tabla = $tabla."<td><input type='checkbox' checked='checked' disabled/></td>";
			}
			else{
				$tabla =  $tabla."<td><input type='checkbox' disabled/></td>";
			}
								
			$tabla = $tabla."<td class = 'editar'   id='".$r['id']."'><span class='btn btn-success'>Editar</span></td>
									<td class = 'eliminar' id='".$r['id']."'><span class='btn btn-danger'>Eliminar</span></td>";
		}

		$tabla = $tabla.'</tbody>
   		</table>';
		echo $tabla;
	}


	public function eliminar(){
		$info = json_decode($_POST['info']);

		$result = usuario_alerta_orm::eliminar_logico($info->id);

	 	echo json_encode($result);
	}

	public function traer_dato(){
		$info = json_decode($_POST['info']);

		$alerta = usuario_alerta_orm::where("id", $info->id);
		


		$result = array('cod' => 1, 'datos' => $alerta);

	 	echo json_encode($result);
	}

	public function actualizar(){
		$info = json_decode($_POST['info']);

		$usuario = usuario_alerta_orm::where('id', $info->id);
		$id=0;
		$user = 0;
		$alerta = 0;
		if($usuario){
			foreach($usuario as $u){
				$id =  $u->id;
				$user =  $u->usuario;
				$alerta = $u->alerta;
			}
			$data = array(
				'id'=>$info->id,
				'usuario'=>$user,
				'alerta'=>$alerta,
				'mail'=>$info->correo,
				'notificacion'=>$info->notificacion,
				'estado'=>1);
			$usuarioAlerta = new usuario_alerta_orm($data);
			$result = $usuarioAlerta->save();
			echo json_encode($result);
		}
		else{
			 $result = array('cod' => 1, 'msj' => 'fallo');
			 echo json_encode($result);
		}
	}

	public function traer_alertas(){
		@session_start();
		$general = new general_orm();

		$result = $general::query("select DISTINCT(a.id), a.nombre
										from alerta as a 
										join usuario_alerta as us on us.alerta = a.id and us.usuario =".Session::get('id')."
										where a.estado = 1");

		
		$select = "<option value='0'>Seleccione:</option>";

		if($result){
			foreach($result as $r){
				$select = $select."<option value='".$r['id']."'>".$r['nombre']."</option>";
			}
		}

		echo $select;
	}

	public function verificar_usuario(){
		$info = json_decode($_POST['info']);
		$usuario = usuario_orm::where('identificador', $info->usuario);
		if($usuario){
			echo "1";
		}
		else{
			echo "2";
		}
	}



}

?>
