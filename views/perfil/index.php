<style type="text/css">

	.editar {color:blue;}
	.eliminar {color:red;}
</style>

<div>
	<div>
		<h1>Perfil de Usuario</h1>

	</div>
	
	<div>
		<button id="btn_clave" class="editar">Reset Pass</button>
		<br/>
		<br/>
		<label>Nombre</label>
		<input type="text" id="txt_nombre"/>
		<br/>
		<br/>
		<label>Correo</label>
		<input type="text" id="txt_login"/>
		<br/>
		<br/>
		<label>Direccion</label>
		<input type="text" id="txt_direccion">
		<br/>
		<br/>
		<label>Identificador</label>
		<input type="text" id="txt_identificador"  readonly="readonly">
		<br/>
		<br/>
		<label>Telefono</label>
		<input type="text" id="txt_telefono">
		<br/>
		<br/>
		<button id="btn_guardar">Actualizar</button>
		
		
		
	</div>

	<br/>
	<br/>
	

	<div id="dv_clave" style=" padding: 20px; position:fixed; width:350px; height: 190px; top:0; left:0;   border:#333333 3px solid; background-color: #F8F8FF; color:#000000; display:none;" >
	<div style="position:fixed">
		<label>Nueva Clave:</label>
		<input type="password" id="txt_EditarPass"/>
		

	</div>
	<br/>
	<br/>
	<button id="btn_ActualizarClave">Guardar</button>

</div>





</div>