<?php 

    header("Content-Type: text/html;charset=utf-8");
    $datos=[
      'id' =>  '1' ,
      'nombre' =>  'pedro' ,
      'apellido' =>  'nuno' ,
      'edad' =>  '30',
      'ciudad' =>  'Cármen' ,
      'trabajo' =>  'electronico' 
    
];

var_dump($datos);
echo json_encode($datos, JSON_UNESCAPED_UNICODE); 
            
?>
