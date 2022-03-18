<?php
    $datos=[
    'status'=>'',
	'num_reg'=>0,
    'salida'=>'',
	'error'=>''
	];
	//crear la conexion a la base de datos
	try{
		//intenta la conexión
		$conexion = new PDO("mysql:host=localhost;dbname=cdcol;charset=utf8", "root", "");
	} catch (PDOException $e) {
		//atrapa el error
		$datos["status"]="error";
        $datos["salida"]=NULL;
		$datos["error"]=$e->getMessage();
		echo json_encode($datos);
		exit();
	}
	
	// realizar la consulta y llenar la tabla
	try{
		$query = $conexion->prepare("SELECT * FROM cds;");
		$query->execute();
		$datos["num_reg"]=$query->rowCount();
		$userData = $query->fetchAll(PDO::FETCH_ASSOC);
		$datos["status"]="ok";
		$datos["salida"]=$userData;
	}catch (PDOException $e) {
		$datos["status"]="error";
        $datos["salida"]=NULL;
		$datos["salida"]=$e->getMessage();
	}
	unset($conexion);
    //echo json_encode($datos);
	echo json_encode($datos, JSON_UNESCAPED_UNICODE);
	//var_dump($userData);

?>