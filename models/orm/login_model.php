<?php
  

	class Login_Model {


		public function __construct(){

			
			
		}

		public function run(){

			
			

			//$usuario = usuario::where_login()
			
			
			  $user = usuario_orm::where_login(trim($_POST['login']), trim(md5($_POST['password'])));

        //hacer el insert en responsable
    
          //   echo "<br/><br/>";
            //print_r($user);

           // rol, id, nombre, apellido, 

            if($user){
              foreach ($user as $index => $u) {
              	Session::init();
                Session::set('id', $u->id);
                Session::set('nombre', $u->nombre);
                Session::set('id_rol', $u->obj_rol->id);
                Session::set('rol', $u->obj_rol->nombre);
                Session::set('correo', $u->login);
                Session::set('loggedIn', true);
               // header('location: ../index');
                header('location: '.URL.'index');

              }
              //aqui hacer el insert en responsable
            }
            else{
            //	header('location: ../login');
              header('location: '.URL.'login');
            }

			


			
		}

  public function clave(){
    $info = json_decode($_POST['info']);
    //generar una clave 
   //e6caf2a0
    //tengo que ira  guardarla 
    $general = new general_orm;
    $result = $general::query("select * from usuario where estado =  1 and login = '".trim($info->login)."'");
    $respuesta ='';

    if($result){
      $id = '';
      foreach($result as $r){
        $id = $r['id'];
      }
      $logitud = 8;
      $psswd = substr( md5(microtime()), 1, $logitud);

      $general::query("update usuario set password ='".md5($psswd)."' where id = ".$id);

        $headers = "From: HWW@healthwithoutworries.com";
        $correo_destino= trim($info->login);
        $titulo = "Password Reset";
        $mensaje  = "Su nueva clave es :".$psswd;

        $enviado = mail($correo_destino, $titulo, $mensaje, $headers);
        if($enviado){
          $respuesta = "Correo enviado!".$psswd;
        }
        else{
          $respuesta = "fallo el envio";
        }
        

    }
    else {
      $respuesta ="Ha ocurrido un error porfavor intentar mas tarde";
    }


    echo $respuesta;
    
     
  }

	}