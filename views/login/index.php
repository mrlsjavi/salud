
<style type="text/css">

	.editar {color:blue;}
	.cancelar {color:red;}

</style>
<h1>Login</h1>

<form action="login/run" method="post">

	<label>Login</label><input type="text" name="login" /><br/>
	<label>Password</label><input type="password" name="password"/><br/>
	<label></label><input type="submit" value="Entrar"/>

</form>
<br/>
<br/>
<button id="btn_clave" class="editar">Olvide mi Clave</button>

	<div id="dv_clave" style=" padding: 20px; position:fixed; width:350px; height: 190px; top:0; left:0;   border:#333333 3px solid; background-color: #F8F8FF; color:#000000; display:none;" >
	<div style="position:fixed">
		<label>Correo:</label>
		<input type="text" id="txt_login"/>
		

	</div>
	<br/>
	<br/>
	<button id="btn_MandarClave">Guardar</button>
	<button id="btn_cancelar" class="cancelar">Cancelar</button>

</div>

