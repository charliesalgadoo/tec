<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include("../api/conn.php");
    $id = $_POST['id'];

    try {
        $conn->prepare("DELETE FROM groups_students WHERE group_id = ?")->execute([$id]);
        $stmt = $conn->prepare("DELETE FROM groups WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: ../admin/groups.php?success=1");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../admin/error.php");
        exit();
    }
?>