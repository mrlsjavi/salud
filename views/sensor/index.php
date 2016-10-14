<div class="col-lg-12">
	<h1>Administracion de Sensores</h1>
	<div class="row">
        <div class="col-lg-4">
            <label>Titulo</label>
            <input class="form-control" id="txt_titulo" maxlength="30"></input>
        </div>

        <div class="col-lg-4">
            <label>Descripcion</label>
            <input class="form-control" type="text" id="txt_descripcion" maxlength="75" />
        </div>

        <div class="col-lg-4">
            <label>Codigo</label>
            <input class="form-control" type="text" id="txt_codigo" maxlength="2" />
        </div>
	</div>
    <div class="row">
        <div class="col-lg-12 text-right">
		<button id="btn_guardar" class="btn btn-primary">Guardar</button>
        </div>
    </div>
	<div id ="dv_tabla"></div>

<div id="dv_edicion" style=" padding: 20px; position:fixed; width:350px; height: 190px; top:0; left:0;   border:#333333 3px solid; background-color: #F8F8FF; color:#000000; display:none;" >

	<div style="position:fixed">
		<label>Titulo</label>
		<input class="form-control"  id="txt_EditarTitulo" maxlength="30"></input>
		<input type="hidden" id="txt_EditarId"/>
		<br />
		<label>Descripcion</label>
		<input class="form-control" type="text" id="txt_EditarDescripcion" maxlength="75"/>
		<br/>
		<label>Codigo</label>
		<input class="form-control" type="text" id="txt_EditarCodigo" maxlength="2" />
		<br />
		<br/>
		<button id="btn_actualizar">Actualizar</button>
	</div>
</div>


</div>
