<?php
$datos=[
    'status'=>'error',
	'num_reg'=>0,
    'salida'=>'',
	'error'=>''
	];
function abreConexion(){
	//crear la conexion a la base de datos
	try{
		//intenta la conexión
		$conexion = new PDO("mysql:host=localhost;dbname=cdcol;charset=utf8", "root", "");
		return $conexion;
	} catch (PDOException $e) {
		//atrapa el error
		$datos["status"]="error";
        $datos["salida"]=NULL;
		$datos["error"]=$e->getMessage();
		return NULL;
	}
}
function traeDatos(){
	if(! empty($_POST)){
        $titel=(isset($_POST["title"])?$_POST["title"]:"");
        $interpret=(isset($_POST["interpret"])?$_POST["interpret"]:"");
        $jahr=(isset($_POST["jahr"])?$_POST["jahr"]:0);
		$insert = "INSERT INTO cds (titel, interpret, jahr)";
		$values = " VALUES ('$titel','$interpret',$jahr)";
		$sql = $insert.$values; 
		//echo $sql;
		return $sql;
    }else{
		//echo "no hay datos post";
		$datos["error"]="no se recibieron datos en POST";
		return NULL;
	}
}

$sentencia=traeDatos();
if(! is_null($sentencia)){
	$conexion=abreConexion();
	if(! is_null($conexion)){
		try{
			$query=$conexion->prepare($sentencia);
			$query->execute();
			$datos["num_reg"]=$query->rowCount();
			$datos["status"]="ok";
			$datos["salida"]=$sentencia;
			$datos["error"]="";
			$query=NULL;
			$conexion=NULL;
		}catch (PDOException $e) {
			$datos["error"]=$e->getMessage();
		}
	}else{
		//no se pudo conectar
	}
	
}else{
	//no hay sentencia
}
echo json_encode($datos);
exit();
?>