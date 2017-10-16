<?php
	
  require('./conector.php');

  
  $con = new ConectorBD('localhost','user_agenda', '123456');

  $response['conexion']=$con->initConexion('agenda_db');

  if ($response['conexion']=='OK') {

  	$conexion = $con->getConexion();

  	$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password, fecha_nacimiento) VALUES (?,?,?,?)');

    $insert->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);

    $email = "demo@mail.com";
	$nombre = "Usuario Demo";
    $password = password_hash('123456', PASSWORD_DEFAULT);
    $fecha_nacimiento = "1998-09-08";

    $insert->execute();

    //Para ejecutar otra sentencia solo se deben definir nuevamente los parametros y ejecutar la funcion execute()
    $email = "carla@mail.com";
	$nombre = "Carla Rodriguez";
    $password = password_hash('123456', PASSWORD_DEFAULT);
    $fecha_nacimiento = "1990-04-15";

    $insert->execute();

    $email = "juan@mail.com";
	$nombre = "Juan Gómez";
    $password = password_hash('123456', PASSWORD_DEFAULT);
    $fecha_nacimiento = "1997-12-21";

    $insert->execute();

    $response['resultado']="1";
    $response['msg']="Usuarios generados correctamente. Para iniciar sesion:</br>email: demo@mail.com</br>contraseña: 123456";
  }else{
    $response['resultado']="0";
    $response['msg']= "No se pudo conectar a la base de datos";
  }

  echo json_encode($response);

  $con->cerrarConexion();
  

?>