<?php 
    //recibe json: {"id":"33","nombre":"juan","apellido":"perez","edad":"4"}
    //header("Content-Type: text/html;charset=utf-8");
            
    if(isset($_POST['myData'])){
            $obj = json_decode($_POST['myData']);
            var_dump($obj);
            echo " se recibió el nombre: ".$obj->nombre;
    }else{
            var_dump($_POST['myData']);
    }

    exit();
?>
