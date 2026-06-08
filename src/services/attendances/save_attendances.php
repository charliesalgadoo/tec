<?php
//comenzar una sesion
session_start();
include('../../api/conn.php');//conexion 

//recibir datos de la asistencia
$currentDate = $_POST['dateAttendance'] ?? null;
$groupId = $_POST['group_id'] ?? '';

//obtener rol y id del profesor del formulario
$userRole = $_SESSION['user_role'] ?? '';
$teacherId = $_SESSION['teacher_id'] ?? null;

//validar que sea profesor o que haya un id guardado
if ($userRole !== 'TEACHER' || !$teacherId) {
    die("Error: Los administradores no pueden pasar lista, esto es exclusivo para profesores con materias asignadas.");
}

$querySubject = "SELECT id FROM subjects WHERE teacher_id = ? LIMIT 1";
$statementSubject = $conn->prepare($querySubject);
$statementSubject->bind_param("i", $teacherId);
$statementSubject->execute();
$resultSubject = $statementSubject->get_result();

if ($resultSubject->num_rows === 0) {
    die("Error: El profesor no tiene materia asignada.");
}

$subjectData = $resultSubject->fetch_assoc();
$subjectId = $subjectData['id'];

$queryCheckAttendance = "SELECT id FROM attendances WHERE att_date = ? AND subject_id = ? LIMIT 1";
$statementCheckAttendance = $conn->prepare($queryCheckAttendance);
$statementCheckAttendance->bind_param("si", $currentDate, $subjectId);
$statementCheckAttendance->execute();
$resultCheckAttendance = $statementCheckAttendance->get_result();

if ($resultCheckAttendance->num_rows > 0) {
    $attendanceData = $resultCheckAttendance->fetch_assoc();
    $attendanceId = $attendanceData['id'];
} else {
    $queryInsertAttendance = "INSERT INTO attendances (att_date, subject_id) VALUES (?, ?)";
    $statementInsertAttendance = $conn->prepare($queryInsertAttendance);
    $statementInsertAttendance->bind_param("si", $currentDate, $subjectId);
    $statementInsertAttendance->execute();
    $attendanceId = $conn->insert_id; 
}

$queryCheckDetail = "SELECT id FROM attendances_details WHERE attendance_id = ? AND student_id = ?";
$statementCheckDetail = $conn->prepare($queryCheckDetail);

$queryUpdateDetail = "UPDATE attendances_details SET status = ? WHERE id = ?";
$statementUpdateDetail = $conn->prepare($queryUpdateDetail);

$queryInsertDetail = "INSERT INTO attendances_details (attendance_id, student_id, status) VALUES (?, ?, ?)";
$statementInsertDetail = $conn->prepare($queryInsertDetail);

foreach ($_POST as $key => $value) {
    if (strpos($key, 'alumno_') === 0) {
        $studentId = (int) str_replace('alumno_', '', $key);
        $status = (int) $value;
        
        $statementCheckDetail->bind_param("ii", $attendanceId, $studentId);
        $statementCheckDetail->execute();
        $resultDetail = $statementCheckDetail->get_result();
        
        if ($resultDetail->num_rows > 0) {
            $detailData = $resultDetail->fetch_assoc();
            $statementUpdateDetail->bind_param("ii", $status, $detailData['id']);
            $statementUpdateDetail->execute();
        } else {
            $statementInsertDetail->bind_param("iii", $attendanceId, $studentId, $status);
            $statementInsertDetail->execute();
        }
    }
}

header("Location: ../../view/teachers/attendances.php?dateAttendance={$currentDate}&group_id={$groupId}");
exit();
?>