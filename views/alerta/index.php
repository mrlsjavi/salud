<style type="text/css">

	.editar {color:blue;}
	.eliminar {color:red;}
</style>

<div>
	<div>
	<h1>Administracion de Alertas</h1>

	</div>

	<div>
		<label>Nombre</label>
		<input type="text" id="txt_nombre"/>
		<br/>
		<br/>
		<label>Sensor</label>
		<select id="slt_sensor">
			
		</select>
		<br/>
		<br/>
		<label>Min</label>
		<input type="text" id="txt_min"/>
		<br/>
		<br/>
		<label>Max</label>
		<input type="text" id="txt_max"/>
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
		<label>Nombre</label>
		<input type="text" id="txt_EditarNombre"/>
		<input type="hidden" id="txt_EditarId"/>
		<br/>
		<br/>
		<label>Sensor</label>
		<select id="slt_EditarSensor">

		</select>
		<br/>
		<br/>
		<label>Min</label>
		<input type="text" id="txt_EditarMin" />
		<br/>
		<br/>
		<label>Max</label>
		<input type="text" id="txt_EditarMax"/>
		<br/>
		<br/>
		<button id="btn_actualizar">Actualizar</button>
	</div>
</div>


</div>
