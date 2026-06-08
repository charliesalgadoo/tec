<?php

    //iniciar una sesion si aun no hay

    /* la funcion session_status() sirve para saber el estado de una sesion
     podemos compararlo  con:
    PHP_SESSION_NONE que es una constante de estado para sesiones */
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    //funcion que recibe comoo pareametro un rol
    function require_role($required_role) {
        //si no hay un rol en la sesion o no coincide con el requerido se redirige al login (RBAC)
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $required_role) {
            header("Location: ../../login.php"); //redirigir a login .php
            exit(); //terminar el flujo (para evitar que otros archivos sigan)
        }
    }
?>