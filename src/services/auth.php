<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function require_role($required_role) {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $required_role) {
        header("Location: ../login.php");
        exit();
    }
}
?>