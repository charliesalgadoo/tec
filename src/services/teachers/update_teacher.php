<?php
//activar errores de mysql
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // conexion
    include("../../api/conn.php");

    //recibir datos del profesor
    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    $phone = $_POST['phone'];

    //bloque para capturar excepciones
    try {
        // actualizar profesor en la base de datos
        $query = "UPDATE teachers SET full_name=?, phone_number=? WHERE id=?";
        $stmt = $conn->prepare($query);
        
        $stmt->bind_param("ssi", $fullName, $phone, $id);
        $stmt->execute();
        
        // redirigir al panel de profesores
        header("Location: ../../view/admin/teachers.php");
        exit();
        
    } catch (mysqli_sql_exception $e) {
        //redirigir al panel de error
        header("Location: ../../view/admin/error.php");
        exit();
    }
?>