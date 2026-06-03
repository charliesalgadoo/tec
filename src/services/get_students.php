<?php
    include('../api/conn.php'); 

    $query = "SELECT s.id, s.full_name, s.curp, s.phone_number, u.email 
              FROM students s 
              INNER JOIN users u ON s.user_id = u.id";
  
    $result = $conn->execute_query($query);
    $students = $result->fetch_all(MYSQLI_ASSOC); 
?>

<?php foreach ($students as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['full_name'] ?></td>
        <td><?= $row['curp'] ?></td>
        <td><?= $row['phone_number'] ?></td>
        <td><?= $row['email'] ?></td>
        <td class='text-primary'>password</td> <td>
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