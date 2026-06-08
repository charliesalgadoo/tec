
<?php
    $host = "localhost"; 
    $user = "juanito"; // usuario creado (comandos en tables.sql)
    $pass = "HOLA_MUNDO_PHP_MODULO2_JAJA"; // constraseña asignada al usuario
    $db_name = "school"; // nombre de la base de datos

    //objeto de conexion a la base de datos
    $conn = new mysqli(
       //parametrossss
        $host, $user, $pass, $db_name
    );

    //si la conexion falla detener todo el flujo 
    if ($conn->connect_error) {
        die ("Error de conexion: " . $conn->connect_error);
    }

?>
