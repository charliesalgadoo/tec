<?php
  include_once("../services/get_scores_list.php");
?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <title>Calificaciones | Maestros</title>
    <link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
   
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.html">
            <img src="../assets/logo-transparent-white.png" alt="Bootstrap" width="150" height="auto">
          </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="home.html">Inicio</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="me.html">Yo</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Estudiantes
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="scores.php">Calificaciones</a></li>
                <li><a class="dropdown-item" href="attendances.php">Asistencias</a></li>
                <li><hr class="dropdown-divider"></li>
              </ul>
            </li>
          </ul>

          <ul class="nav justify-content-end">
            <li class="nav-item">
                <li class="nav-item">
                    <a class="btn btn-outline-danger" href="../login.php">Cerrar sesión</a>
                  </li>
              </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="body-container w-100 text-center py-5 m-auto p-5 border-5">
      <h1>Calificaciones</h1>
      <h5 class="text-danger">*Nota: los cambios que hagas aquí son irreversibles. Registra con precaución.</h5>
      
      <div class="row justify-content-center mb-4 mt-4">
        <div class="col-md-5">
          <form method="GET" action="">
            <div class="input-group shadow-sm">
              <span class="input-group-text bg-dark text-white"><i class="fas fa-filter"></i> &nbsp;Filtrar Grupo</span>
              <select class="form-select" name="group_id" onchange="this.form.submit()">
                <option value="">Todos mis grupos</option>
                <?php
                  $selected_group = $_GET['group_id'] ?? '';
                  foreach ($groupsList as $g) {
                      $sel = ($selected_group == $g['id']) ? 'selected' : '';
                      echo "<option value='{$g['id']}' $sel>{$g['group_name']}</option>";
                  }
                ?>
              </select>
            </div>
          </form>
        </div>
      </div>
      <form action="../services/save_scores.php" method="POST">
        <div class="container">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class="table-light text-secondary">
                    <tr>
                      <th scope="col" class="py-3">ID</th>
                      <th scope="col" class="py-3 text-start">Nombre completo</th>
                      <th scope="col" class="py-3 text-center">Parcial 1</th>
                      <th scope="col" class="py-3 text-center">Parcial 2</th>
                      <th scope="col" class="py-3 text-center">Parcial 3</th>
                      <th scope="col" class="py-3 text-center">Final</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php if (empty($studentsList)): ?>
                    <tr>
                      <td colspan="6" class="text-center py-4 text-muted">No hay alumnos asignados a este grupo.</td>
                    </tr>
                    <?php else: ?>
                      <?php foreach ($studentsList as $row): ?>
                      <tr>
                        <td class="fw-bold align-middle"><?= htmlspecialchars($row['id']) ?></td>
                        <td class="text-start align-middle"><?= htmlspecialchars($row['full_name']) ?></td>
                        
                        <td>
                          <input type="number" class="form-control text-center" name="parcial1_<?= $row['id'] ?>" min="0" max="10" step="0.1" value="<?= htmlspecialchars($row['parcial_1'] ?? '') ?>" placeholder="-" />
                        </td>
                        <td>
                          <input type="number" class="form-control text-center" name="parcial2_<?= $row['id'] ?>" min="0" max="10" step="0.1" value="<?= htmlspecialchars($row['parcial_2'] ?? '') ?>" placeholder="-" />
                        </td>
                        <td>
                          <input type="number" class="form-control text-center" name="parcial3_<?= $row['id'] ?>" min="0" max="10" step="0.1" value="<?= htmlspecialchars($row['parcial_3'] ?? '') ?>" placeholder="-" />
                        </td>
                        
                        <td class="fw-bold align-middle fs-5 <?= isset($row['final_avg']) ? '' : 'text-muted' ?>">
                          <?= htmlspecialchars($row['final_avg'] ?? '-') ?>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        
          <button type="submit" class="btn btn-dark mt-4 px-5 py-2 rounded-pill">Guardar calificaciones</button>
        </div>
      </form>
    </div>
  </body>
</html>