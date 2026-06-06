<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administración | Grupos</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
  
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php"> <img src="../assets/logo-transparent-white.png" alt="Logo" width="150" height="auto">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link inactive" href="home.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="me.php">Yo</a></li>
          <li class="nav-item"><a class="nav-link" href="teachers.php">Profesores</a></li>
          <li class="nav-item"><a class="nav-link" href="students.php">Alumnos</a></li>
          <li class="nav-item"><a class="nav-link active" href="groups.php">Grupos</a></li>
        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="btn btn-outline-danger" href="../services/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container w-100 text-center py-5">
    <h1 class="mb-4">Administrar Grupos</h1>
    
    <button class="btn btn-outline-secondary mb-3" id="btnNuevoGrupo" data-bs-toggle="modal" data-bs-target="#modalGrupo" data-mode="create">
      + Agregar grupo
    </button>

    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light text-secondary">
              <tr>
                <th scope="col" class="py-3">ID</th>
                <th scope="col" class="py-3">Nombre del Grupo</th>
                <th scope="col" class="py-3">Profesor Asignado (Tutor)</th>
                <th scope="col" class="py-3">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php include_once("../services/get_groups.php"); ?>       
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalGrupo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitulo">Gestión de Grupo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form id="formGrupo" method="POST" action="">
          <div class="modal-body text-start">
            <input type="hidden" id="group-id" name="id">
            
            <div class="mb-3">
              <label class="form-label">Nombre del Grupo (Ej. 4A)</label>
              <input type="text" class="form-control" id="group-name" name="group_name" maxlength="2" required>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Asignar Profesor</label>
              <select class="form-select" id="group-teacher" name="teacher_id" required>
                <option value="" selected disabled>Selecciona un profesor...</option>
                <?php
                  // Traemos a los profes directamente para llenar el select
                  include('../api/conn.php'); 
                  $profes = $conn->query("SELECT id, full_name FROM teachers");
                  while($profe = $profes->fetch_assoc()) {
                      echo "<option value='{$profe['id']}'>{$profe['full_name']}</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="btnSubmitModal">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Confirmar Eliminación</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form id="formEliminar" method="POST" action="../services/delete_group.php">
          <div class="modal-body text-center py-4">
            <i class="fas fa-exclamation-triangle text-warning fs-1 mb-3"></i>
            <p class="fs-5">¿Estás seguro de eliminar este grupo?</p>
            <p class="text-muted small">Los estudiantes en este grupo se quedarán sin asignar.</p>
            <input type="hidden" id="delete-id" name="id">
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Sí, eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const modalGrupo = document.getElementById('modalGrupo');
      const modalEliminar = document.getElementById('modalEliminar');

      if (modalEliminar) {
        modalEliminar.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget;
          document.getElementById('delete-id').value = boton.getAttribute('data-id');
        });
      }
      
      if (modalGrupo) {
        modalGrupo.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget; 
          
          const form = document.getElementById('formGrupo');
          const titulo = document.getElementById('modalTitulo');
          const btnSubmit = document.getElementById('btnSubmitModal');
          
          const isCreateMode = boton.getAttribute('data-mode') === 'create';

          if (isCreateMode) {
            titulo.textContent = "Añadir Grupo";
            btnSubmit.textContent = "Crear grupo";
            form.action = '../services/register_group.php';
            form.reset();
            document.getElementById('group-id').value = "";
          } else {
            titulo.textContent = "Editar Grupo"; 
            btnSubmit.textContent = 'Guardar Cambios'; 
            form.action = "../services/update_group.php"; // Si creas el update después
            
            document.getElementById('group-id').value = boton.getAttribute('data-id');
            document.getElementById('group-name').value = boton.getAttribute('data-name');
            document.getElementById('group-teacher').value = boton.getAttribute('data-teacher');
          }
        });
      }
    });
  </script>
</body>
</html>