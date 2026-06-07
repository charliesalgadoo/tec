<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('../api/conn.php'); 

    $studentFullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $curp = $_POST['curp'];
    $phone = $_POST['phone'];
    $groupId = $_POST['group_id']; 

    $hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql_user = "INSERT INTO users (email, pass, user_role) VALUES (?, ?, 'STUDENT')";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("ss", $email, $hash);
        $stmt_user->execute();

        $userId = $conn->insert_id; 

        $sql_student = "INSERT INTO students (full_name, curp, phone_number, user_id) VALUES (?, ?, ?, ?)";
        $stmt_student = $conn->prepare($sql_student);
        $stmt_student->bind_param("sssi", $studentFullName, $curp, $phone, $userId);
        $stmt_student->execute();

        $studentId = $conn->insert_id; 

        $sql_enroll = "INSERT INTO groups_students (enrollment_date, student_id, group_id) VALUES (CURDATE(), ?, ?)";
        $stmt_enroll = $conn->prepare($sql_enroll);
        $stmt_enroll->bind_param("ii", $studentId, $groupId);
        $stmt_enroll->execute();

        header("Location: ../admin/students.php?success=1");
        exit();

    } catch (mysqli_sql_exception $e) {
        header("Location: ../admin/error.php");
        exit();
    }
?>