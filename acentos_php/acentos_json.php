<?php
	//para manejo de acentos, su base de datos debe devolver utf8, se logra
	//eligiendo la colación latin spanish al crear las tablas
	//su código fuente debe estar en utf8, el editor PN tiene una opcion para convertir 
	//a utf8 desde ansi
	//se debe usar JSON_UNESCAPED_UNICODE en la codificación a json
	//en php al hacer enlace con la base de datos debe indicar utf8 por ejemplo así:
	//$conexion = new PDO("mysql:host=localhost;dbname=cdcol;charset=utf8", "root", "");
	// o así:
	//$mysqli = new mysqli("localhost", "root", "", "cdcol_mio");
	//$mysqli->set_charset("utf8");
	//aqui un ejemplo de devolver datos desde un arreglo local que contiene caracteres especiales.
	$userData=[
		0=>[
			'pk'=>'01',
			'nombre'=>'juan lópez'
		],
		1=>[
			'pk'=>'02',
			'nombre'=>'luis pérex'
		],
		2=>[
			'pk'=>'03',
			'nombre'=>'rosa añes'
		],
		3=>[
			'pk'=>'04',
			'nombre'=>'rita iñigues'
		]
	];
	
	echo "el json: <br>";
	echo json_encode($userData, JSON_UNESCAPED_UNICODE);
	echo "<br>el arreglo asociativo:<br>";
	var_dump($userData);

?>