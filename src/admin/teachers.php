<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administración | Profesores</title>
  
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
          <li class="nav-item"><a class="nav-link" href="home.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="me.php">Yo</a></li>
          <li class="nav-item"><a class="nav-link active" href="teachers.php">Profesores</a></li>
          <li class="nav-item"><a class="nav-link" href="students.php">Alumnos</a></li>
          <li class="nav-item"><a class="nav-link" href="groups.php">Grupos</a></li>
        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="btn btn-outline-danger" href="../services/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container w-100 text-center py-5">
    <h1 class="mb-4">Administrar Profesores</h1>
    
    <button class="btn btn-outline-secondary mb-3" id="btnNuevoProfe" data-bs-toggle="modal" data-bs-target="#modalProfesor" data-mode="create">
      + Agregar profesor
    </button>

    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light text-secondary">
              <tr>
                <th scope="col" class="py-3">ID</th>
                <th scope="col" class="py-3">Nombre completo</th>
                <th scope="col" class="py-3">Teléfono</th>
                <th scope="col" class="py-3">Correo</th>
                <th scope="col" class="py-3">Contraseña</th>
                <th scope="col" class="py-3">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php include_once("../services/get_teachers.php"); ?>       
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalProfesor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitulo">Gestión de Profesor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form id="formProfesor" method="POST" action="">
          <div class="modal-body text-start">
            <input type="hidden" id="teacher-id" name="id">
            
            <div class="mb-3">
              <label class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" id="teacher-fullname" name="fullName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Número de teléfono</label>
              <input type="text" class="form-control" id="teacher-phone" name="phone" maxlength="12" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input type="email" class="form-control" id="teacher-mail" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="teacher-password" name="password" required>
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
        
        <form id="formEliminar" method="POST" action="../services/delete_teacher.php">
          <div class="modal-body text-center py-4">
            <i class="fas fa-exclamation-triangle text-warning fs-1 mb-3"></i>
            <p class="fs-5">¿Estás seguro de que deseas eliminar a este profesor?</p>
            <p class="text-muted small">Esta acción borrará también sus grupos y materias asignadas.</p>
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
      const modalProfesor = document.getElementById('modalProfesor');
      const modalEliminar = document.getElementById('modalEliminar');

      if (modalEliminar) {
        modalEliminar.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget;
          document.getElementById('delete-id').value = boton.getAttribute('data-id');
        });
      }
      
      if (modalProfesor) {
        modalProfesor.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget; 
          
          const form = document.getElementById('formProfesor');
          const titulo = document.getElementById('modalTitulo');
          const btnSubmit = document.getElementById('btnSubmitModal');
          
          const isCreateMode = boton.getAttribute('data-mode') === 'create';

          if (isCreateMode) {
            titulo.textContent = "Añadir Profesor";
            btnSubmit.textContent = "Agregar profesor";
            form.action = '../services/register_teacher.php';
            form.reset();
            document.getElementById('teacher-id').value = "";
            document.getElementById('teacher-mail').disabled = false;
            document.getElementById('teacher-password').disabled = false;
            document.getElementById('teacher-password').required = true;
          } else {
            titulo.textContent = "Editar Profesor"; 
            btnSubmit.textContent = 'Guardar Cambios'; 
            form.action = "../services/update_teacher.php"; 
            
            document.getElementById('teacher-id').value = boton.getAttribute('data-id');
            document.getElementById('teacher-fullname').value = boton.getAttribute('data-fullname');
            document.getElementById('teacher-phone').value = boton.getAttribute('data-phone');
            document.getElementById('teacher-mail').value = boton.getAttribute('data-mail');

            document.getElementById('teacher-mail').disabled = true;
            document.getElementById('teacher-password').disabled = true;
            document.getElementById('teacher-password').required = false;
          }
        });
      }
    });
  </script>
</body>
</html>