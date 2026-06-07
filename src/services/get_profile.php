<?php
session_start();
include('../api/conn.php'); 

$userId = $_SESSION['user_id'] ?? null;
$userRole = $_SESSION['user_role'] ?? '';

if (!$userId) {
    header("Location: ../login.php");
    exit();
}

$profileData = [];

if ($userRole === 'ADMIN') {
    $query = "SELECT email, user_role FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $profileData = $stmt->get_result()->fetch_assoc();
    
    $profileData['full_name'] = 'Administrador del Sistema'; 

} elseif ($userRole === 'TEACHER') {
    $query = "SELECT u.email, u.user_role, t.full_name, t.phone_number 
              FROM users u 
              INNER JOIN teachers t ON u.id = t.user_id 
              WHERE u.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $profileData = $stmt->get_result()->fetch_assoc();

} elseif ($userRole === 'STUDENT') {
    $query = "SELECT u.email, u.user_role, s.full_name, s.curp, s.phone_number 
              FROM users u 
              INNER JOIN students s ON u.id = s.user_id 
              WHERE u.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $profileData = $stmt->get_result()->fetch_assoc();
}
?>