<?php
    include('../api/conn.php'); 

    $query = "SELECT s.id, s.full_name, s.curp, s.phone_number, u.email FROM students s INNER JOIN users u ON s.user_id = u.id";
  
    $result = $conn->execute_query($query)->fetch_all(MYSQLI_ASSOC); 

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['curp'] . "</td>";
        echo "<td>" . $row['phone_number'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td class='text-primary'>password</td>";

        echo "<td>
            <div class='btn-group btn-group-sm'>
                <button type='button' class='btn text-primary btn-editar'
                    data-bs-toggle='modal'
                    data-bs-target='#modalEditar'
                    data-id='" . $row['id'] . "'
                    data-fullname='" . $row['full_name'] . "'
                    data-curp='" . $row['curp'] . "'
                    data-phone='" . $row['phone_number'] . "'
                    data-mail='" . $row['email'] . "'>
                    <i class='far fa-edit fs-5'></i>
                </button>
                
                <button type='button' class='btn text-danger btn-borrar' data-id='" . $row['id'] . "'>
                    <i class='far fa-trash-alt fs-5'></i>
                </button>
            </div>
        </td>";

        echo "</tr>";
    }
?>