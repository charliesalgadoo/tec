<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include("../api/conn.php");
    $id = $_POST['id'];

    try {
        $queryUser = "SELECT user_id FROM teachers WHERE id = ?";
        $stmtUser = $conn->prepare($queryUser);
        $stmtUser->bind_param("i", $id);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result()->fetch_assoc();
        
        $stmt = $conn->prepare("DELETE FROM teachers WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($resultUser) {
            $stmtUserDel = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmtUserDel->bind_param("i", $resultUser['user_id']);
            $stmtUserDel->execute();
        }
        
        header("Location: ../admin/teachers.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        header("Location: ../admin/error.php");
        exit();
    }
?>