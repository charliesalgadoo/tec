<?php
// activar errores de mysql
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('../../api/conn.php'); //conexion

    // recibir datos del formulario
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

        //redirigir al panel de vuelta si todo sale bien
        header("Location: ../../view/admin/teachers.php");
        exit();//detener flujo

        //capturar error de mysql
    } catch (mysqli_sql_exception $e) {
        header("Location: ../../view/admin/error.php"); //redirigir al panel de error
        exit();
    }
?>