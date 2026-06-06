<?php
session_start();
include("../api/conn.php");

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT id, email, user_role, pass FROM users WHERE email = ? LIMIT 1";
$result = $conn->execute_query($query, [$email]);
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['pass'])) {
    
    $_SESSION['email'] = $user['email'];
    $_SESSION['user_role'] = $user['user_role'];
    $_SESSION['user_id'] = $user['id'];

    if ($user['user_role'] === 'TEACHER') {
        $queryTeacher = "SELECT id FROM teachers WHERE user_id = ? LIMIT 1";
        $stmtT = $conn->prepare($queryTeacher);
        $stmtT->bind_param("i", $user['id']);
        $stmtT->execute();
        $resT = $stmtT->get_result()->fetch_assoc();
        
        $_SESSION['teacher_id'] = $resT['id']; 

        header("Location: ../teachers/home.php");
        exit();
        
    } elseif ($user['user_role'] === 'STUDENT') {
        header("Location: ../students/home.php");
        exit();
        
    } elseif ($user['user_role'] === 'ADMIN') {
        header("Location: ../admin/home.php"); 
        exit();
    }

} else {
    echo "El correo o contraseña son incorrectos";
}
?>