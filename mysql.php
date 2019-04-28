<?php
$DB_ADDRESS="/cloudsql/delta-repeater-228411:europe-west3:bdd";
$DB_USER="pablo";
$DB_PASS="pablo";
$DB_NAME="bdd1";
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: text/html');
    
    $conn = new mysqli(null, $DB_USER, $DB_PASS, $DB_NAME, 0, $DB_ADDRESS);
    //$conn->set_charset("iso-8859-1");   
    if($conn->connect_error){                                                           //checks connection
      header("HTTP/1.0 400 Bad Request");
      echo "ERROR Database Connection Failed: " . $conn->connect_error, E_USER_ERROR;   //reports a DB connection failure
    } else {
      // aquí debemos hacer una consulta anterior para poder colocar el valor del id  y guardarlo en $idok
      //como tenemos ya el objeto-conexión-sql $conn funcionando, lo usamos para la consulta (objeto-consulta $r1)
    $r1=$conn->query("SELECT id from mantenimiento where id=(select max(id) from mantenimiento);");   //rellenar el interior de las comillas y seguir a partir de aquí.........                                  
        $idok = '';                                                                    
        $r1->data_seek(0);
        while($row = $r1->fetch_assoc()){
          foreach ($row as $key => $value) {     
            $idok .= $value.",";
          }
          $idok = rtrim($idok, ",");
        }  
    $r1->close();

    $idok=$idok+1;
    if(!isset($_POST['Nombre'])){echo "vacia";}else{
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
      $result=$conn->query($query);                                               //runs the posted query
      if($result === false){
        header("HTTP/1.0 400 Bad Request");                                             //sends back a bad request error
        echo "Wrong SQL: " . $query . " Error: " . $conn->error, E_USER_ERROR;          //errors if the query is bad and spits the error back to the client
      } else {
     
    echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="expires" content="0"/>
<title>Formulario</title>
 
                
</head>
<body>
<image src="http://mant.iesdellanes.org/formulario/Logo.png" >
<h1>Insertada incidencia numero: ';
	      
echo $idok;
echo ' </h1></p><form action="https://tururu.appspot.com" method="post" enctype="multipart/form-data"><p>Numero: <input type="text" name="Incidencia" value="';
	echo $idok;
	echo '" size="20"  ></p>';
        echo'<p>Nombre: <input type="text" name="Nombre" value="';
	echo $_POST['Nombre'];
	echo '" size="40"  ></p>
        <p>Aula: <input type="text" name="Aula" value="';
	echo $_POST['Aula'];
		echo '" size="40"></p>
        <p>Objeto: <input type="text" name="Objeto" value="';
	 echo $_POST['Objeto'];     
	      echo '"size="40"></p>
        <p>Descripcion: <input type="text" name="Descripcion" value="';
	      echo $_POST['Descripcion'];
	      echo '"size="40"></p>
        <p>Fecha: <input type="date" name="Fecha" Id="Fecha" value="';
	      echo $_POST['Fecha'];
	      echo'" size="40"></p>

              <p>
                <input type="submit" value="Enviar">
                <input type="reset" value="Borrar">
		<input type="image" name="http://mant.iesdellanes.org/formulario/derecha" src="derecha.png" alt="derecha">
		<input type="image" name="http://mant.iesdellanes.org/formulario/izquierda" src="izquierda.png" alt="derecha">
              </p>

 </form>
 
 
</body>
</html>';

      
      }
	$result->close();
      }
      $conn->close();                                          //closes the DB
    }
?>
