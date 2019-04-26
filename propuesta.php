<?php
$DB_ADDRESS="/cloudsql/delta-repeater-228411:europe-west3:bdd";
$DB_USER="pablo";
$DB_PASS="pablo";
$DB_NAME="bdd1";
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: text/csv');
    
    $conn = new mysqli(null, $DB_USER, $DB_PASS, $DB_NAME, 0, $DB_ADDRESS);
    $conn->set_charset("iso-8859-1");                                                   // esto es prescindible
    if($conn->connect_error){                                                           //checks connection
      header("HTTP/1.0 400 Bad Request");
      echo "ERROR Database Connection Failed: " . $conn->connect_error, E_USER_ERROR;   //reports a DB connection failure
    } else {
      // aquí debemos hacer una consulta anterior para poder colocar el valor del id  y guardarlo en $idok
      //como tenemos ya el objeto-conexión-sql $conn funcionando, lo usamos para la consulta (objeto-consulta $r1)
    $r1=$conn->query("");   //rellenar el interior de las comillas y seguir a partir de aquí.........
        
    $query = "INSERT INTO mantenimiento VALUES ('";
    $query.= $idok;                                     // ojo, este es el nuevo !!!! 
    $query.="','";
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
        
        
       // aquí va a hacer la misma sentencia INSERT que existía cuyo resultado se coloca en el objeto-consulta $result.
      $result=$conn->query($query);                                                     //runs the posted query
      if($result === false){
        header("HTTP/1.0 400 Bad Request");                                             //sends back a bad request error
        echo "Wrong SQL: " . $query . " Error: " . $conn->error, E_USER_ERROR;          //errors if the query is bad and spits the error back to the client
      } else {
      echo "FICHA NÚMERO 7 INSERTADA"; //aquí nos podemos estirar un poco y vamos a mandar un html más completo....
      
      }
      $conn->close();                                          //closes the DB
    }
?>
