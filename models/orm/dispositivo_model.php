<?php
error_reporting(E_ERROR | E_PARSE);
class Dispositivo_Model {
	public function __construct(){
			//parent::__construct();
	}
	public function guardar(){
		$info = json_decode($_POST['info']);
		$data = array(
			'id'=>'',
			'usuario'=>$info->usuario,
			'ip'=>$info->ip,
			'estado'=>1);
		$general = new general_orm();
		$result = $general::query("INSERT INTO dispositivo (usuario, ip, estado) values (".$data["usuario"].", '".$data["ip"]."'	,1);");
		//$result = $dispositivo->save();
		if($result){
				//array("cod"=>1, "msj"=> "Operacion realizada con exito");
				echo json_encode(array("cod"=>1, "msj"=> "Operacion realizada con exito"));
		}
	}
	public function llenar_tabla(){
		//$dispositivos = dispositivo_orm::where('estado', 1);
		$general = new general_orm();
		$dispositivos = $general::query("SELECT * FROM dispositivo WHERE estado = 1;");
		$tabla = '<table id="javier" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Usuario</th>
								<th>IP</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Usuario</th>
								<th>IP</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </tfoot>
        <tbody id="">
        ';
        //validar si hay respuest
		if($dispositivos!=null && count($dispositivos) > 0){
			foreach ($dispositivos as $d) {
				$usuario = usuario_orm::find($d['usuario']);
				$tabla  = $tabla."<tr style=\"text-align: center;\">
										<td>".$usuario->nombre."</td>
										<td>".$d['ip']."</td>
										<td class = 'editar'   id='".$d['id']."'>Editar</td>
										<td class = 'eliminar' id='".$d['id']."'>Eliminar</td>";
			}
		}
		$tabla = $tabla.'</tbody>
   		</table>';
		echo $tabla;
	}
	public function eliminar(){
		$info = json_decode($_POST['info']);
		$result = dispositivo_orm::eliminar_logico($info->id);
	 	echo json_encode($result);
	}
	public function traer_dato(){
		$info = json_decode($_POST['info']);
		$general = new general_orm();
		$dispositivo = $general::query("SELECT * FROM dispositivo WHERE id = ".$info->id.";");
		$result = array('cod' => 1, 'datos' => $dispositivo[0]);
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
			'usuario'=>$info->usuario,
			'ip'=>$info->ip,
			'estado'=>1);
		//$dispositivo = new dispositivo_orm($data);
		$general = new general_orm();
		$result = $general::query("UPDATE dispositivo SET usuario = ".$data['usuario'].", ip = '".$data['ip']."' WHERE id=".$data['id']);
		//$result = $dispositivo->save();
		if($result){
				//array("cod"=>1, "msj"=> "Operacion realizada con exito");
				echo json_encode(array("cod"=>1, "msj"=> "Operacion realizada con exito"));
		}
	}
}
?>