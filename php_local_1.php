<?php

$datos=[
    [
        "titulo"=> "Beauty",
        "interprete"=> "Ryuichi Sakamoto",
        "anio"=>  "1990",
        "id"=>  "1" 
    ] ,
    [ 
        "titulo"=>  "Goodbye Country (Hello Nightclub)",
        "interprete"=> "Groove Armada",
        "anio"=>  "2001",
        "id"=> "4" 
    ],
    [ 
        "titulo"=>  "Glee",
        "interprete"=>  "Bran Van 3000",
        "anio"=>  "1997", 
		"id"=> "5"
    ],
    [ 
        "titulo"=>  "la niña de tus ojos",
        "interprete"=> "raúl di blasio",
        "anio"=>  "2020",
        "id"=> "7" 
    ] 
];
//print_r($datos); 
echo json_encode($datos,JSON_UNESCAPED_UNICODE);

?>