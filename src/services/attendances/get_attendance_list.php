<?php
    // iniciar una sesion
    session_start();
    include('../../api/conn.php'); //conexion 

    //rol del usuario (en este panel debe de ser profesor)
    $userRole = $_SESSION['user_role'] ?? '';
    $teacherId = $_SESSION['teacher_id'] ?? null; // rol guardado en la sesion

    //obtener la fecha el los parametros de la URL
    // si no hay fecha poner la fecha de hoy
    $currentDate = $_GET['dateAttendance'] ?? date('Y-m-d');
    //id del grupo en la URL, si no hay ponerlo vacio
    $filterGroupId = $_GET['group_id'] ?? '';

    $subjectId = 0; //id de la materia

    //verificar que el rol sea el adecuado y que el id del profe no este vacio
    if ($userRole === 'TEACHER' && $teacherId) {

        //query para obtener el id de la materia del profesor
        $querySubject = "SELECT id FROM subjects WHERE teacher_id = ? LIMIT 1";
        $stmtSub = $conn->prepare($querySubject);
        $stmtSub->bind_param("i", $teacherId);
        $stmtSub->execute();

        $resSub = $stmtSub->get_result()->fetch_assoc();
        $subjectId = $resSub['id'] ?? 0;
    }

    $groupsList = [];
    if ($userRole === 'ADMIN') {
        $resGroups = $conn->query("SELECT id, group_name FROM groups");
        $groupsList = $resGroups->fetch_all(MYSQLI_ASSOC);
    } else if ($userRole === 'TEACHER' && $teacherId) {
        $queryG = "SELECT id, group_name FROM groups WHERE teacher_id = ?";
        $stmtG = $conn->prepare($queryG);
        $stmtG->bind_param("i", $teacherId);
        $stmtG->execute();
        $groupsList = $stmtG->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    $attendanceId = 0; 
    if ($subjectId > 0) {
        $queryAttendance = "SELECT id FROM attendances WHERE att_date = ? AND subject_id = ? LIMIT 1";
        $stmtAtt = $conn->prepare($queryAttendance);
        $stmtAtt->bind_param("si", $currentDate, $subjectId);
        $stmtAtt->execute();
        $resAtt = $stmtAtt->get_result()->fetch_assoc();
        $attendanceId = $resAtt['id'] ?? 0;
    }

    $studentsList = [];
    $queryStudents = "SELECT s.id, s.full_name, IFNULL(ad.status, 0) as status 
                    FROM students s
                    INNER JOIN groups_students gs ON s.id = gs.student_id
                    LEFT JOIN attendances_details ad ON s.id = ad.student_id AND ad.attendance_id = ?";

    if (!empty($filterGroupId)) {
        $queryStudents .= " WHERE gs.group_id = ?";
        $stmt = $conn->prepare($queryStudents);
        $stmt->bind_param("ii", $attendanceId, $filterGroupId);
    } else {
        if ($userRole === 'TEACHER') {
            $queryStudents .= " INNER JOIN groups g ON gs.group_id = g.id WHERE g.teacher_id = ?";
            $stmt = $conn->prepare($queryStudents);
            $stmt->bind_param("ii", $attendanceId, $teacherId);
        } else {
            $stmt = $conn->prepare($queryStudents);
            $stmt->bind_param("i", $attendanceId);
        }
    }

    $stmt->execute();
    $studentsList = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>