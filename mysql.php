<?php
$DB_ADDRESS="/cloudsql/delta-repeater-228411:europe-west3:bdd";
$DB_USER="pablo";
$DB_PASS="pablo";
$DB_NAME="bdd1";
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: text/csv');
    $instance_name ="/cloudsql/delta-repeater-228411:europe-west3:bdd";
    $query = "INSERT INTO mantenimiento VALUES ('8','";
    $query.= utf8_encode($_POST['Nombre']);
    $query.="','";
    $query.= utf8_encode($_POST['Aula']);
    $query.="','";
    $query.= utf8_encode($_POST['Objeto']);
    $query.="','";
    $query.= utf8_encode($_POST['Fecha']);
    $query.="','no','";
    $query.= utf8_encode($_POST['Descripcion']);
    $query.="');";
    $conn = new mysqli(null, $DB_USER, $DB_PASS, $DB_NAME, 0, $DB_ADDRESS);
    $conn->set_charset("iso-8859-1"); 
    if($conn->connect_error){                                                           //checks connection
      header("HTTP/1.0 400 Bad Request");
      echo "ERROR Database Connection Failed: " . $conn->connect_error, E_USER_ERROR;   //reports a DB connection failure
    } else {
      $result=$conn->query($query);                                                     //runs the posted query
      if($result === false){
        header("HTTP/1.0 400 Bad Request");                                             //sends back a bad request error
        echo "Wrong SQL: " . $query . " Error: " . $conn->error, E_USER_ERROR;          //errors if the query is bad and spits the error back to the client
      } else {
      echo "FICHA NÚMERO 7 INSERTADA"; 
      
      }
      $conn->close();                                          //closes the DB
    }

?>