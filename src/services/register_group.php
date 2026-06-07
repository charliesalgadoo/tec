<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('../api/conn.php'); 

    $groupName = $_POST['group_name'];
    $teacherId = $_POST['teacher_id'];

    try {
        $sql = "INSERT INTO groups (group_name, teacher_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $groupName, $teacherId);
        $stmt->execute();

        header("Location: ../admin/groups.php?success=1");
        exit();

    } catch (mysqli_sql_exception $e) {
        header("Location: ../admin/error.php");
        exit();
    }
?>