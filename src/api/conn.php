
<?php
    $host = "localhost";
    $user = "root"; // usuario creado (comandos en tables.sql)
    $pass = ""; // constraseña asignada al usuario
    $db_name = "school"; // nombre de la base de datos

    $conn = new mysqli(
        $host, $user, $pass, $db_name
    );

    if ($conn->connect_error) {
        die ("Error de conexion: " . $conn->connect_error);
    }

?>
