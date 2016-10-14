<div class="col-lg-12">
	<h1>Administracion de Menu</h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" type="text" id="txt_nombre"/>
                </div>
                <div class="form-group">
                    <label>Mostrar</label>
                    <input class="form-control" type="text" id="txt_alias"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Orden</label>
                    <input class="form-control" type="number" id="txt_orden"/>
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
	<div id ="dv_tabla">
		
		
	</div>

<div id="dv_edicion">

	<div style="position:fixed"> 
		<label>Nombre</label>
		<input class="form-control" type="text" id="txt_EditarNombre"/>
		<br/>
		<br/>
		<label>Mostrar</label>
		<input class="form-control" type="text" id="txt_EditarAlias"/>
		<br/>
		<br/>
		<label>Orden</label>
		<input class="form-control" type="number" id="txt_EditarOrden"/>
		<input type="hidden" id="txt_EditarId"/>
		<br/>
		<br/>
		<button id="btn_actualizar">Guardar</button>
	</div>
</div>

</div>

