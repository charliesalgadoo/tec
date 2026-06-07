<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('../api/conn.php'); 

    $subjectName = $_POST['subject_name'];
    $teacherId = $_POST['teacher_id'];

    try {
        $sql = "INSERT INTO subjects (subject_name, teacher_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $subjectName, $teacherId);
        $stmt->execute();

        header("Location: ../admin/subjects.php?success=1");
        exit();

    } catch (mysqli_sql_exception $e) {
        // Por si algo sale mal, lo mandamos a tu página de error universal
        header("Location: ../admin/error.php");
        exit();
    }
?>