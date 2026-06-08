<?php
//activar errores
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    //conexion
    include("../../api/conn.php");

    // recibir datos
    $id = $_POST['id'];
    $subjectName = $_POST['subject_name'];
    $teacherId = $_POST['teacher_id'];

    // bloque para capturar errores
    try {
        // actualizar la materia
        $query = "UPDATE subjects SET subject_name=?, teacher_id=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $subjectName, $teacherId, $id);
        $stmt->execute();
        
        //redirigir al panel
        header("Location: ../../view/admin/subjects.php?success=1");
        exit(); //detener flujo
        
    } catch (mysqli_sql_exception $e) {
        // redirigir al panel de error
        header("Location: ../../view/admin/error.php");
        exit();
    }
?>