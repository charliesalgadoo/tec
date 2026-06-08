<?php
session_start();
include('../../api/conn.php'); 

//buscar el id del usuario
$userId = $_SESSION['user_id'] ?? null;

//si no hay sesion o el rol no es de un estudiante refirigir al login
if (!$userId || $_SESSION['user_role'] !== 'STUDENT') {
    header("Location: ../../login.php");
    exit(); //terminar flujo
}
//seleccionamos el nombre de la materia (subjects), el nombre del profesor encargado (teachers)
//las calificaciones
$query = "SELECT sub.subject_name, t.full_name as teacher_name, 
                 sc.parcial_1, sc.parcial_2, sc.parcial_3, sc.final_avg 
          FROM scores sc 
          INNER JOIN subjects sub ON sc.subject_id = sub.id 
          INNER JOIN teachers t ON sub.teacher_id = t.id 
          INNER JOIN students s ON sc.student_id = s.id 
          WHERE s.user_id = ?";
          
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$scores = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis Calificaciones | Estudiante</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="svg+xml" href="../../assets/logo-icon.svg" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">
        <img src="../../assets/logo-transparent-white.png" alt="Logo" width="150" height="auto">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="home.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="me.php">Yo</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Mi Historial</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item active" href="scores.php">Mis Calificaciones</a></li>
              <li><a class="dropdown-item" href="attendances.php">Mis Asistencias</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="btn btn-outline-danger" href="../../services/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <h1 class="text-center mb-4">Mis Calificaciones</h1>
    
    <div class="card border-0 ">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="py-3 ps-4">Materia</th>
                <th scope="col" class="py-3">Profesor</th>
                <th scope="col" class="py-3 text-center">Parcial 1</th>
                <th scope="col" class="py-3 text-center">Parcial 2</th>
                <th scope="col" class="py-3 text-center">Parcial 3</th>
                <th scope="col" class="py-3 text-center">Promedio Final</th>
              </tr>
            </thead>
            <tbody>
               <!--verificar si la lista de resultados esta vacia -->
              <?php if (empty($scores)): ?>
                <tr>
                  <td colspan="6" class="text-center py-5 text-muted">
                    <i class="fas fa-book-open fs-1 mb-3"></i><br>
                    Aún no tienes calificaciones registradas en el sistema.
                  </td>
                </tr>
              <!-- si no esta vacia entonces poner la informacion en la tabla-->
              <?php else: ?>
                <?php foreach ($scores as $row): ?>
                <tr>
                  <td class="ps-4 fw-bold text-primary"><?= htmlspecialchars($row['subject_name']) ?></td>
                  <td><?= $row['teacher_name'] ?></td>
                  <td class="text-center"><?= $row['parcial_1'] ?? '-' ?></td>
                  <td class="text-center"><?= $row['parcial_2'] ?? '-' ?></td>
                  <td class="text-center"><?= $row['parcial_3'] ?? '-' ?></td>
                  <!-- poner de color rojo el promedio si es menor a 6, sino de color verde-->
                  <td class="text-center fw-bold fs-5 <?= ($row['final_avg'] >= 6) ? 'text-success' : 'text-danger' ?>">
                    <?= $row['final_avg'] ?? '-' ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>
</html>