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

    <div id="dv_edicion" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">                 
                        <label>Nombre</label>
                        <input class="form-control" type="text" id="txt_EditarNombre"/>
                        <input type="hidden" id="txt_EditarId"/>
                    </div>

                    <div class="form-group">                 
                        <label>Sensor</label>
                        <select class="form-control" id="slt_EditarSensor"></select>
                    </div>

                    <div class="form-group">                 
                        <label>Min</label>
                        <input class="form-control" type="text" id="txt_EditarMin" />
                    </div>

                    <div class="form-group">                 
                        <label>Max</label>
                        <input class="form-control" type="text" id="txt_EditarMax"/>
                    </div>    
                </div>
                <div class="modal-footer">                
                    <button id="btn_actualizar" class="btn btn-success" data-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>
