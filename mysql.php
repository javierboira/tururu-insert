<?php
$DB_ADDRESS="/cloudsql/delta-repeater-228411:europe-west3:bdd";
$DB_USER="pablo";
$DB_PASS="pablo";
$DB_NAME="bdd1";
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: text/html');
   if($_POST['derecha_x']){
	$conn = new mysqli(null, $DB_USER, $DB_PASS, $DB_NAME, 0, $DB_ADDRESS);
    	if($conn->connect_error){                                                           //checks connection
      		header("HTTP/1.0 400 Bad Request");
      		echo "ERROR Database Connection Failed: " . $conn->connect_error, E_USER_ERROR;   //reports a DB connection failure
    	} else {
    		$r1=$conn->query("SELECT * from mantenimiento where id=".($_POST['Incidencia']+1).";");                                                               $r1->data_seek(0);
        	while($row = $r1->fetch_assoc()){
          		foreach ($row as $key => $value) {     
            			$pablo[$key] = $value;
          		}
			
		if (isset($pablo['Id']){
			echo '</p>Incidencia: '.$pablo['Id].'</p>;
		}else{
			echo '</p>ERROR!!!, No existe esa incidencia ó ha llegado al final de la tabla</p>';
		};
		
			
			
        	}  
    		$r1->close();
		echo '<!DOCTYPE html>
		<html>
		<head>
		<meta http-equiv="expires" content="0"/>
		<title>Formulario</title>               
		</head>
		<body>
		<image src="http://mant.iesdellanes.org/formulario/Logo.png" >
		<h1>Incidencia numero: ';	      
		echo $pablo['Id'];
		echo ' </h1></p><form action="https://tururu.appspot.com" method="post" enctype="multipart/form-data"><p>Numero: <input type="text" 		name="Incidencia" value="';
		echo $pablo['Id'];
		echo '" size="20"  ></p>';
        	echo'<p>Nombre: <input type="text" name="Nombre" value="';
		echo $pablo['Usuario'];
		echo '" size="40"  ></p>
        	<p>Aula: <input type="text" name="Aula" value="';
		echo $pablo['Aula'];
		echo '" size="40"></p>
        	<p>Objeto: <input type="text" name="Objeto" value="';
		echo $pablo['Objeto'];     
		echo '"size="40"></p>
        	<p>Descripcion: <input type="text" name="Descripcion" value="';
		echo $pablo['observaciones'];
		echo '"size="40"></p>
        	<p>Fecha: <input type="date" name="Fecha" Id="Fecha" value="';
		echo $pablo['Fecha'];
		echo'" size="40"></p>
              	<p>
                <input type="submit" name="submit" value="Enviar">
                <input type="reset" value="Borrar">
		<input type="image" name="derecha" src="http://mant.iesdellanes.org/formulario/flechaderecha.png" style="width:50px;height:200" alt="derecha">
		<input type="image" name="izquierda" src="http://mant.iesdellanes.org/formulario/flechaizquierda.png" style="width:50px;height:200" alt="izqierda">
              	</p>
		</form>
		</body>
		</html>';
      		$conn->close(); 
          }    
   }else if($_POST['izquierda_x']){    // ::::::::::::::::: ENTRADA POR FLECHA IZQUIERDA-BUSCAMOS FICHA Y VAMOS A LA ANTERIOR:::::::::::::::::::::::
	   $conn = new mysqli(null, $DB_USER, $DB_PASS, $DB_NAME, 0, $DB_ADDRESS);
    	if($conn->connect_error){                                                           //checks connection
      		header("HTTP/1.0 400 Bad Request");
      		echo "ERROR Database Connection Failed: " . $conn->connect_error, E_USER_ERROR;   //reports a DB connection failure
    	} else {
    		$r1=$conn->query("SELECT * from mantenimiento where id=".($_POST['Incidencia']-1).";");                     
        	$r1->data_seek(0);
       		while($row = $r1->fetch_assoc()){
          		foreach ($row as $key => $value) {     
            			$pablo[$key] = $value;
          		}
			
			if (isset($pablo['Id']){
			echo '</p>Incidencia: '.$pablo['Id].'</p>;
		}else{
			echo '</p>ERROR!!!, No existe esa incidencia ó ha llegado al final de la tabla</p>';
		};
			
			
			
			
        	}  
    		$r1->close();    
    		echo '<!DOCTYPE html>
		<html>
		<head>
		<meta http-equiv="expires" content="0"/>
		<title>Formulario</title>
 		</head>
		<body>
		<image src="http://mant.iesdellanes.org/formulario/Logo.png" >
		<h1>Incidencia numero: ';
	      	echo $pablo['Id'];
		echo ' </h1></p><form action="https://tururu.appspot.com" method="post" enctype="multipart/form-data"><p>Numero: <input type="text" 		name="Incidencia" value="';
		echo $pablo['Id'];
		echo '" size="20"  ></p>';
        	echo'<p>Nombre: <input type="text" name="Nombre" value="';
		echo $pablo['Usuario'];
		echo '" size="40"  ></p>
        	<p>Aula: <input type="text" name="Aula" value="';
		echo $pablo['Aula'];
		echo '" size="40"></p>
        	<p>Objeto: <input type="text" name="Objeto" value="';
	 	echo $pablo['Objeto'];     
	      	echo '"size="40"></p>
        	<p>Descripcion: <input type="text" name="Descripcion" value="';
	      	echo $pablo['observaciones'];
	      	echo '"size="40"></p>
        	<p>Fecha: <input type="date" name="Fecha" Id="Fecha" value="';
	      	echo $pablo['Fecha'];
	      	echo'" size="40"></p>
              	<p>
                <input type="submit" name="submit" value="Enviar">
                <input type="reset" value="Borrar">
		<input type="image" name="derecha" src="http://mant.iesdellanes.org/formulario/flechaderecha.png" style="width:50px;heighht:200" alt="derecha">
		<input type="image" name="izquierda" src="http://mant.iesdellanes.org/formulario/flechaizquierda.png" style="width:50px;heighht:200" alt="izqierda">
              	</p>
 		</form>
		</body>
		</html>';      
      		$conn->close();                                          //closes the DB
    	}
   }else if ($_POST['submit']=="Enviar"){     ////// ::::::::::::::::: ENTRADA POR SUBMIT-INSERTA LA FICHA NUEVA :::::::::::::::::::::::
	$conn = new mysqli(null, $DB_USER, $DB_PASS, $DB_NAME, 0, $DB_ADDRESS);   
    	if($conn->connect_error){                                                           //checks connection
      		header("HTTP/1.0 400 Bad Request");
     		 echo "ERROR Database Connection Failed: " . $conn->connect_error, E_USER_ERROR;   //reports a DB connection failure
    	} else {
    		$r1=$conn->query("SELECT id from mantenimiento where id=(select max(id) from mantenimiento);");   
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
        echo "Wrong SQL: " . $query . " Error: " . $conn->error, E_USER_ERROR;          
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
                <input type="submit" name="submit" value="Enviar">
                <input type="reset" value="Borrar">
		<input type="image" name="derecha" value="derecha" src="http://mant.iesdellanes.org/formulario/flechaderecha.png" alt="derecha">
		<input type="image" name="izquierda" value="izquierda" src="http://mant.iesdellanes.org/formulario/flechaizquierda.png" alt="izquierda">
              	</p>
 		</form>
		</body>
		</html>';      
      	}
	$result->close();
      }
      $conn->close();                                          //closes the DB
    }
   }else{                         ////// ::::::::::::::::: ENTRADA SIN DATOS NI FORMULARIO :::::::::::::::::::::::
    echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="expires" content="0"/>
<title>Formulario</title>
 
                
</head>
<body>
<image src="http://mant.iesdellanes.org/formulario/Logo.png" >
</h1></p><form action="https://tururu.appspot.com" method="post" enctype="multipart/form-data"><p>Numero: <input type="text" name="Incidencia" value="';
	echo '" size="20"  ></p>';
        echo'<p>Nombre: <input type="text" name="Nombre" value="';
	echo '" size="40"  ></p>
        <p>Aula: <input type="text" name="Aula" value="';
		echo '" size="40"></p>
        <p>Objeto: <input type="text" name="Objeto" value="';    
	      echo '"size="40"></p>
        <p>Descripcion: <input type="text" name="Descripcion" value="';
	      echo '"size="40"></p>
        <p>Fecha: <input type="date" name="Fecha" Id="Fecha" value="';
	      echo'" size="40"></p>
              <p>
                <input type="submit" name="submit" value="Enviar">
                <input type="reset" value="Borrar">
		<input type="image" value="derecha" name="derecha" src="http://mant.iesdellanes.org/formulario/flechaderecha.png" alt="derecha">
		<input type="image" value="izquierda" name="izquierda" src="http://mant.iesdellanes.org/formulario/flechaizquierda.png" alt="izqierda">
              </p>
 </form>
ha entrado por el else.
 
</body>
</html>';
	
 }
?>
