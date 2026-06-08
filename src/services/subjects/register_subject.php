<?php
//activar errores de mysql
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('../../api/conn.php');  //conexion

    // recibir datos del formulario
    $subjectName = $_POST['subject_name'];
    $teacherId = $_POST['teacher_id'];

    //bloque para capturar excepciones
    try {
        // insertar la materia en la base de datos
        $sql = "INSERT INTO subjects (subject_name, teacher_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $subjectName, $teacherId);
        $stmt->execute();

        //redirigir cuando termine
        header("Location: ../../view/admin/subjects.php?success=1");
        exit();

    } catch (mysqli_sql_exception $e) {
        header("Location: ../../view/admin/error.php"); //redirigir al panel de errores
        exit();
    }
?>