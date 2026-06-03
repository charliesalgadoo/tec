<?php
    include("../api/conn.php");
    $id= $_POST['id'];

    $dlete_query = "DELETE FROM students WHERE id=?";
    
    $stmt = $conn->prepare($dlete_query);

    $stmt->bind_param("i", $id);
    $stmt->execute();
?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<h3>Alumno eliminado</h3>
<a href="../teachers/students.php" class="btn btn-primary">Regresar</a>
