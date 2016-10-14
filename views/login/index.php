<div class="col-lg-offset-4 col-lg-4 cont-login">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12 text-center">
                        <span class="cont-logo"></span>
                        <h2>Login</h2>
                    </div>
                    <form action="login/run" method="post">
                        <div class="form-group">
<!--                            <label>Login</label>-->

                            <input type="text" name="login" class="form-control" placeholder="Login"/>
                        </div>
                        <div class="form-group">
<!--                            <label>Password</label>-->

                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                        </div>
                        <div class="form-group text-right btn-group-login">
                            <input type="submit" value="Entrar" class="btn btn-primary"/>
                        <?php if(Session::get('loggedIn') == false):?>
                            <a href="<?php echo URL; ?>registro" class="btn btn-default">Registro</a>
                        <?php endif; ?>
                        </div>
                        <div class="form-group text-right">
                            <a href="#" id="btn_clave" data-toggle="modal" data-target="#dv_clave" class="">Olvide mi Clave</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dv_clave" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cambio de Contraseña</h4>
            </div>
            <div class="modal-body">
                <label>Correo:</label>
                <input type="text" id="txt_login" class="form-control"/>
            </div>
            <div class="modal-footer">
                <button id="btn_MandarClave" class="btn btn-success">Guardar</button>
                <button id="btn_cancelar" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

