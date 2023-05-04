<?php
    $datos=[
    'status'=>'',
	'num_reg'=>0,
    'salida'=>'',
	'error'=>''
	];
	//crear la conexion a la base de datos

	//intenta la conexión
	//$conexion = new PDO("mysql:host=localhost;dbname=cdcol;charset=utf8", "root", "");
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
	
	$userData = $mysqli->query("SELECT * FROM cds");
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