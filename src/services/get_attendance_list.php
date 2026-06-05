<?php
    include('../api/conn.php'); 
    $query = "SELECT id, full_name FROM students";
    $result = $conn->execute_query($query);
    $students = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php foreach ($students as $row): ?>
<tr>
    <td><?= htmlspecialchars($row['id']) ?></td>
    <td><?= htmlspecialchars($row['full_name']) ?></td>
    
    <td class="text-center">
    <input class="form-check-input" type="radio" name="alumno_<?= $row['id'] ?>" value="1" required />
    </td>
    <td class="text-center">
    <input class="form-check-input" type="radio" name="alumno_<?= $row['id'] ?>" value="0" checked />
    </td>
</tr>
<?php endforeach; ?>