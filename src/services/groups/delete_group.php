<?php

   // mysqli_report sirve para capturar los errores de mysql
   //como cuando hay datos duplicados (UNIQUE
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include("../../api/conn.php"); //CONEXION
    $id = $_POST['id'];

    // BLOQUE TRY -CATCH PARA CAPTURAR CUALQUIER ERROR DE MYSQL
    try {

       //CONSULTA PARA ELIMINAR EL grupo
        $conn->prepare("DELETE FROM groups_students WHERE group_id = ?")->execute([$id]);
        // quey para eliminar el dato
        $stmt = $conn->prepare("DELETE FROM groups WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute(); // ejecutar query

        //redirigir a el panel de nuevo
        header("Location: ../../view/admin/groups.php");
        exit(); // detener el flujo

        // captuar el error de mysql
    } catch (mysqli_sql_exception $e) {

         //redirigir a el panel de errores
        header("Location: ../../view/admin/error.php");
        exit(); //detener el flujo
    }
?>