<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include("../api/conn.php");

    $id = $_POST['id'];
    $subjectName = $_POST['subject_name'];
    $teacherId = $_POST['teacher_id'];

    try {
        // Actualizamos nombre y profesor de la materia
        $query = "UPDATE subjects SET subject_name=?, teacher_id=? WHERE id=?";
        $stmt = $conn->prepare($query);
        // "sii" significa: String (nombre), Integer (id profe), Integer (id materia)
        $stmt->bind_param("sii", $subjectName, $teacherId, $id);
        $stmt->execute();
        
        header("Location: ../admin/subjects.php?success=1");
        exit();
        
    } catch (mysqli_sql_exception $e) {
        // Redirigimos a la página de error universal si algo falla
        header("Location: ../admin/error.php");
        exit();
    }
?>