<?php 
            header("Content-Type: text/html;charset=utf-8");

            
            //http://localhost/ejercicios/etc/jspuro/ajax/actualizaPersona.php?movimiento=ninguno&id=1&nombre=juan&apellido=perez&edad=40
            if (isset($_POST) && count($_POST)>0){
                //se enviarion parametros por el método _POST
                $movimiento=(isset($_POST["movimiento"])?$_POST["movimiento"]:"ninguno");
                $id=(isset($_POST["id"])?$_POST["id"]:"");
                $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
                $apellido=(isset($_POST["apellido"])?$_POST["apellido"]:"");
                $edad=(isset($_POST["edad"])?$_POST["edad"]:0);
                echo 'get='.$movimiento.",".$id.",".$nombre.",".$apellido.",".$edad;
            }elseif(! empty($_GET)){
                //se enviaron parametros por el método _GET
                $movimiento=(isset($_GET["movimiento"])?$_GET["movimiento"]:"ninguno");
                $id=(isset($_GET["id"])?$_GET["id"]:"");
                $nombre=(isset($_GET["nombre"])?$_GET["nombre"]:"");
                $apellido=(isset($_GET["apellido"])?$_GET["apellido"]:"");
                $edad=(isset($_GET["edad"])?$_GET["edad"]:0);
                echo 'post = '.$movimiento.",".$id.",".$nombre.",".$apellido.",".$edad;
            }else{
                $json_str = file_get_contents('php://input');
                if(strlen($json_str)>0){
                    echo "se reciobio un json longitud:".strlen($json_str)." : ".$json_str;
                    $array = json_decode($json_str);
                    //var_dump($json_str);
                }else{
                    echo "No se recibieron datos";
                }
            }
            exit();
?>
