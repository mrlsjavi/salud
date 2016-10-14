
<?php
error_reporting(E_ERROR | E_PARSE);
class Unidad_Medida_Model {
	public function __construct(){
			//parent::__construct();
	}
	public function guardar(){
		$info = json_decode($_POST['info']);
		$data = array(
			'id'=>'',
			'titulo'=>$info->titulo,
			'estado'=>1);
		$medida = new unidad_medida_orm($data);
		$result = $medida->save();
		echo json_encode($result);
	}
	public function llenar_tabla(){
		$medidas = unidad_medida_orm::where('estado', 1);
		$tabla = '<table id="javier" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Titulo</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </tfoot>
        <tbody id="">
        ';
        //validar si hay respuest
		if($medidas!=null && count($medidas) > 0){
			foreach ($medidas as $s) {
				$tabla  = $tabla."<tr style=\"text-align: center;\">
										<td>".$s->titulo."</td>
										<td class = 'editar'   id='".$s->id."'><span class='btn btn-success'>Editar</span></td>
										<td class = 'eliminar' id='".$s->id."'><span class='btn btn-danger'>Eliminar</span></td>";
			}
		}
		$tabla = $tabla.'</tbody>
   		</table>';
		echo $tabla;
	}
	public function eliminar(){
		$info = json_decode($_POST['info']);
		$result = unidad_medida_orm::eliminar_logico($info->id);
	 	echo json_encode($result);
	}
	public function traer_dato(){
		$info = json_decode($_POST['info']);
		$medida = unidad_medida_orm::find($info->id);
		$result = array('cod' => 1, 'datos' => $medida);
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
			'estado'=>1);
		$medida = new unidad_medida_orm($data);
		$result = $medida->save();
		echo json_encode($result);
	}
}
?>
