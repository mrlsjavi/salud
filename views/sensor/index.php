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

<div id="dv_edicion" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <label>Titulo</label>
                <input class="form-control"  id="txt_EditarTitulo" maxlength="30"></input>
                <input type="hidden" id="txt_EditarId"/>
                <label>Descripcion</label>
                <input class="form-control" type="text" id="txt_EditarDescripcion" maxlength="75"/>
                <label>Codigo</label>
                <input class="form-control" type="text" id="txt_EditarCodigo" maxlength="2" />
            </div>
            <div class="modal-footer">
                <button id="btn_actualizar" class="btn btn-success" data-dismiss="modal">Actualizar</button>
            </div>
        </div>
	</div>
</div>


</div>
