<?php

   // conexinon
    include("../../api/conn.php");
    $id = $_POST['id'];

    // query obtener el id de usuario asignado al alumno
    $queryUser = "SELECT user_id FROM students WHERE id = ?";
    $stmtUser = $conn->prepare($queryUser);
    $stmtUser->bind_param("i", $id);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result()->fetch_assoc();
    
    // verificar si el resultado no esta vacio
    if ($resultUser) {
        
        // obtener el id del usuario de el resultado
        $userId = $resultUser['user_id'];

        // query para eliminar el usuario de la base de datos
        $delete_query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $userId);
        $stmt->execute(); // ejecutar consulta
    }
?>