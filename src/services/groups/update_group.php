<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include("../../api/conn.php");

    $id = $_POST['id'];
    $groupName = $_POST['group_name'];
    $teacherId = $_POST['teacher_id'];

    try {
        // Actualizamos el nombre del grupo (ej. 4A) y quién es su profe tutor
        $query = "UPDATE groups SET group_name=?, teacher_id=? WHERE id=?";
        $stmt = $conn->prepare($query);
        
       //las letras en el parametro son los tipos de dato
        // "sii" es string (nombre), INteger( tutor), integer (id grupo)
        $stmt->bind_param("sii", $groupName, $teacherId, $id);
        $stmt->execute();
        
        header("Location: ../../view/admin/groups.php?success=1");
        exit();
        
    } catch (mysqli_sql_exception $e) {
        // Si el nombre del grupo ya existe nos manda al error
        header("Location: ../../view/admin/error.php");
        exit();
    }
?>