<?php
    include('../api/conn.php'); 

    $query = "SELECT s.id, s.subject_name, s.teacher_id, t.full_name 
              FROM subjects s 
              LEFT JOIN teachers t ON s.teacher_id = t.id";
  
    $result = $conn->execute_query($query);
    $subjects = $result->fetch_all(MYSQLI_ASSOC); 
?>

<?php if (empty($subjects)): ?>
    <tr>
        <td colspan="4" class="text-center py-4 text-muted">No hay materias registradas en el sistema.</td>
    </tr>
<?php else: ?>
    <?php foreach ($subjects as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><strong><?= htmlspecialchars($row['subject_name']) ?></strong></td>
            <td><?= htmlspecialchars($row['full_name'] ?? 'Sin asignar') ?></td>
            <td>
                <div class='btn-group btn-group-sm'>
                    <button type='button' class='btn text-primary' 
                            data-bs-toggle='modal' 
                            data-bs-target='#modalMateria'
                            data-mode='edit'
                            data-id='<?= $row['id'] ?>'
                            data-name='<?= htmlspecialchars($row['subject_name']) ?>'
                            data-teacher='<?= $row['teacher_id'] ?>'>
                        <i class='far fa-edit fs-5'></i>
                    </button>
                    
                    <button type='button' class='btn text-danger' 
                            data-bs-toggle='modal' 
                            data-bs-target='#modalEliminar'
                            data-id='<?= $row['id'] ?>'>
                        <i class='far fa-trash-alt fs-5'></i>
                    </button>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>