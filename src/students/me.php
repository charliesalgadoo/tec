<?php
  include_once("../services/get_profile.php");
  
  $role = $profileData['user_role'] ?? '';
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi Perfil</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
  
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">
        <img src="../assets/logo-transparent-white.png" alt="Logo" width="150" height="auto">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <?php if ($role === 'ADMIN'): ?>
            <li class="nav-item"><a class="nav-link" href="home.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link active" href="me.php">Yo</a></li>
            <li class="nav-item"><a class="nav-link" href="teachers.php">Profesores</a></li>
            <li class="nav-item"><a class="nav-link" href="students.php">Alumnos</a></li>
            <li class="nav-item"><a class="nav-link" href="groups.php">Grupos</a></li>
          
          <?php elseif ($role === 'TEACHER'): ?>
            <li class="nav-item"><a class="nav-link" href="home.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link active" href="me.php">Yo</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Estudiantes</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="scores.php">Calificaciones</a></li>
                <li><a class="dropdown-item" href="attendances.php">Asistencias</a></li>
                <li><hr class="dropdown-divider"></li>
              </ul>
            </li>
            
          <?php elseif ($role === 'STUDENT'): ?>
            <li class="nav-item"><a class="nav-link" href="home.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link active" href="me.php">Yo</a></li>
            <li><a class="dropdown-item" href="scores.php">Mis Calificaciones</a></li>
            <li><a class="dropdown-item" href="attendances.php">Mis Asistencias</a></li>
          <?php endif; ?>

        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="btn btn-outline-danger" href="../services/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        
        <h2 class="text-center mb-4">Mi Perfil</h2>
        
        <div class="card border-0 shadow text-center pt-4 pb-3 rounded-4">
          <div class="card-body">
            
            <div class="mb-4 text-primary">
              <?php if ($role === 'ADMIN'): ?>
                <i class="fas fa-user-shield fa-5x"></i>
              <?php elseif ($role === 'TEACHER'): ?>
                <i class="fas fa-chalkboard-user fa-5x text-success"></i>
              <?php elseif ($role === 'STUDENT'): ?>
                <i class="fas fa-user-graduate fa-5x text-info"></i>
              <?php endif; ?>
            </div>
            
            <h3 class="card-title fw-bold mb-1"><?= htmlspecialchars($profileData['full_name']) ?></h3>
            <span class="badge bg-dark mb-3 px-3 py-2 fs-6 rounded-pill">
              <?php
                if ($role === 'ADMIN') echo '<i class="fas fa-crown"></i> Administrador';
                if ($role === 'TEACHER') echo '<i class="fas fa-briefcase"></i> Profesor';
                if ($role === 'STUDENT') echo '<i class="fas fa-book"></i> Estudiante';
              ?>
            </span>
            
            <hr class="my-4 w-75 mx-auto">
            
            <div class="text-start px-4">
              
              <p class="mb-3 fs-5 border-bottom pb-2">
                <i class="fas fa-envelope text-secondary me-2"></i> <strong>Correo:</strong> <br>
                <span class="text-muted fs-6 ms-4"><?= htmlspecialchars($profileData['email']) ?></span>
              </p>
              
              <?php if (!empty($profileData['phone_number'])): ?>
              <p class="mb-3 fs-5 border-bottom pb-2">
                <i class="fas fa-phone text-secondary me-2"></i> <strong>Teléfono:</strong> <br>
                <span class="text-muted fs-6 ms-4"><?= htmlspecialchars($profileData['phone_number']) ?></span>
              </p>
              <?php endif; ?>

              <?php if (!empty($profileData['curp'])): ?>
              <p class="mb-3 fs-5 border-bottom pb-2">
                <i class="fas fa-id-card text-secondary me-2"></i> <strong>CURP:</strong> <br>
                <span class="text-muted fs-6 ms-4"><?= htmlspecialchars($profileData['curp']) ?></span>
              </p>
              <?php endif; ?>
              
              <p class="mb-2 fs-5">
                <i class="fas fa-hashtag text-secondary me-2"></i> <strong>ID de Sistema:</strong> <br>
                <span class="text-muted fs-6 ms-4">#<?= htmlspecialchars($_SESSION['user_id']) ?></span>
              </p>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>