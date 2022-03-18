<?php
	//http://localhost/ejercicios/etc/php/devuelve_json.php
	//crear la conexion a la base de datos
	try{
		//intenta la conexión
		$conexion = new PDO("mysql:host=localhost;dbname=personas;charset=utf8", "root", "");
	} catch (PDOException $e) {
		//atrapa el error
		echo "Falla al obtener un manejador de BD: ".$e->getMessage() . "\n";
		exit();
	}
	
	// realizar la consulta y llenar la tabla
	$query = $conexion->prepare("SELECT * FROM persona");
	$query->execute();

	if($query->rowCount() > 0){
		$userData = $query->fetchAll(PDO::FETCH_ASSOC);
		$data['status'] = 'ok';
		$data['resul'] = $userData;
	}else{
		$data['status'] = 'err';
		$data['resul'] = '';
	}
	unset($conexion);
    //echo json_encode($data);
    //echo json_encode($userData);
	
	var_dump($userData);

?>