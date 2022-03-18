<?php 
            header("Content-Type: text/html;charset=utf-8");
            var_dump($_POST);
            if (isset($_POST) && count($_POST)>0){
                //se enviarion parametros por el método _POST
                $movimiento=(isset($_POST["movimiento"])?$_POST["movimiento"]:"ninguno");
                $id=(isset($_POST["id"])?$_POST["id"]:"");
                $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
                $apellido=(isset($_POST["apellido"])?$_POST["apellido"]:"");
                $edad=(isset($_POST["edad"])?$_POST["edad"]:0);
                echo "recibido:".$movimiento.",".$id.",".$nombre.",".$apellido.",".$edad;
            }else{
                echo "sin datos recibidos";
            }
            exit();
?>
