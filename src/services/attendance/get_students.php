<?php
    include('../../api/conn.php'); 

    echo "ok";
    $query = "SELECT id, full_name FROM students";
  
    $result = $conn->execute_query($query);
    $students = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php foreach ($students as $row): ?>
    <form action="">
        <table>
            <thead>
                <tr>
                    <th scope="col" class="py-3">ID</th>
                    <th scope="col" class="py-3">Nombre completo</th>
                    <th scope="col" class="py-3">Asistió</th>
                    <th scope="col" class="py-3">No asistió</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                    
                    <td>
                        <input type="radio" name="alumno_<?= $row['id'] ?>" value="1" />
                    </td>
                    <td>
                        <input type="radio" checked name="alumno_<?= $row['id'] ?>" value="0" />
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-outline-secondary" 
            data-bs-toggle="modal" 
            data-bs-target="#modalAñadir"
            type="submit">
            Registrar asistencias
        </button>
    </form>
<?php endforeach; ?>