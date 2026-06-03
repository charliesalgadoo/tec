
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db_name = "school";

    $conn = new mysqli(
        $host, $user, $pass, $db_name
    );

    if ($conn->connect_error) {
        die ("Error de conexion: " . $conn->connect_error);
    }

?>
