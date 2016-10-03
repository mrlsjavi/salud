<style type="text/css">

	.editar {color:blue;}
	.eliminar {color:red;}
</style>

<div>
	<div>
	<h1>Asignacion de Alertas</h1>

	</div>

	<div>
		<label>Usuario</label>
		<input type="number" id="txt_usuario"/>
		<br/>
		<br/>
		<label>Alerta:</label>
		<select id="slt_alerta">
			
		</select>
		<br/>
		<br/>
		<label>Correo</label>
		<input type="text" id="txt_correo" />
		<br/>
		<br/>
		<label>Notificacion</label>
		<input type="checkbox" id="box"/>
		<br/>
		<br/>
		<button id="btn_guardar">Guardar</button>
		
	</div>
	
	
	<br/>
	<br/>
	<div id ="dv_tabla">
		
		
	</div>

<div id="dv_edicion" style=" padding: 20px; position:fixed; width:350px; height: 190px; top:0; left:0;   border:#333333 3px solid; background-color: #F8F8FF; color:#000000; display:none;" >

	<div style="position:fixed"> 
		<label>Usuario</label>
		<input type="text" id="txt_EditarUsuario" disabled/>
		<input type="hidden" id="txt_EditarId">
		<br/>
		<br/>
		<label>Alerta:</label>
		<select id="slt_EditarAlerta" disabled>
			
		</select>
		<br/>
		<br/>
		<label>Correo</label>
		<input type="text" id="txt_EditarCorreo" />
		<br/>
		<br/>
		<label>Notificacion</label>
		<input type="checkbox" id="EditarBox"/>
		<br/>
		<br/>
		<button id="btn_actualizar">Actualizar</button>
	</div>
</div>


</div>
