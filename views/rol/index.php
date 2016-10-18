<div class="col-lg-12">
	<h1>Administracion de Roles</h1>
	<div class="form-group">
		<label>Nombre</label>
		<input  class="form-control" type="text" id="txt_nombre" class="form-control"/>
	</div>
	<div class="form-group text-right">
		<button id="btn_guardar" class="btn btn-primary">Guardar</button>
    </div>
    <div id ="dv_tabla"></div>

<div id="dv_edicion" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <label>Nombre</label>
                <input  class="form-control" type="text" id="txt_EditarNombre"/>
                <input type="hidden" id="txt_EditarId"/>
            </div>
            <div class="modal-footer">                
                <button id="btn_actualizar" class="btn btn-success" data-dismiss="modal">Actualizar</button>
            </div>
        </div>
	</div>
</div>


</div>
