<?php
    //http://localhost/ejercicios/etc/php/operacionesConarreglos.php
    $userData=[
		'pk'=>'01',
        'nombre'=>'carmela rosas',
        'edad'=>23
    ];
    $userData["nombre"]="Juliana";
    $arreglo=[
        0=>[
            'pk'=>'01',
            'nombre'=>'carmela rosas',
            'edad'=>23
        ],
        1=>[
            'pk'=>'01',
            'nombre'=>'carmela rosas',
            'edad'=>23
        ]
    ];
    $arreglo[1]['nombre']='josefina';
    
    var_dump($arreglo);
?>