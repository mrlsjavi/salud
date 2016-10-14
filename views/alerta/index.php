<div class="col-lg-12">
	<div>
	<h1>Administracion de Alertas</h1>

	</div>

	<div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" type="text" id="txt_nombre"/>
            </div>
            <div class="form-group">
                <label>Sensor</label>
                <select class="form-control" id="slt_sensor"></select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Min</label>
                <input class="form-control" type="text" id="txt_min"/>
            </div>
            <div class="form-group">
                <label>Max</label>
                <input class="form-control" type="text" id="txt_max"/>
            </div>
        </div>
        <div class="col-lg-12 text-right">
            <button class="btn btn-primary" id="btn_guardar">Guardar</button>
        </div>
	</div>

	<div id ="dv_tabla">
		
	</div>

<div id="dv_edicion">
	<div style="position:fixed"> 
		<label>Nombre</label>
		<input class="form-control" type="text" id="txt_EditarNombre"/>
		<input type="hidden" id="txt_EditarId"/>
		<br/>
		<br/>
		<label>Sensor</label>
		<select id="slt_EditarSensor">

		</select>
		<br/>
		<br/>
		<label>Min</label>
		<input class="form-control" type="text" id="txt_EditarMin" />
		<br/>
		<br/>
		<label>Max</label>
		<input class="form-control" type="text" id="txt_EditarMax"/>
		<br/>
		<br/>
		<button id="btn_actualizar">Actualizar</button>
	</div>
</div>


</div>
