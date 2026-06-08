<?php

    // capturar errores de mysql
    // MYSQLI_REPORT_ERROR activa los errores para php
     //MYSQLI_REPORT_STRICT convierte los errores a excepciones que php puede capturar
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include("../../api/conn.php"); // conexion
    $id = $_POST['id'];

    // bloque para capturar excepciones
    try {

       //query para eliminar los datos asociados a las materias
        $conn->prepare("DELETE FROM scores WHERE subject_id = ?")->execute([$id]);
        $conn->prepare("DELETE FROM attendances WHERE subject_id = ?")->execute([$id]);
        
        //query para eliminar las materias
        $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // redirigir a el panel cuando todo termine
        header("Location: ../../view/admin/subjects.php");
        exit(); // terminar el flujo

        // error de mysql
    } catch (mysqli_sql_exception $e) {
        header("Location: ../../view/admin/error.php"); //redireccion al panel de errores
        exit(); //terminar el flujo
    }
?>