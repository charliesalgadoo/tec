<?php
   include("../services/get_attendance_list.php");
?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <title>Asistencias | Maestros</title>
    <link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
   
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
            <img src="../assets/logo-transparent-white.png" alt="Logo" width="150" height="auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="home.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="me.php">Yo</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Estudiantes</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="scores.php">Calificaciones</a></li>
                <li><a class="dropdown-item active" href="attendances.php">Asistencias</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="students.php">Administra tus alumnos</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav justify-content-end">
            <li class="nav-item"><a class="btn btn-outline-danger" href="../login.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="body-container w-100 text-center py-5 m-auto p-5 border-5">
      <h1>Pase de Asistencias</h1>

      <form action="" method="GET" class="mb-4 mt-4 row justify-content-center align-items-end">
        <div class="col-md-3 text-start">
            <label class="form-label fw-bold">Fecha:</label>
            <input type="date" class="form-control" id="dateAttendance" name="dateAttendance" value="<?= htmlspecialchars($currentDate) ?>" required onchange="this.form.submit()">
        </div>
        <div class="col-md-4 text-start">
            <label class="form-label fw-bold">Filtrar por grupo:</label>
            <select class="form-select" name="group_id" onchange="this.form.submit()">
                <option value="">Todos mis grupos</option>
                <?php
                    foreach ($groupsList as $g) {
                        $sel = ($filterGroupId == $g['id']) ? 'selected' : '';
                        echo "<option value='{$g['id']}' $sel>{$g['group_name']}</option>";
                    }
                ?>
            </select>
        </div>
      </form>

      <form action="../services/save_attendances.php" method="POST">
        <input type="hidden" name="dateAttendance" value="<?= htmlspecialchars($currentDate) ?>">
        <input type="hidden" name="group_id" value="<?= htmlspecialchars($filterGroupId) ?>">

        <div class="container">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class="table-light text-secondary">
                    <tr>
                      <th scope="col" class="py-3">ID</th>
                      <th scope="col" class="py-3 text-start">Nombre completo</th>
                      <th scope="col" class="py-3 text-center text-success"><i class="fas fa-check"></i> Asistió</th>
                      <th scope="col" class="py-3 text-center text-danger"><i class="fas fa-times"></i> Faltó</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php if (empty($studentsList)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No hay alumnos para mostrar. Selecciona un grupo.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($studentsList as $row): ?>
                        <tr>
                            <td class="fw-bold align-middle"><?= htmlspecialchars($row['id']) ?></td>
                            <td class="text-start align-middle"><?= htmlspecialchars($row['full_name']) ?></td>
                            
                            <td class="text-center align-middle">
                                <input class="form-check-input fs-4" type="radio" name="alumno_<?= $row['id'] ?>" value="1" <?= $row['status'] == 1 ? 'checked' : '' ?> required />
                            </td>
                            <td class="text-center align-middle">
                                <input class="form-check-input fs-4" type="radio" name="alumno_<?= $row['id'] ?>" value="0" <?= $row['status'] == 0 ? 'checked' : '' ?> />
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
        
        <button type="submit" class="btn btn-primary mt-4 px-5 py-2 rounded-pill">Guardar lista de asistencia</button>
      </form>
    </div>
    
  </body>
</html>