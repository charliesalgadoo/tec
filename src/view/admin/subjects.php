<?php
// validacion de usuario (RBAC)
  include_once('../../services/auth/auth.php');
  require_role('ADMIN'); //rol necesario
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administración | Materias</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="svg+xml" href="../../assets/logo-icon.svg" />
  
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php"> <img src="../../assets/logo-transparent-white.png" alt="Logo" width="150" height="auto"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="home.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="me.php">Yo</a></li>
          <li class="nav-item"><a class="nav-link" href="teachers.php">Profesores</a></li>
          <li class="nav-item"><a class="nav-link" href="students.php">Alumnos</a></li>
          <li class="nav-item"><a class="nav-link" href="groups.php">Grupos</a></li>
          <li class="nav-item"><a class="nav-link active" href="subjects.php">Materias</a></li>
        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="btn btn-outline-danger" href="../../services/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container w-100 text-center py-5">
    <h1 class="mb-4">Administrar Materias</h1>

    <div class="row justify-content-end mb-3">
      <div class="col-md-4 text-end">
        <!--boton para abrir el modal, indicamos que es modo creacion-->
        <button class="btn btn-outline-secondary" id="btnNuevaMateria" data-bs-toggle="modal" data-bs-target="#modalMateria" data-mode="create">
          + Agregar materia
        </button>
      </div>
    </div>

    <!--tabla de las materias-->
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light text-secondary">
              <tr>
                <th scope="col" class="py-3">ID</th>
                <th scope="col" class="py-3">Nombre de la Materia</th>
                <th scope="col" class="py-3">Profesor Titular</th>
                <th scope="col" class="py-3">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!--cargamos la tabla desde el servicio-->
              <?php include_once("../../services/subjects/get_subjects.php"); ?>       
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!--modal reutilizable para crear y editar-->
  <div class="modal fade" id="modalMateria" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitulo">Gestión de Materia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form id="formMateria" method="POST" action="">
          <div class="modal-body text-start">
            <!--input oculto pal id-->
            <input type="hidden" id="subject-id" name="id">
            
            <div class="mb-3">
              <label class="form-label">Nombre de la Materia</label>
              <input type="text" class="form-control" id="subject-name" name="subject_name" required>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Asignar Profesor</label>
              <select class="form-select" id="subject-teacher" name="teacher_id" required>
                <option value="" selected disabled>Selecciona un profesor...</option>
                <?php
                  include('../../api/conn.php'); //conexion a la bd
                  $profes = $conn->query("SELECT id, full_name FROM teachers"); //traemos a todos los profes
                  while($profe = $profes->fetch_assoc()) {
                      echo "<option value='{$profe['id']}'>{$profe['full_name']}</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <!--boton de guardar q se vuelve editar o crear-->
            <button type="submit" class="btn btn-primary" id="btnSubmitModal">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--modal de confirmacion de borrar-->
  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Confirmar Eliminación</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!--form pa borrar-->
        <form id="formEliminar" method="POST" action="../../services/subjects/delete_subject.php">
          <div class="modal-body text-center py-4">
            <i class="fas fa-exclamation-triangle text-warning fs-1 mb-3"></i>
            <p class="fs-5">¿Seguro que deseas eliminar esta materia?</p>
            <p class="text-muted small">Se borrarán todas las calificaciones y asistencias relacionadas.</p>
            <!--id a eliminar-->
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
    //cuando el documento ya cargo todo
    document.addEventListener('DOMContentLoaded', () => {
      const modalMateria = document.getElementById('modalMateria');
      const modalEliminar = document.getElementById('modalEliminar');

      //si se abre el modal de eliminar, capturamos el id q viene del boton
      if (modalEliminar) {
        modalEliminar.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget;
          document.getElementById('delete-id').value = boton.getAttribute('data-id');
        });
      }

      //si se abre el modal de editar/crear
      if (modalMateria) {
        modalMateria.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget; 
          const form = document.getElementById('formMateria');
          const titulo = document.getElementById('modalTitulo');
          const btnSubmit = document.getElementById('btnSubmitModal');
          const isCreateMode = boton.getAttribute('data-mode') === 'create'; //vemos si es modo crear

          //si es modo crear le ponemos todo en blanco y cambiamos la accion
          if (isCreateMode) {
            titulo.textContent = "Añadir Materia";
            btnSubmit.textContent = "Crear materia";
            form.action = '../../services/subjects/register_subject.php'; 
            form.reset();
            document.getElementById('subject-id').value = "";
          } else {
            //si no, es editar
            titulo.textContent = "Editar Materia";
            btnSubmit.textContent = "Guardar cambios";
            form.action = '../../services/subjects/update_subject.php'; 
            
            //rellenamos los datos del boton en el form para que aparezcan ya escritos
            document.getElementById('subject-id').value = boton.getAttribute('data-id');
            document.getElementById('subject-name').value = boton.getAttribute('data-name');
            document.getElementById('subject-teacher').value = boton.getAttribute('data-teacher');
          }
        });
      }
    });
  </script>
</body>
</html>