<?php
    
    if (isset($_SESSION['email']))
        $_SESSION['email'] = '';

    if (isset($_SESSION['user_role']))
        $_SESSION['user_role'] = '';
    
    if (isset($_SESSION['user_id']))
       $_SESSION['user_id'] = '';

    if (isset($_SESSION['teacher_id']))
        $_SESSION['teacher_id'] = '';

    header("Location: ../login.php");
?>