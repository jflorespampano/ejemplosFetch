<?php
    //http://localhost/ejercicios/etc/php/arreglos1.php
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
    $userData2=array(
        0=>array(
            'pk'=>'01',
			'nombre'=>'juan'
        ),
        1=>array(
            'pk'=>'02',
			'nombre'=>'pedro'
        ),
        3=>array(
            'pk'=>'03',
			'nombre'=>'valente'
        ),
    );
	
	//echo json_encode($userData);
	//echo json_encode($userData, JSON_UNESCAPED_UNICODE);
    var_dump($userData2);
?>