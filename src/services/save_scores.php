<?php
session_start();
include('../api/conn.php'); 

/*obtenemos el id del profesor que guardamos con las sesiones
en login-service.php para saber que materia tiene a cargo
*/
$teacherId = $_SESSION['teacher_id'] ?? 1;

//obtenemos la materia del profe
$querySubject = "SELECT id FROM subjects WHERE teacher_id = ? LIMIT 1";
$statementSubject = $conn->prepare($querySubject);
$statementSubject->bind_param("i", $teacherId);
$statementSubject->execute();
$resultSubject = $statementSubject->get_result();

if ($resultSubject->num_rows === 0) {
    die("Error: El profesor no tiene materia asignada");
}

$subjectData = $resultSubject->fetch_assoc();
$subjectId = $subjectData['id'];

// Preparamos las consultas antes del ciclo (buena practica para que sea rapido)
$queryCheckScore = "SELECT id FROM scores WHERE subject_id = ? AND student_id = ?";
$statementCheckScore = $conn->prepare($queryCheckScore);

$queryUpdateScore = "UPDATE scores SET parcial_1 = ?, parcial_2 = ?, parcial_3 = ?, final_avg = ? WHERE id = ?";
$statementUpdateScore = $conn->prepare($queryUpdateScore);

$queryInsertScore = "INSERT INTO scores (parcial_1, parcial_2, parcial_3, final_avg, subject_id, student_id) VALUES (?, ?, ?, ?, ?, ?)";
$statementInsertScore = $conn->prepare($queryInsertScore);

$studentScores = [];
foreach ($_POST as $key => $value) {
    $val = ($value === '') ? null : (float) $value;

    if (strpos($key, 'parcial1_') === 0) {
        $studentId = (int) str_replace('parcial1_', '', $key);
        $studentScores[$studentId]['p1'] = $val;
    } elseif (strpos($key, 'parcial2_') === 0) {
        $studentId = (int) str_replace('parcial2_', '', $key);
        $studentScores[$studentId]['p2'] = $val;
    } elseif (strpos($key, 'parcial3_') === 0) {
        $studentId = (int) str_replace('parcial3_', '', $key);
        $studentScores[$studentId]['p3'] = $val;
    }
}

foreach ($studentScores as $studentId => $scores) {
    $p1 = $scores['p1'] ?? null;
    $p2 = $scores['p2'] ?? null;
    $p3 = $scores['p3'] ?? null;
    
    $finalAvg = null;
    if ($p1 !== null && $p2 !== null && $p3 !== null) {
        $finalAvg = round(($p1 + $p2 + $p3) / 3, 1);
    }

    $statementCheckScore->bind_param("ii", $subjectId, $studentId);
    $statementCheckScore->execute();
    $resultScore = $statementCheckScore->get_result();

    if ($resultScore->num_rows > 0) {
        $scoreData = $resultScore->fetch_assoc();
        $scoreId = $scoreData['id'];
        
        $statementUpdateScore->bind_param("ddddi", $p1, $p2, $p3, $finalAvg, $scoreId);
        $statementUpdateScore->execute();
    } else {
        $statementInsertScore->bind_param("ddddii", $p1, $p2, $p3, $finalAvg, $subjectId, $studentId);
        $statementInsertScore->execute();
    }
}

header("Location: ../teachers/scores.php");
exit();
?>