<?php
    // conexion
    include('../../api/conn.php'); 

    // obtener grupo del parametro
    $filterGroupId = $_GET['group_id'] ?? '';

    // consulta para obtener alumnos del grupo
    if (!empty($filterGroupId)) {
        $query = "SELECT s.id, s.full_name, s.curp, s.phone_number, u.email, g.group_name 
                  FROM students s 
                  INNER JOIN users u ON s.user_id = u.id
                  LEFT JOIN groups_students gs ON s.id = gs.student_id
                  LEFT JOIN groups g ON gs.group_id = g.id
                  WHERE g.id = ?";
                  
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $filterGroupId);
        $stmt->execute();
        $result = $stmt->get_result();
        $students = $result->fetch_all(MYSQLI_ASSOC);

    } else {
        $query = "SELECT s.id, s.full_name, s.curp, s.phone_number, u.email, g.group_name 
                  FROM students s 
                  INNER JOIN users u ON s.user_id = u.id
                  LEFT JOIN groups_students gs ON s.id = gs.student_id
                  LEFT JOIN groups g ON gs.group_id = g.id";
                  
        $result = $conn->execute_query($query);
        $students = $result->fetch_all(MYSQLI_ASSOC); 
    }
?>

<?php if (empty($students)): ?>
    <tr>
        <td colspan="7" class="text-center py-4 text-muted">
            <i class="fas fa-inbox fs-2 mb-2"></i><br>
            No hay alumnos registrados en este grupo.
        </td>
    </tr>
<?php else: ?>
    <?php foreach ($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td>
                <?= $row['full_name'] ?><br>
                <span class="badge bg-secondary opacity-75" style="font-size: 0.7em;"><?= $row['group_name'] ?? 'Sin grupo' ?></span>
            </td>
            <td><?= $row['curp'] ?></td>
            <td><?= $row['phone_number'] ?></td>
            <td><?= $row['email'] ?></td>
            <td class='text-primary'>password</td> 
            <td>
                <div class='btn-group btn-group-sm'>
                    <button type='button' class='btn text-primary btn-editar'
                        data-bs-toggle='modal'
                        data-bs-target='#modalEstudiante'
                        data-id='<?= $row['id'] ?>'
                        data-fullname='<?= $row['full_name'] ?>'
                        data-curp='<?= $row['curp'] ?>'
                        data-phone='<?= $row['phone_number'] ?>'
                        data-mail='<?= $row['email'] ?>'>
                        <i class='far fa-edit fs-5'></i>
                    </button>
                    
                    <button type='button' class='btn text-danger btn-borrar' data-id='<?= $row['id'] ?>'
                        data-bs-toggle="modal"
                        data-bs-target="#modalEliminar">
                        <i class='far fa-trash-alt fs-5'></i>
                    </button>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>