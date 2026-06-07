<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('../api/conn.php'); 

    $teacherFullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql_user = "INSERT INTO users (email, pass, user_role) VALUES (?, ?, 'TEACHER')";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("ss", $email, $hash);
        $stmt_user->execute();

        $userId = $conn->insert_id;

        $sql_teacher = "INSERT INTO teachers (full_name, phone_number, user_id) VALUES (?, ?, ?)";
        $stmt_teacher = $conn->prepare($sql_teacher);
        $stmt_teacher->bind_param("ssi", $teacherFullName, $phone, $userId);
        $stmt_teacher->execute();

        header("Location: ../admin/teachers.php?success=1");
        exit();

    } catch (mysqli_sql_exception $e) {
        header("Location: ../admin/error.php");
        exit();
    }
?>