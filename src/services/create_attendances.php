<?php
session_start();

include('../api/conn.php'); 
    
    $fecha = $_POST['dateAttendance'] ?? null;
    
    $teacher_id = $_SESSION['teacher_id'] ?? 1; 

    $querySubject = "SELECT id FROM subjects WHERE teacher_id = ? LIMIT 1";
    $stmtSubject = $conn->prepare($querySubject);
    $stmtSubject->bind_param("i", $teacher_id);
    $stmtSubject->execute();
    $resultSubject = $stmtSubject->get_result();

    if ($resultSubject->num_rows === 0) {
        echo json_encode(['status' => 'error', 'mensaje' => 'El profesor no tiene materia asignada']);
        exit;
    }

    $subject = $resultSubject->fetch_assoc();
    $subject_id = $subject['id'];

    $queryAtt = "INSERT INTO attendances (att_date, subject_id) VALUES (?, ?)";
    $stmtAtt = $conn->prepare($queryAtt);
    $stmtAtt->bind_param("si", $fecha, $subject_id);
    
    if ($stmtAtt->execute()) {
        $attendance_id = $conn->insert_id; 
        
        $queryDetails = "INSERT INTO attendances_details (attendance_id, student_id, status) VALUES (?, ?, ?)";
        $stmtDetails = $conn->prepare($queryDetails);
        
        $alumnos_procesados = 0;

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'alumno_') === 0) {
                $student_id = (int) str_replace('alumno_', '', $key);
                $status = (int) $value;
                
                $stmtDetails->bind_param("iii", $attendance_id, $student_id, $status);
                $stmtDetails->execute();
                
                $alumnos_procesados++;
            }
        }
        
    }
    
?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<h3>Asistencias registradas.</h3>
<a href="../teachers/students.php" class="btn btn-primary">Regresar</a>
