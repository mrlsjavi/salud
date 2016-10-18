<div class="col-lg-12">
	<h1>Asignacion de Alertas</h1>
	<div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Usuario</label>
                <input class="form-control" type="number" id="txt_usuario"/>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label>Alerta:</label>
                <select class="form-control" id="slt_alerta"></select>

            </div>
        </div>

        <div class="col-lg-3">
            <div class="form-group">
                <label>Correo</label>
                <input class="form-control"type="text" id="txt_correo" />
            </div>
        </div>

        <div class="col-lg-1 checkbox-mod">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="box"/> Notificacion
                </label>
            </div>
        </div>

        <div class="col-lg-12 text-right">
            <button id="btn_guardar" class="btn btn-primary">Guardar</button>
        </div>
    </div>
	<div id ="dv_tabla">
		
		
	</div>

<div id="dv_edicion" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cambio de Contraseña</h4>
            </div>
            <div class="modal-body">
                <label>Usuario</label>
                <input class="form-control"type="text" id="txt_EditarUsuario" disabled/>
                <input class="form-control" type="hidden" id="txt_EditarId">


                <label>Alerta:</label>
                <select  class="form-control" id="slt_EditarAlerta" disabled></select>


                <label>Correo</label>
                <input class="form-control" type="text" id="txt_EditarCorreo" />


                <label>Notificacion</label>
                <input class="form-control" type="checkbox" id="EditarBox"/>

            </div>
            <div class="modal-footer">
                <button id="btn_actualizar" class="btn btn-success" data-dismiss="modal">Actualizar</button>
            </div>
        </div>
    </div>
</div>


</div>
