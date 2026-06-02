
<?php
    include('../api/conn.php'); 

    $studentFullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $curp = $_POST['curp'];
    $phone = $_POST['phone'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql_user = "INSERT INTO users (email, pass, user_role) VALUES (?, ?, 'STUDENT')";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("ss", $email, $hashedPassword);
    $stmt_user->execute();

    $userId = $conn->insert_id;

    $sql_student = "INSERT INTO students (full_name, curp, phone_number, user_id) VALUES (?, ?, ?, ?)";
    $stmt_student = $conn->prepare($sql_student);
    $stmt_student->bind_param("sssi", $studentFullName, $curp, $phone, $userId);
    $stmt_student->execute();

?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<title>Calificaciones | Maestros</title>
<link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<h3>Alumno creado.</h3>
<a href="../teachers/students.php" class="btn btn-primary">Regresar</a>
