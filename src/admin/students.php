<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calificaciones | Maestros</title>
  
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
          <li class="nav-item"><a class="nav-link" href="teachers.php">Profesores</a></li>
          <li class="nav-item"><a class="nav-link active" href="students.php">Alumnos</a></li>
          <li class="nav-item"><a class="nav-link" href="groups.php">Grupos</a></li>
        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="btn btn-outline-danger" href="../services/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container w-100 text-center py-5">
    <h1 class="mb-4">Administrar estudiantes</h1>

    <div class="row justify-content-end mb-3">
      <div class="col-md-4">
        <button class="btn btn-outline-secondary mb-3" id="btnNuevoAlumno" data-bs-toggle="modal" data-bs-target="#modalEstudiante" data-mode="create">
          + Agregar alumno
        </button>
        <form method="GET" action="">
          <div class="input-group">
            <span class="input-group-text bg-light"><i class="fas fa-filter"></i></span>
            <select class="form-select" name="group_id" onchange="this.form.submit()">
              <option value="">Todos los grupos</option>
              <?php
                include('../api/conn.php');
                $grupos = $conn->query("SELECT id, group_name FROM groups");
                
                $selected_group = $_GET['group_id'] ?? ''; 
                while($g = $grupos->fetch_assoc()) {
                    $sel = ($selected_group == $g['id']) ? 'selected' : '';
                    echo "<option value='{$g['id']}' $sel>{$g['group_name']}</option>";
                }
              ?>
            </select>
          </div>
        </form>
      </div>
    </div>
    <div class="card border-0 shadow-sm">

    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light text-secondary">
              <tr>
                <th scope="col" class="py-3">ID</th>
                <th scope="col" class="py-3">Nombre completo</th>
                <th scope="col" class="py-3">CURP</th>
                <th scope="col" class="py-3">Teléfono</th>
                <th scope="col" class="py-3">Correo</th>
                <th scope="col" class="py-3">Contraseña</th>
                <th scope="col" class="py-3">Acciones</th>
              </tr>
            </thead>
            <tbody>
              
              <?php include_once("../services/get_students.php"); ?>       
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEstudiante" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitulo">Gestión de Alumno</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form id="formEstudiante" method="POST" action="">
          <div class="modal-body">
            <input type="hidden" id="student-id" name="id">
            
            <div class="mb-3">
              <label class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" id="student-fullname" name="fullName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Curp</label>
              <input type="text" class="form-control" id="student-curp" name="curp" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Número de teléfono</label>
              <input type="text" class="form-control" id="student-phone" name="phone" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input type="email" class="form-control" id="student-mail" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="student-password" name="password" required>
            </div>

            <div class="mb-3" id="div-group">
                <label class="form-label">Asignar a Grupo</label>
                <select class="form-select" id="student-group" name="group_id" required>
                    <option value="" selected disabled>Selecciona un grupo...</option>
                    <?php
                    // Incluimos la conexión (asegúrate de que la ruta sea correcta)
                    include('../api/conn.php'); 
                    
                    // Traemos los grupos y el nombre de su tutor
                    $queryGrupos = "SELECT g.id, g.group_name, t.full_name 
                                    FROM groups g 
                                    LEFT JOIN teachers t ON g.teacher_id = t.id";
                                    
                    $resultadoGrupos = $conn->query($queryGrupos);
                    
                    while($grupo = $resultadoGrupos->fetch_assoc()) {
                        $nombreProfe = $grupo['full_name'] ? $grupo['full_name'] : 'Sin asignar';
                        echo "<option value='{$grupo['id']}'>{$grupo['group_name']} (Profe: {$nombreProfe})</option>";
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
        
        <form id="formEliminar" method="POST" action="../services/delete_student.php">
          <div class="modal-body text-center py-4">
            <i class="fas fa-exclamation-triangle text-warning fs-1 mb-3"></i>
            <p class="fs-5">¿Estás seguro de que deseas eliminar a este alumno?</p>
            <p class="text-muted small">Esta acción no se puede deshacer y borrará todo su registro.</p>
            
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

  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitulo">Gestión de Alumno</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form id="formEstudiante" method="POST" action="">
          <div class="modal-body">
            <input type="hidden" id="student-id" name="id">
            
            <div class="mb-3">
              <label class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" id="student-fullname" name="fullName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Curp</label>
              <input type="text" class="form-control" id="student-curp" name="curp" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Número de teléfono</label>
              <input type="text" class="form-control" id="student-phone" name="phone" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input type="email" class="form-control" id="student-mail" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="student-password" name="password" required>
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


  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const modalEstudiante = document.getElementById('modalEstudiante');
      const modalEliminar = document.getElementById('modalEliminar');

      if (modalEliminar) {
        modalEliminar.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget;
          const id = boton.getAttribute('data-id');
          
          document.getElementById('delete-id').value = id;
        });
      }
      
      if (modalEstudiante) {
        modalEstudiante.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget; 
          
          const form = document.getElementById('formEstudiante');
          const titulo = document.getElementById('modalTitulo');
          const btnSubmit = document.getElementById('btnSubmitModal');
          
          const isCreateMode = boton.getAttribute('data-mode') === 'create';

          if (isCreateMode) {

            titulo.textContent = "Añadir Alumno";
            btnSubmit.textContent = "Agregar alumno";
            form.action = '../services/register_student.php';
            form.reset();
            document.getElementById('student-id').value = "";
            document.getElementById('student-mail').disabled = false;
            document.getElementById('student-password').disabled = false;

          } else {
            
            titulo.textContent = "Editar Alumno"; // PAra que sea dinamico, osea, no poner dos modales,. solo 1 reutilizable kajsd
            btnSubmit.textContent = 'Guardar Cambios'; // 
            form.action = "../services/update_student.php"; // Aqui ps cambie el servicio por si es update o insert
            
            document.getElementById('student-id').value = boton.getAttribute('data-id');
            document.getElementById('student-fullname').value = boton.getAttribute('data-fullname');
            document.getElementById('student-curp').value = boton.getAttribute('data-curp');
            document.getElementById('student-phone').value = boton.getAttribute('data-phone');
            document.getElementById('student-mail').value = boton.getAttribute('data-mail');

            document.getElementById('student-mail').disabled = true;
            document.getElementById('student-password').disabled = true;
          }
        });
      }
    });
  </script>
</body>
</html>