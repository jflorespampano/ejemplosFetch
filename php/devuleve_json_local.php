<?php
	//http://localhost/ejercicios/etc/php/devuleve_json_local.php
	$userData=[
		0=>[
			'pk'=>'01',
			'nombre'=>'juan'
		],
		1=>[
			'pk'=>'02',
			'nombre'=>'luis'
		],
		2=>[
			'pk'=>'03',
			'nombre'=>'rosa'
		],
		3=>[
			'pk'=>'04',
			'nombre'=>'rita'
		]
	];
	
	//echo json_encode($userData);
	echo json_encode($userData, JSON_UNESCAPED_UNICODE);
	//var_dump($userData);

?>