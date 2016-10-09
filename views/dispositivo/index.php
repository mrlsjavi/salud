<style type="text/css">
	.editar {color:blue;}
	.eliminar {color:red;}
</style>

<div>
	<div>
	<h1>Administracion de Dispostivo</h1>

	</div>

	<div>
		<label>Usuario</label>
		<select id="txt_usuario"></select>
		<br />
		<label>IP</label>
		<input type="text" id="txt_ip" maxlength="20" />
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
		<select  id="txt_EditarUsuario"></select>
		<input type="hidden" id="txt_EditarId"/>
		<br />
		<label>IP</label>
		<input type="text" id="txt_EditarIp" maxlength="20"/>
		<br/>
		<br/>
		<button id="btn_actualizar">Actualizar</button>
	</div>
</div>


</div>