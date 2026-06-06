<?php
    include("../api/conn.php");
    $id = $_POST['id'];

    $queryUser = "SELECT user_id FROM students WHERE id = ?";
    $stmtUser = $conn->prepare($queryUser);
    $stmtUser->bind_param("i", $id);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result()->fetch_assoc();
    
    if ($resultUser) {
        $userId = $resultUser['user_id'];

        $delete_query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    }
?>