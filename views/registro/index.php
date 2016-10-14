<div class="col-lg-offset-4 col-lg-4 cont-register">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12 text-center">
                        <i class="fa fa-medkit fa-4x cont-icon-register"></i>
                        <h3>Registro de Usuario</h3>
                    </div>
                    <div>
                        <div class="form-group">
<!--                            <label>Nombre</label>-->
                            <input type="text" id="txt_nombre" class="form-control" placeholder="Nombre"/>
                        </div>
                        <div class="form-group">
<!--                            <label>Correo</label>-->
                            <input type="text" id="txt_login" class="form-control" placeholder="Correo"/>
                        </div>

                        <div class="form-group">
<!--                            <label>Direccion</label>-->
                            <input type="text" id="txt_direccion" class="form-control" placeholder="Dirección">
                        </div>

                        <div class="form-group">
<!--                            <label>Telefono</label>-->
                            <input type="text" id="txt_telefono" class="form-control" placeholder="Telefono">
                        </div>

                        <div class="form-group">
<!--                            <label>Password</label>-->
                            <input type="password" id="txt_pass" class="form-control" placeholder="Password"/>
                        </div>

                        <div class="form-group text-right btn-group-register">
                            <button id="btn_guardar" class="btn btn-success">Guardar</button>
                            <?php if(Session::get('loggedIn') == false):?>
                                <a href="<?php echo URL; ?>Login" class="btn btn-default">login</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
