<div class="col-lg-12">
	<h1>Administracion de Dispostivo</h1>
	<div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Usuario</label>
                <select class="form-control" id="txt_usuario"></select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>IP</label>
                <input class="form-control" type="text" id="txt_ip" maxlength="20" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-right">
            <div class="form-group">
              <button id="btn_guardar" class="btn btn-primary">Guardar</button>
            </div>
        </div>
	</div>


	<br/>
	<br/>
	<div id ="dv_tabla">


	</div>

<div id="dv_edicion">

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
