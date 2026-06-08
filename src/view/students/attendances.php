<?php
session_start();
include('../../api/conn.php'); 

$userId = $_SESSION['user_id'] ?? null;

if (!$userId || $_SESSION['user_role'] !== 'STUDENT') {
    header("Location: ../../login.php");
    exit();
}

///obtenemos el historial de asistencias con ORDER BY para que esten en orden descendente
$query = "SELECT a.att_date, sub.subject_name, ad.status 
          FROM attendances_details ad 
          INNER JOIN attendances a ON ad.attendance_id = a.id 
          INNER JOIN subjects sub ON a.subject_id = sub.id 
          INNER JOIN students s ON ad.student_id = s.id 
          WHERE s.user_id = ? 
          ORDER BY a.att_date DESC";
          
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$attendances = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// validacion de usuario (RBAC)
  include_once('../../services/auth/auth.php');
  require_role('STUDENT'); //rol necesario
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis Asistencias | Estudiante</title>
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
              <li><a class="dropdown-item" href="scores.php">Mis Calificaciones</a></li>
              <li><a class="dropdown-item active" href="attendances.php">Mis Asistencias</a></li>
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
    <h1 class="text-center mb-4">Mi Historial de Asistencias</h1>
    
    <div class="card border-0  mx-auto" style="max-width: 800px;">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0 text-center">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="py-3">Fecha</th>
                <th scope="col" class="py-3">Materia</th>
                <th scope="col" class="py-3">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($attendances)): ?>
                <tr>
                  <td colspan="3" class="text-center py-5 text-muted">
                    <i class="fas fa-calendar-times fs-1 mb-3"></i><br>
                    Aún no tienes pases de lista registrados.
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($attendances as $row): ?>
                <tr>
                  <td class="fw-bold text-secondary"><?= date("d-m-Y", strtotime($row['att_date'])) ?></td>
                  <td class="fw-semibold"><?= htmlspecialchars($row['subject_name']) ?></td>
                  <td>
                    <?php if ($row['status'] == 1): ?>
                      <span class="badge bg-success px-3 py-2"><i class="fas fa-check me-1"></i> Asistencia</span>
                    <?php else: ?>
                      <span class="badge bg-danger px-3 py-2"><i class="fas fa-times me-1"></i> Falta</span>
                    <?php endif; ?>
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