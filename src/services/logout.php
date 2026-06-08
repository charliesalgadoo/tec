<?php
//comenzar sesion
    session_start();

    session_unset();//eliminar  datos guardados en sesiones

    session_destroy(); //eliminar sesion actual

    header("Location: ../login.php"); //redirigir al login
    exit();
?>