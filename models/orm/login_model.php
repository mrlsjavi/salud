<?php
error_reporting(E_ERROR | E_PARSE);
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

    public function entrar(){
      $user = usuario_orm::where_login(trim($_POST['login']), trim(md5($_POST['password'])));
			$registro = notificacion_orm::where('usuario', $user[0]->id);
      if($user){
        //echo "entro";
				if($registro!=null && count($registro)>0){
					$data = array(
						'usuario' => $user[0]->id,
						'token' => $_POST['registro']
					);
					$general = new general_orm();
					$general::query("UPDATE notificacion set token='".$data['token']."' WHERE usuario=".$data['usuario']);
				}else{
					$data = array(
						'usuario' => $user[0]->id,
						'token' => $_POST['registro']
					);
					$notificacion = new notificacion_orm($data);
					$notificacion->save();
				}
        header('Content-Type: application/json');
        $result = array('cod'=> 1, 'data' =>$user);
        echo json_encode($result);

      }
      else{
        header('Content-Type: application/json');
        header("HTTP/1.0 401 Not Found");
        http_response_code(401);
        $result = array('cod'=> 0, 'data' =>'');
        echo json_encode($result);
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

        try {
           $enviado = mail($correo_destino, $titulo, $mensaje, $headers);
          if($enviado){
            $respuesta = "Correo enviado!".$psswd;
          }
          else{
            $respuesta = "fallo el envio".$psswd;
          }



        } catch (Exception $e) {
          $respuesta = $e;
        }




    }
    else {
      $respuesta ="Ha ocurrido un error porfavor intentar mas tarde";
    }


    echo $respuesta;


  }


	}
