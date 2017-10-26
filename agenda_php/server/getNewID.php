<?php

require('./conector.php');
/*enviar los parámertos de conexión mysqli*/
$con = new ConectorBD();
/*Conectarse a la base de datos agenda_db*/
$response['conexion'] = $con->initConexion($con->database);
if($response['conexion'] == 'OK'){
    /*Generar un arreglo con la información a enviar*/
    $resultado = $con->getNewEventID();
    while($fila = $resultado->fetch_assoc()){
      $response['id']=$fila['MAX(id)'];
    }
    //$data['id'] = $con->getNewEventID();
    $data['titulo'] = '"'.$_POST['titulo'].'"';
    $data['fecha_inicio'] = '"'.$_POST['start_date'].'"';
    $data['hora_inicio'] = '"'.$_POST['start_hour'].':00"';/*Add ":00" to fill datetime format*/
    $data['fecha_finalizacion'] = '"'.$_POST['end_date'].'"';
    $data['hora_finalizacion'] = '"'.$_POST['end_hour'].':00"'; /*Add ":00" to fill datetime format*/
    $data['allday'] = $_POST['allDay'];
    $data['fk_usuarios'] = '"'.$_SESSION['email'].'"';

    /*Enviar los parámetros de inserción de información a la tabla eventos*/
    if($con->insertData('eventos', $data)){
        /*Mostrar mensaje success*/
        $response['msg'] = 'OK';
    }else{
        /*Mostrar mensaje de error*/
        $response['msg'] = "Ha ocurrido un error al guardar el evento";
    }
}else{
    /*Mostrar mensaje de error*/
    $response['msg'] = "Error en la comunicacion con la base de datos";
}
/*devolver el arreglo response en formato json*/
echo json_encode($response);
?>