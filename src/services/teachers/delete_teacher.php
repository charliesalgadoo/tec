<?php

// activar errores de mysql
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include("../../api/conn.php"); //conexion
    $id = $_POST['id']; // recibir el id de el profesor

    //bloque para capturar los errores de mysql
    try {
        //obtener el id del usuario de la base de datos
        $queryUser = "SELECT user_id FROM teachers WHERE id = ?";
        $stmtUser = $conn->prepare($queryUser);
        $stmtUser->bind_param("i", $id);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result()->fetch_assoc();
        
        //eliminar el profe de la base de datos
        $stmt = $conn->prepare("DELETE FROM teachers WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // verificar si hay algun resultado en $resultUser
        if ($resultUser) {
            //eliminar el usuario de la base de datos
            $stmtUserDel = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmtUserDel->bind_param("i", $resultUser['user_id']);
            $stmtUserDel->execute();
        }
        
        header("Location: ../../view/admin/teachers.php"); //redirigir al panel de profesores
        exit(); //terminar flujo

        //capturar los errores de mysql
    } catch (mysqli_sql_exception $e) {
        header("Location: ../../view/admin/error.php"); //redirigir a el panel de errores
        exit(); //terminar flujo
    }
?>