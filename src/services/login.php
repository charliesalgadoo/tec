<?php

    include("conn.php");
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT email, user_role, pass FROM users WHERE email = ? LIMIT 1";
    
    
    $result = $conn->execute_query($query, [$email])->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $row) {
        echo $row['pass'] . " correo kljasdsa";
    }

    if (password_verify($password, $row['pass'])) {
        echo "Contraseña ok";
    } else {
        echo "Contraseña malaa";
    }

?>
