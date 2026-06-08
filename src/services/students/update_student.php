<?php
    include("../../api/conn.php"); //conexion

    // recibir los datos del estudiante
    $id = $_POST['id'];
    $studentFullName = $_POST['fullName'];
    $curp = $_POST['curp'];
    $phone = $_POST['phone'];

    //actualizar alumno en la base de datos
    $query = "UPDATE students SET full_name=? ,curp=? ,phone_number=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $studentFullName, $curp, $phone, $id);
    $stmt->execute();
    
?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<h3>Alumno actualizadoo</h3>
<a href="../../view/admin/students.php" class="btn btn-primary">Regresar</a>
