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

<div id="dv_edicion" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"> 
                <label>Nombre</label>
                <input class="form-control" type="text" id="txt_EditarNombre"/>

                <label>Mostrar</label>
                <input class="form-control" type="text" id="txt_EditarAlias"/>

                <label>Orden</label>
                <input class="form-control" type="number" id="txt_EditarOrden"/>
                <input type="hidden" id="txt_EditarId"/>
            </div>
            <div class="modal-footer">                
                <button id="btn_actualizar" class="btn btn-success">Guardar</button>
            </div>
        </div>
	</div>
</div>

</div>

