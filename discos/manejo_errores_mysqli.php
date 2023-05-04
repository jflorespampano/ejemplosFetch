<?php
    $datos=[
    'status'=>'',
	'num_reg'=>0,
    'salida'=>'',
	'error'=>''
	];
	//crear la conexion a la base de datos

	
	//activa errores
	mysqli_report(MYSQLI_REPORT_ALL);
	//intenta la conexión
	$mysqli = new mysqli("localhost", "root", "", "cdcol_mio");
	$mysqli->set_charset("utf8");
	if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			$datos["status"]="error";
			$datos["salida"]=NULL;
			$datos["error"]=$mysqli->connect_errno . $mysqli->connect_error;
			echo json_encode($datos);
			exit();
	}
	/* activar la notificación de errores */
	$controlador = new mysqli_driver();
	$controlador->report_mode = MYSQLI_REPORT_ALL;
	
	try{
		$userData = $mysqli->query("SELECT * FROM cds2");
	}catch(mysqli_sql_exception $e){
		echo("El Error: ".$e->__toString()."<br>");
		echo("mensaje: ".$e->getMessage()."<br>");
		echo "Error code: " . $e->getCode()."<br>";
		echo "Error in this file: " . $e->getFile()."<br>";
		echo "Error en la linea: ".$e->getLine();
		exit();
	};
	
	if($userData){
		//printf("Affected rows (SELECT): %d\n", $mysqli->affected_rows);
		$userData = $userData->fetch_all(MYSQLI_ASSOC);
		$datos["status"]="ok";
		$datos["num_reg"]=$mysqli->affected_rows;
		$datos["salida"]=$userData;
		unset($conexion);
		//var_dump($userData);
	}else{
		$datos["status"]="error";
		$datos["salida"]=$mysqli->error;
	}
	//echo json_encode($datos);
	echo json_encode($datos, JSON_UNESCAPED_UNICODE);
?>