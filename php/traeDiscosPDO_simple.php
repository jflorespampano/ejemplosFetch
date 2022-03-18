<?php
    
	//crear la conexion a la base de datos
	try{
		//intenta la conexión
		$conexion = new PDO("mysql:host=localhost;dbname=cdcol;charset=utf8", "root", "");
	} catch (PDOException $e) {
		//muestra el error
		echo ($e->getMessage());
		exit();
	}
	
	// realizar la consulta 
	try{
		$query = $conexion->prepare("SELECT * FROM cds;");
		$query->execute();
		$num_reg=$query->rowCount();
		$datos = $query->fetchAll(PDO::FETCH_ASSOC);
        echo ("<!DOCTYPE html>");
        echo('<html lang="es-MX">');
        echo('<head> <meta charset="utf-8"> </head>');
        echo("<body>");
        echo ($num_reg);
		echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        echo("</body></html>");
	}catch (PDOException $e) {
		echo ($e->getMessage());
	}
	unset($conexion);
?>