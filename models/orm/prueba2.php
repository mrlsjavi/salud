<?php
require_once('ORM.php');
    require_once('config.php');
    require_once('general_orm.php');
    require_once('rol_orm.php');
    require_once('usuario_orm.php');
    require_once('alerta_orm.php');
    require_once('medida_sensor_orm.php');
    require_once('sensor_orm.php');
    require_once('unidad_medida_orm.php');
    

    Database::getConnection(DB_PROVIDER, DB_HOST, DB_USER, DB_PASSWORD, DB_DB);

    $javier = new general_orm;

   //$r = $javier::query("insert into rol (id, nombre, estado) values('', 'encargado', 1)");
    $r = $javier::query("select p.id 
from pagina as p
where p.id not in (select pagina 
                        from permiso_rol 
                        where pagina in (1, 2, 3,4,5)
                        and rol = 53
                        and estado = 1)
and p.id in (1, 2, 3, 4, 5)");

    if($r){
        echo "datos";
    }
    else
    {
        echo "no datos";
    }
    print_r($r);
    echo "<br/><br/>";
    foreach ($r as $j) {
        # code...
        echo $j['id'];
    }

 echo "<br/><br/>"; echo "<br/><br/>"; echo "<br/><br/>";
 $roles = usuario_orm::where('estado', 1);

 print_r($roles);
 foreach ($roles as $r) {
        echo $r->obj_rol->nombre;
        echo "<br/>";
        }



        echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";


        $alerta=alerta_orm::where('estado', 1);
        print_r($alerta);
        echo "<br/><br/>";
         foreach ($alerta as $a) {
            echo $a->nombre;
            echo $a->umbral_min;
            echo $a->umbral_max;
            echo $a->obj_medida_sensor->obj_sensor->titulo;
            echo $a->obj_medida_sensor->obj_unidad_medida->titulo;
            echo "<br/>";
        }



   echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
   $r = $javier::query("select Max(identificador) as identificador from usuario where estado  = 1");
   $identificador = '';
   foreach ($r as $id) {
      $identificador = $id['identificador']+1;
   }
   echo "el identificador es :".$identificador;
   /* $roles = rol_orm::where('estado', 1);
    print_r($roles);
    foreach ($roles as $r) {
			echo $r->nombre;
			echo "<br/>";
			echo "<br/>";
			echo $r->id;
			echo "dd";
		}*/


?>