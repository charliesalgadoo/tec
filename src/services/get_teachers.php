<?php
    include('../api/conn.php'); 

    $query = "SELECT t.id, t.full_name, t.phone_number, u.email 
              FROM teachers t 
              INNER JOIN users u ON t.user_id = u.id";
  
    $result = $conn->execute_query($query);
    $teachers = $result->fetch_all(MYSQLI_ASSOC); 
?>

<?php foreach ($teachers as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['full_name'] ?></td>
        <td><?= $row['phone_number'] ?></td>
        <td><?= $row['email'] ?></td>
        <td class='text-primary'>password</td> 
        <td>
            <div class='btn-group btn-group-sm'>
                <button type='button' class='btn text-primary btn-editar'
                    data-bs-toggle='modal'
                    data-bs-target='#modalProfesor'
                    data-id='<?= $row['id'] ?>'
                    data-fullname='<?= $row['full_name'] ?>'
                    data-phone='<?= $row['phone_number'] ?>'
                    data-mail='<?= $row['email'] ?>'>
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