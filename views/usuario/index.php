<div class="col-lg-12">
    <h1>Adiministracion de Usuarios</h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" type="text" id="txt_nombre"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" id="txt_pass"/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>login</label>
                <input class="form-control" type="text" id="txt_login"/>
            </div>
                <div class="form-group">
                <label>Rol</label>
                <select id="slt_rol" class="form-control">
                    <option value="1">Admin</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        <button id="btn_guardar" class="btn btn-primary">Guardar</button>
    </div>

    <div id ="dv_tabla">
	</div>
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
                </div>

                <div class="form-group">
                    <label>Login</label>
                    <input class="form-control" type="text" id="txt_EditarLogin"/>
                </div>

                <div class="form-group">
                    <label>Rol</label>
                    <select id="slt_EditarRol" class="form-control"></select>
                    <input type="hidden" id="txt_EditarId"/>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_actualizar" class="btn btn-success">Guardar</button>
            </div>
        </div>
	</div>
</div>

<div id="dv_clave" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">                
                    <label>Nueva Clave:</label>
                    <input class="form-control" type="password" id="txt_EditarPass"/>
                    <input class="form-control" type="hidden" id="txt_EditarIdClave">
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_ActualizarClave" class="btn btn-success">Guardar</button>
            </div>    
        </div>
    </div>
</div>
