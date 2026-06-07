<?php
    include('../api/conn.php'); 

    $query = "SELECT g.id, g.group_name, g.teacher_id, t.full_name 
              FROM groups g 
              LEFT JOIN teachers t ON g.teacher_id = t.id";
  
    $result = $conn->execute_query($query);
    $groups = $result->fetch_all(MYSQLI_ASSOC); 
?>

<?php foreach ($groups as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><strong><?= $row['group_name'] ?></strong></td>
        <td><?= $row['full_name'] ?? 'Sin asignar' ?></td>
        <td>
            <div class='btn-group btn-group-sm'>
                <button type='button' class='btn text-primary btn-editar'
                    data-bs-toggle='modal'
                    data-bs-target='#modalGrupo'
                    data-id='<?= $row['id'] ?>'
                    data-name='<?= $row['group_name'] ?>'
                    data-teacher='<?= $row['teacher_id'] ?>'>
                    <i class='far fa-edit fs-5'></i>
                </button>
                
                <button type='button' class='btn text-danger btn-borrar' 
                    data-id='<?= $row['id'] ?>'
                    data-bs-toggle="modal"
                    data-bs-target="#modalEliminar">
                    <i class='far fa-trash-alt fs-5'></i>
                </button>
            </div>
        </td>
    </tr>
<?php endforeach; ?>