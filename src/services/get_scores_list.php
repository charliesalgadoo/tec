<?php
session_start();
include('../api/conn.php'); 

$userRole = $_SESSION['user_role'] ?? '';
$teacherId = $_SESSION['teacher_id'] ?? null;
$filterGroupId = $_GET['group_id'] ?? '';

$subjectId = 0; 
if ($userRole === 'TEACHER' && $teacherId) {
    $querySubject = "SELECT id FROM subjects WHERE teacher_id = ? LIMIT 1";
    $stmtSub = $conn->prepare($querySubject);
    $stmtSub->bind_param("i", $teacherId);
    $stmtSub->execute();
    $resSub = $stmtSub->get_result()->fetch_assoc();
    $subjectId = $resSub['id'] ?? 0;
}

$groupsList = [];
if ($userRole === 'TEACHER' && $teacherId) {
    $queryG = "SELECT id, group_name FROM groups WHERE teacher_id = ?";
    $stmtG = $conn->prepare($queryG);
    $stmtG->bind_param("i", $teacherId);
    $stmtG->execute();
    $groupsList = $stmtG->get_result()->fetch_all(MYSQLI_ASSOC);
}

$studentsList = [];

$queryScores = "SELECT s.id, s.full_name, sc.parcial_1, sc.parcial_2, sc.parcial_3, sc.final_avg 
                FROM students s
                INNER JOIN groups_students gs ON s.id = gs.student_id
                LEFT JOIN scores sc ON s.id = sc.student_id AND sc.subject_id = ?";

if (!empty($filterGroupId)) {
    $queryScores .= " WHERE gs.group_id = ?";
    $stmtScores = $conn->prepare($queryScores);
    $stmtScores->bind_param("ii", $subjectId, $filterGroupId);
    
} else {
    $queryScores .= " INNER JOIN groups g ON gs.group_id = g.id WHERE g.teacher_id = ?";
    $stmtScores = $conn->prepare($queryScores);
    $stmtScores->bind_param("ii", $subjectId, $teacherId);

}

$stmtScores->execute();
$studentsList = $stmtScores->get_result()->fetch_all(MYSQLI_ASSOC);
?>