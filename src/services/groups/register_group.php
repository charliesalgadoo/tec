<?php
// activar errores
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // conexion
    include('../../api/conn.php'); 

    // recibir datos del grupo
    $groupName = $_POST['group_name'];
    $teacherId = $_POST['teacher_id'];

    try {
        $sql = "INSERT INTO groups (group_name, teacher_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $groupName, $teacherId);
        $stmt->execute();

        header("Location: ../../view/admin/groups.php?success=1");
        exit();

    } catch (mysqli_sql_exception $e) {
        header("Location: ../../view/admin/error.php");
        exit();
    }
?>