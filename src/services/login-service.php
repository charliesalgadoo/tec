<?php
//se inicia la sesion para guardar roles y estados (como user_role o el email)
session_start();

include("../api/conn.php");

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT email, user_role, pass FROM users WHERE email = ? LIMIT 1";

$result = $conn->execute_query($query, [$email]);

$user = $result->fetch_assoc();

//condicion para saber si la contraseña es correcta
if ($user && password_verify($password, $user['pass'])) {
    
     //guardar las en la sesion roles y correo para proximas validaciones
    $_SESSION['email'] = $user['email'];
    $_SESSION['user_role'] = $user['user_role'];
    echo $user['user_role'];

    // si el rol es del profesor entonces redirife a el panel de control de profesor
    if ($user['user_role'] === 'TEACHER') {
        header("Location: ../teachers/home.php");
        exit();
        
        // si el rol es de un alumno se redirige al panel del alumno
    } elseif ($user['user_role'] === 'STUDENT') {
        header("Location: ../students/home.php");
        exit();
        
    } else { //si el rol no es ninguno de los anteriores entonces muestra un error
        echo "Error, Rol del usuario no valido";
    }

} else { //si la contraseña falla sale un error
    echo "El correo o contraseña son incorrectos";
}
?>