<?php
// inicia la sesion
session_start();
// conexion a la base de datos
include("../api/conn.php");

// recibir datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// buscar el usuario en la base de datos
$query = "SELECT id, email, user_role, pass FROM users WHERE email = ? LIMIT 1";
$result = $conn->execute_query($query, [$email]);
$user = $result->fetch_assoc();

// validar credenciales
if ($user && password_verify($password, $user['pass'])) {
    
    // guardar datos en la sesion
    $_SESSION['email'] = $user['email'];
    $_SESSION['user_role'] = $user['user_role'];
    $_SESSION['user_id'] = $user['id'];

    // verificar el rol del usuario y redirigir
    if ($user['user_role'] === 'TEACHER') {
        // obtener el id del profesor
        $queryTeacher = "SELECT id FROM teachers WHERE user_id = ? LIMIT 1";
        $stmtT = $conn->prepare($queryTeacher);
        $stmtT->bind_param("i", $user['id']);
        $stmtT->execute();
        $resT = $stmtT->get_result()->fetch_assoc();
        
        // guardar el id del profesor en la sesion
        $_SESSION['teacher_id'] = $resT['id']; 


        //si el usuario es un profe redirigir al panel de profesores
        header("Location: ../view/teachers/home.php");
        exit();
        
        //si el usuario es un estudiente redirigir al panel de estudiantes
    } elseif ($user['user_role'] === 'STUDENT') {
        header("Location: ../view/students/home.php");
        exit();
        
        //si el usuario es un admin redirigir al panel de administrador
    } elseif ($user['user_role'] === 'ADMIN') {
        header("Location: ../view/admin/home.php"); 
        exit();
    }

} else {
    echo "El correo o contraseña son incorrectos";
}
?>