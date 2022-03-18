<?php 
    //header("Content-Type: text/html;charset=utf-8");
    $userData=[
		'id'=>'01',
		'nombre'=>'telesforo',
		'apellido'=>'velarde aquilino',
		'edad'=>23
	];
    if(! empty($_POST)){
        $id=(isset($_POST["id"])?$_POST["id"]:"");
        $userData["id"]=$id;
        echo json_encode($userData);
    }else{
        echo "no hay datos de entrada";
    }
    
    exit();
            
?>
