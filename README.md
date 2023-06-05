# Conjunto de ejemplos que muestran el uso de la api fetch de js

> Estos ejemplos usan js puro probados con XAMP marzo 2022

La API Fetch proporciona una interfaz JavaScript para acceder y manipular partes del canal HTTP, como peticiones y respuestas. También provee un método global: fetch(), que proporciona una forma fácil y lógica de obtener recursos de forma asíncrona por la red. El método fetch devuelve una promesa, para entender mejor todo esto expliquemos lo siguiente:

## Funcion setTimeout

Para nuestros ejemplos usaremos la función timeout con formato:

`setTimeout(function, milliseconds)`

Este método llama a la función (o ejecuta una expresión ) después del número de
milisegundos especificado.

### ejemplo:
```html
<!DOCTYPE html>
<html>
<body>
    <p>Click en el boton espere 3 segundos, entonces se muestra alert "Hello".</p>
    <button onclick="myFunction()">click aqui</button>
    <script>
        function myFunction() {
            setTimeout(function(){ alert("Hello"); }, 3000);
        }
    </script>
</body>
</html>
```
Este ejemplo ejecuta la función:

`function(){ alert("Hello"); }`

Después de 3 segundos. 
Usaremos la función setTimeout para simular procesos cuya
ejecución tarde algún tiempo.

# Funciones asíncronas

Una función asíncrona es aquella que no se ejecuta en la secuencia normal como una lista
de sentencias en un lenguaje, por ejemplo: en un código síncrono cada sentencia en su
programa se ejecuta una después de otra, en el orden que las puso en su programa, la
sentencia en la posición 3 no se ejecuta hasta que haya terminado de ejecutarse la
sentencia en la posición 2 por ejemplo. Para entender esto veamos un ejemplo usando el
método setTimeout.

```javascript
<script>
function muestra(){
    console.log("espere 3 segundos");
}
setTimeout(muestra, 3000);
console.log("termino la promesa.");
</script>
```
La salida de este código es la siguiente:
1. termino la promesa.
2. espere 3 segundos.

Se esperaría que primero mostrará en consola los mensaje

>“espere 3 segundos”

y después el mensaje

>“termino la promesa”

Pero como vemos la salida es al revés. ¿Por qué?.

El método setTimeout se ejecuta de manera asíncrona esto quiere decir que se lanza el
proceso en un nuevo hilo de ejecución, paralelo a nuestro código principal, entonces
nuestro programa tiene 2 hilos de ejecución en paralelo. Mientras se ejecuta el método
settimeout se continúa con el programa principal, como la sentencia `“console.log("termino
la promesa.");”` no requiere una espera de 3 segundos se ejecuta antes.
Los métodos y funciones asíncronas plantean un problema, por ejemplo si se usa el método
**fetch** para solicitar datos vía HTTP, como cuando consultamos una base de datos en la red.
Cuando se consulta una base de datos, el fetch se ejecuta de manera asíncrona, esto para
no dejar esperando nuestros procesos mientras dependemos de la velocidad de la red que
muchas veces es lenta. Por tanto si queremos traer un conjunto de datos y luego meterlos
en una tabla podríamos pensar de forma secuencial en una serie de sentencias así:

1. datos=traer datos desde el servidor con fetch.
2. Tomar los “datos” y ponerlos en una tabla.

Esto no funcionará pues como el código en la línea 1 se ejecuta de forma asíncrona
esperando la respuesta de la red, el código en la línea 2 se ejecutará antes, es decir
estaremos tratando de poner los datos en la tabla antes de que estén listos. Una solución a
esto son las funciones callback que maneja JQuery, otra es la que usaremos nosotros,
trabajar con promesas (promise).

# Promesas
Las promesas son herramientas del lenguaje que nos sirven para gestionar situaciones
futuras en el flujo de ejecución de un programa.
formato:

```javascript
new Promise( function(resolve, reject) { ... } );
```

La promesa encapsula a la función asíncrona (`function(resolve, reject) { ... }`) donde resolve y reject son dos funciones que ejecutaremos en el momento adecuado, lo que hace la promesa es ejecutar las sentencias de la función (lo que hay dentro de las llaves) por ejemplo traer una lista de datos desde la red y cuando se termina es posible que hayamos tenido un éxito o fracaso en nuestra tarea, por ejemplo es posible que los datos los hayamos traído correctamente o que el servidor no haya contestado. Dependiendo de si hubo éxito o fracaso, ejecutaremos
el parámetro resolve o reject, recuerde que ambos son referencias a funciones callback.
Algo más o menos así:
```javascript
new Promise( function(resolve, reject) {
    let d= traer datos desde un servidor;
    //cundo los datos estan listos
    if(d.respuesta_del_servidor ==ok){
        //ejecutamos la funcion resolve
        resolve();
    }else{
        //fallo la respuesta del servidor
        //ejecutamos la función reject
        reject()
    }
});
```

También podemos escribir la promesa con funciones flecha:

`new Promise( (resolve, reject)=> { ... } );`

o si solo le interesa gestionar una promesa cumplida:

`new Promise( resolve => { ... } );`

Los parámetros resolve y reject, son funciones de JS, que recibe la promesa y que son
llamadas cuando se resuelve o rechaza la promesa. Normalmente la función inicia un
trabajo asíncrono, y luego, una vez que es completado, si la promesa es exitosa llama a la
función resolve que se le envió o la función reject si falla la promesa (por ejemplo si ha
ocurrido un error).

En este código:

`new Promise( resolve => { ... } );`

Se declara una promesa que recibe como parámetro solo la función a ejecutar cuando la
promesa es cumplida, si la promesa es rechazada no hacemos nada.
¿Cómo enviar las funciones resolve y reject a la promesa?, para esto usaremos el método
then().

# Método then()
El método then() de una promesa se puede usar para enviar las funciones resolve y reject a
la promesa, el método then también retorna una promesa (esto servirá para encadenar
promesas). Then(), Recibe dos argumentos: funciones callback para los casos de éxito y
fallo del Promise, aunque la función de fallo es opcional.

formato, si p es una promesa, la sintaxis para el then es:

`p.then(resolve[, reject]);`

Usando funciones anónimas, se escribiría así el then:

```javascript
p.then(function() {
        // si la promesa tuvo éxito
    }, function() {
        // si la promesa no tuvo éxito
    });
```
La primera funcion dentro del then corresponde al resolve y la segunda al reject, o si solo se gestiona el resolve y no nos interesa el reject:

```javascript
p.then(function() {
        // si la promesa tuvo éxito
    });
```

Esto es: p es una promesa que tiene como argumento 2 funciones (o una), cuando regresa
de la ejecución de p, el método then ejecuta la función adecuada en caso de que la
promesa p haya sido exitosa o no.

Ejemplo
```javascript
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
</body>
<script>
    miPromesa= new Promise((resolve,reject)=>{
        //hacemos algo
        //suponemos que salio bien y llamamos a resolve despues de 3 segundos
        setTimeout(resolve, 3000);
    });
    //uso del then
    miPromesa.then(
        function(){
            console.log("promesa exitosa");
        },
        function(){
            console.log("fracaso la promesa");
        }
    );
</script>
</html>
```
En este ejemplo vemos como desde el **then** mandamos las funciones resolve y reject que
usará la promesa (en nuestro ejemplo solo se uso la función resolve)
ejemplo:
Veamos un ejemplo más usando una función que nos devuelve una promesa, este es un
caso típico que encontrará en JS.

```javascript
<!DOCTYPE html>
<html>
<body>
    <p>Click en el boton espere 3 segundos, entonces se muestra mensaje.</p>
    <button onclick="muestra()">click aqui</button>
    <script>
        function miPromesa() {
            return new Promise((resolve,reject)=>{
                setTimeout(resolve, 3000);
            });
        }
        function muestra(){
            miPromesa().then(
                function(){
                    console.log("promesa exitosa");
                },
                function(){
                    console.log("fracaso la promesa");
                }
            );
        }
</script>
</body>
</html>
```

Explicación:
la función:
```javascript
function muestra(){
    miPromesa().then(
        function(){
            console.log("promesa exitosa");
        },
        function(){
            console.log("fracaso la promesa");
        }
    );
}
```

Ejecuta la función miPromesa() y con el método then que se llama desde una promesa con
un punto seguido de then(). El método then() ejecuta la función adecuada dependiendo si la
promesa fue exitosa o no.

La función:
```javascript
function miPromesa() {
    return new Promise((resolve,reject)=>{
        setTimeout(resolve, 3000);
    });
}
```

devuelve una nueva promesa.

```javascript
new Promise((resolve,reject)=>{
    setTimeout(resolve, 3000);
});
```
Que en nuestro caso usa el método setTimeout para ejecutar la función resolve :
`setTimeout(resolve, 3000);`
Lo que hace es ejecutar la función resolve después de 3 segundos, recuerde que la función
resolve sirve para resolver la promesa con éxito (es decir para indicar que es exitosa).

Cambie el código de la línea de setTimeout por esta:
`setTimeout(reject, 3000);`

y pruebe el código:

Esta vez estamos simulando que la promesa fue rechazada, es decir que no tuvo éxito. Vea
el resultado del código. Cómo ve ahora el then ejecuta la sentencia:

`console.log("fracaso la promesa");`

Las métodos disponibles en una promesa para resolverla son:

|Métodos| Descripción|
|-------|------------|
|.then(resolve) | Ejecuta la función callback resolve cuando la promesa se cumple.|
|.catch(reject) |Ejecuta la función callback reject cuando la promesa se rechaza.|
|.then(resolve,reject) |Método equivalente a las dos anteriores en el mismo .then().|
|.finally(end) |Ejecuta la función callback end tanto si se cumple como si se rechaza|

# Fetch

La API Fetch proporciona una interfaz JavaScript para acceder y manipular partes del canal HTTP, tales como peticiones y respuestas. También provee un método global fetch() que proporciona una forma fácil y lógica de obtener recursos de forma asíncrona por la red.

Ejemplo 1:
```javascript
fetch("https://jsonplaceholder.typicode.com/albums")
    .then(datos=>{
        //return datos.json();
        return datos.text();
    }).then(datosj=>{
        console.log(datosj);
    });
```
Solicita un conjunto de datos al sitio: "https://jsonplaceholder.typicode.com/albums" ,
como fetch() es una promesa, el then ejecuta la función flecha:

```javascript
datos=>{
        //return datos.json();
        return datos.text();
    }
```
La cual recibe en el parámetro datos, la respuesta del servidor, y devuelve **datos.text()**, datos.text() devuelve una promesa que obtiene los datos enviados por el servidor en formato de texto, como esta es una promesa, le aplicamos un nuevo then con el código:
```javascript
datosj=>{
        console.log(datosj);
    }
```
Que recibe en el parametro datosj, los datos en formato de texto y los mandamos a la consola.
Esta comentada la sentencia: `return datos.json();` esta funciona de manera similar a: `return datos.text();` con la diferencia que devueve los datos en formato JSON.


Ejemplo 2:
```html
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <td>userId</td>
                <td>Id</td>
                <td>titulo</td>
            </tr>
        </thead>
        <tbody id="t_datos">
        </tbody>
    </table>
</body>
<script>
    fetch("https://jsonplaceholder.typicode.com/albums").then(datos=>{
        return datos.json();
    }).then(datosj=>{
        let renglones="";
        datosj.forEach(element => {
            renglones+="<tr>";
            renglones+="<td>"+element.userId+"</td>";
            renglones+="<td>"+element.id+"</td>";
            renglones+="<td>"+element.title+"</td>";
            renglones+="</tr>";
        });
        document.getElementById("t_datos").innerHTML=renglones;
    });
</script>
</html>
```

Ejemplo 3:
```html
<table id="tbl_partes" class="w3-table-all">
    <thead>
        <tr class="w3-grey">
            <td>ID</td>
            <td>Nombre</td>
            <td>Año</td>
            <td>Costo</td>

        </tr>
    </thead>
    <tbody id="datos_tabla"></tbody>
</table>
```
```javascript
fetch("consulta_partes.php")
    .then(function (data) {
        if (data.ok) {
            data.json().then(function (dataJ) {
                let s = ``;
                dataJ.forEach(e => {
                    s += `<tr>
                    <td>${e.id}</td><td>${e.nombre}</td>
                    <td>${e.anio}</td><td>${e.costo}</td>
                </tr>`;
                });
                document.getElementById("datos_tabla").innerHTML = s;
                // ponMensaje("Datos cargados correctamente");
            });
        } else {
            data.text().then(data => console.log(data));
        }
    })

```

La sentencia `if (data.ok)` verifica si la respuesta del servidor fue correcta y si es así, ejecula `data.json()` que toma los datos recibidos por el servidor y los convierte a formato JSON y como la sentencia `data.json` es una promesa, debe ser tratada como tal con su respectivo then.

# enviar formulario

Ejemplo 1 

Envio de formulario
código html

```html
<form id="frm_alta_parte" class="w3-container">
    <p>
        <input name="id" class="w3-input" type="text" placeholder="id">
    </p>
    <p>
        <input name="nombre" class="w3-input" type="text" placeholder="nombre de la parte">
    </p>
    <p>
        <input name="anio" class="w3-input" type="text" placeholder="año de entrada al almacen">
    </p>
    <p>
        <input name="costo" class="w3-input" type="text" placeholder="costo de venta">
    </p>
    <p>
        <input id="btn_agregar" type="button" class="w3-button w3-white w3-border w3-border-blue" value="Agregar parte">
    </p>
</form>
```

código javascript
```javascript
const boton = document.querySelector("#btn_agregar");
boton.addEventListener("click", function () {
    fetch('inserta_parte.php', {
        method: 'post',
        body: new FormData(document.getElementById('frm_alta_parte'))
    }).then(function (returnedValue) {
        if (returnedValue.ok) {
            console.log("operacion correcta");
            returnedValue.text().then((txt) => {
                console.log('muestro respuesta: ', txt);
                consultaPartes();
                ponMensaje(txt);
            });
        }
    }).catch(function (err) {
        console.log(err);
    });   
})
```
código php ejemplo 1
```php
<?php

$datosParte = [
    "anio" => 2022,
    "nombre" => "",
    "costo" => 0.0
];
function insertaDato($datosParte)
{
    $baseDeDatos = new PDO("sqlite:./prov-par.db");
    $baseDeDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sentencia = $baseDeDatos->prepare("INSERT INTO parte(anio, nombre, costo)
	VALUES(:anio, :nombre, :costo);");
    $resultado = $sentencia->execute($datosParte);
    if ($resultado === true) {
        return true;
    } else {
        return false;
    }
}
//programa principal
if (!empty($_POST)) {
    //leemos los datos enviado por el front end
    $nombre = $_POST["nombre"];
    $anio = $_POST["anio"];
    $costo = $_POST["costo"];
    $datosParte["anio"] = $anio;
    $datosParte["nombre"] = $nombre;
    $datosParte["costo"] = $costo;
    if (insertaDato($datosParte)) {
        http_response_code(200);
        echo "se inserto el dato, salida: ok";
    } else {
        http_response_code(400);
        echo "No se pudo insertar el dato, salida: false";
    }
} else {
    http_response_code(400);
    echo "No se recibieron datos, salida: false";
}
exit();
?>
```

código PHP ejemplo 2
```php
<?php
/**
 * Abre una base de datos de SQLite
 * @return object apuntador al manejadro de la BD
 */
function abrirDB()
{
    $baseDeDatos = new PDO("sqlite:./prov-par.db");
    $baseDeDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $baseDeDatos;
}
/**
 * arreglo con un dato
 * @access public
 * @var array
 */
$datosParte = [
    "id" => 0,
    "anio" => 2022,
    "nombre" => "",
    "costo" => 0.0
];


/**
 * Inserta un datos recibe un arreglo de esta forma:
 * $datosParte=[
 *	"id" => 0,
 *	"anio" => 2022,
 *	"nombre" => "",
 *	"costo" => 0.0
 *];
 *@param array $datosParte array
 *@param object $baseDeDatos apuntador al manejador de base de datos
 *@return boolean sucess o fail
 */
function insertaDato($baseDeDatos, $datosParte)
{
    $sentencia = $baseDeDatos->prepare("INSERT INTO parte(anio, nombre, costo)
	VALUES(:anio, :nombre, :costo);");

    # Debemos pasar a bindParam las variables, no podemos pasar el dato directamente
    # debido a que la llamada es por referencia
    $anio = $datosParte["anio"];
    $nombre = $datosParte["nombre"];
    $costo = $datosParte["costo"];
    $sentencia->bindParam(":anio", $anio);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":costo", $costo);
    $resultado = $sentencia->execute();
    if ($resultado === true) {
        return true;
    } else {
        return false;
    }
}


//programa principal
if (!empty($_POST)) {
    //
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "sin descripcion");
    $anio = (isset($_POST["anio"]) ? $_POST["anio"] : "2023");
    $costo = (isset($_POST["costo"]) ? $_POST["costo"] : "0");
    $datosParte["anio"] = $anio;
    $datosParte["nombre"] = $nombre;
    $datosParte["costo"] = $costo;
    $db = abrirDB();
    if ($db) {
        if (insertaDato($db, $datosParte)) {
            http_response_code(200);
            echo "se inserto el dato, salida: ok";
        } else {
            http_response_code(400);
            echo "No se pudo insertar el dato, salida: false";
        }
    } else {
        http_response_code(400);
        echo json_encode("no se pudo abrir la base de datos, salida: false");
    }
} else {
    http_response_code(400);
    echo "No se recibieron datos, salida: false";
}
exit();
?>
```

Envia formulario ejemplo 2:

```javascript
//inserta dato enviando un formulario
function enviarForm(evt) {
    evt.preventDefault();
    //obtenemos los datos del formulario
    const data = new FormData(document.getElementById('miformulario'));
    fetch(url, {
        method: 'post',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(data)
    })
        .then(function (response) {
            if (response.ok) {
                response.text().then(resp => {
                    console.log(resp);
                    llenaTabla();
                });
            } else {
                console.log("no se pudoieron insertar el dato")
            }
        })
        .catch(function (err) {
            console.log("Error...");
            console.error(err);
        });
}
```

Ejemplo 3
Enviar JSON:

```javascript
//inserta dato enviando un json
function enviarJson(evt) {
    evt.preventDefault();
    //obtenemos los datos del formulario
    const data = new FormData(document.getElementById('miformulario'));
    const obj = Object.fromEntries(data);
    // console.log(JSON.stringify(obj));
    fetch(url, {
        method: 'post',
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(obj)
    })
        .then(function (response) {
            if (response.ok) {
                response.text().then(resp => {
                    console.log(resp);
                    llenaTabla();
                })
            } else {
                console.log("no se pudoieron insertar el dato")
            }
        })
        .catch(function (err) {
            console.log("Error...");
            console.error(err);
        });
}
```

Ejemplo 4
Buscar un dato:

```javascript
//busca un dato, 
    function buscaDato(dab) {
        let parametros = `?id=${dab}`;
        let request = new Request(url + parametros,
            {
                method: 'get',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });
        fetch(request).then(function (returnedValue) {
            if (returnedValue.ok) {
                returnedValue.json().then((data) => {
                    if (data.length === 0) {
                        ponMensaje('No existe el dato', 3);
                    } else {
                        let s = '';
                        s += `
                                <tr>
                                    <td>${data[0].id}</td>
                                    <td>${data[0].descripcion}</td>
                                </tr>
                            `;
                        document.querySelector('#datosTabla').innerHTML = s;
                    }
                });
            } else {
                console.log("no se pudo recuperar el dato")
            }
        }).catch(function (err) {
            console.log(err);
        });
    }
```

Ejemplo 5:
Leer todos los datos:
```javascript
function llerdatos() {
    fetch(url, {
        method: 'get',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    }).then(function (returnedValue) {
        if (returnedValue.ok) {
            returnedValue.json().then((data) => {
                if (data.length === 0) {
                    ponMensaje('No existen datos', 3);
                } else {
                    let s = '';
                    data.forEach(e => {
                        s += `
                        <tr>
                            <td>${e.id}</td>
                            <td>${e.descripcion}</td>
                            <td><button onclick="editUser({id:${e.id},descripcion:'${e.descripcion}'})" class="w3-button w3-blue">update</button></td>
                            <td><button onclick="deleteUser(${e.id})" class="w3-button w3-red">delete</button></td>
                        </tr>
                        `;
                    });
                    document.querySelector('#datosTabla').innerHTML = s;
                }
            });
        } else {
            console.log("no se pudoieron recuperar los datos")
        }
    }).catch(function (err) {
        console.log(err);
    });
}
```