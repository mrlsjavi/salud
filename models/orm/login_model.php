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
  function prueba(){
    require 'mail/PHPMailerAutoload.php';


//require '../PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "mrlsjavi@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "Atletajavier01";
//Set who the message is to be sent from
$mail->setFrom('from@example.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('mrlsjavi@gmail.com', 'Javier Morales');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("llega el correo");
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

    
  }

	}