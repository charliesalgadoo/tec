<?php
    include('../api/conn.php'); 

    echo "ok";
    $query = "SELECT id, full_name FROM students";
  
    $result = $conn->execute_query($query);
    $students = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php foreach ($students as $row): ?>
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
<?php endforeach; ?>