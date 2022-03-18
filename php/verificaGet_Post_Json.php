<?php 
    //header("Content-Type: text/html;charset=utf-8");
    
    //para post y json es lamado desde: /llama_post_a_verificaGPJ.html
    if(! empty($_GET)){
        //se enviaron parametros por el método _GET
        $movimiento=(isset($_GET["movimiento"])?$_GET["movimiento"]:"ninguno");
        $id=(isset($_GET["id"])?$_GET["id"]:"");
        $nombre=(isset($_GET["nombre"])?$_GET["nombre"]:"");
        $apellido=(isset($_GET["apellido"])?$_GET["apellido"]:"");
        $edad=(isset($_GET["edad"])?$_GET["edad"]:0);
        echo 'recibi get = '.$movimiento.",".$id.",".$nombre.",".$apellido.",".$edad;
    }elseif(! empty($_POST)){
        //se enviarion parametros por el método _POST
        $movimiento=(isset($_POST["movimiento"])?$_POST["movimiento"]:"ninguno");
        $id=(isset($_POST["id"])?$_POST["id"]:"");
        $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
        $apellido=(isset($_POST["apellido"])?$_POST["apellido"]:"");
        $edad=(isset($_POST["edad"])?$_POST["edad"]:0);
        echo "recibi post:".$movimiento.",".$id.",".$nombre.",".$apellido.",".$edad;
    }elseif(isset($_SERVER["CONTENT_TYPE"])){
        $contentType = trim($_SERVER["CONTENT_TYPE"]) ;
		if ($contentType === "application/json") {
			echo "se recibieron datos como json ";
		}else{
			echo "se recibieron datos como texto plano ";
		}
		$entrada = trim(file_get_contents("php://input"));
		
		//echo($entrada);
        //se enviaron parametros como json
        if(strlen($entrada)>0){
            $datos = json_decode($entrada); //devuelve un object
            $movimiento=$datos->movimiento;
            $id=$datos->id;
            $nombre=$datos->nombre;
            $apellido=$datos->apellido;
            $edad=$datos->edad;
			echo "recibi json:".$movimiento.",".$id.",".$nombre.",".$apellido.",".$edad;
        }else{
			echo "no hay datos";
		}
			
        
    }else{
        echo "no hay entrada get/post o json";
    }
    
    exit();
            
?>
