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
  <title>Administración | Grupos</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="svg+xml" href="../../assets/logo-icon.svg" />
  
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php"> <img src="../../assets/logo-transparent-white.png" alt="Logo" width="150" height="auto">
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
          <li class="nav-item"><a class="nav-link" href="subjects.php">Materias</a></li>
        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="btn btn-outline-danger" href="../../services/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container w-100 text-center py-5">
    <h1 class="mb-4">Administrar Grupos</h1>
    
    <button class="btn btn-outline-secondary mb-3" id="btnNuevoGrupo" data-bs-toggle="modal" data-bs-target="#modalGrupo" data-mode="create">
      + Agregar grupo
    </button>

    <div class="card border-0 ">
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
                <!--renderizado de grupos disponibles en la base de datos-->
              <?php include_once("../../services/groups/get_groups.php"); ?>       
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
              <label class="form-label">Nombre del Grupo (Ej: 4A)</label>
              <input type="text" class="form-control" id="group-name" name="group_name" maxlength="2" required>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Asignar Profesor</label>
              <select class="form-select" id="group-teacher" name="teacher_id" required>
                <option value="" selected disabled>Selecciona un profesor..</option>
                <?php
                  // obtener la conexion para hacer consultas
                  include('../../api/conn.php'); 

                  //query para obtener datos basicos del profesor
                  $profes = $conn->query("SELECT id, full_name FROM teachers");

                  //recorrer los resultados y agregarlos como elemento seleccionable a las opciones
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
        
        <form id="formEliminar" method="POST" action="../../services/groups/delete_group.php">
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
    //cargar script cuando la pagina este lista para evitar punteros a null
    document.addEventListener('DOMContentLoaded', () => {

    // obtener elementos HTML por su iD
      const modalGrupo = document.getElementById('modalGrupo');
      const modalEliminar = document.getElementById('modalEliminar');

      //validar si modalEliminar esta presente (es diferente de null)
      if (modalEliminar) {
        //evento de Bootstrap para modales
        modalEliminar.addEventListener('show.bs.modal', event => {
          //obtener el elemento con el que se abrio el modal, osea el boton
          const boton = event.relatedTarget;
          //asignar el valor del id "guardado" en el boton
          document.getElementById('delete-id').value = boton.getAttribute('data-id');
        });
      }
      
      //validar si modal esta presente (diferente de null)
      if (modalGrupo) {
        //evento de bootstrap para modal
        modalGrupo.addEventListener('show.bs.modal', event => {
          const boton = event.relatedTarget; // elemento que abrio el modal 
          
          //formulario
          const form = document.getElementById('formGrupo');
          //elemento dinamico con el titulo del modal
          const titulo = document.getElementById('modalTitulo');
          //boton dinamico  del modal para enviar datos
          const btnSubmit = document.getElementById('btnSubmitModal');

          //modo de edicion
          //guarda un booleano dependiendo si es modo de creacion o no
          const isCreateMode = boton.getAttribute('data-mode') === 'create';

          // si esta en modo de creacion (para hacer insert)
          if (isCreateMode) {

            titulo.textContent = "Añadir Grupo"; //poner el titulo del modal
            btnSubmit.textContent = "Crear grupo"; //titulo

            //si es modo de creacion, se envian a register_group.php
            form.action = '../../services/groups/register_group.php';

            form.reset(); // vaciar los campos del formulario al terminar
            document.getElementById('group-id').value = ""; //eliminar el id

          } else { //si el modo no es creacion, entonces es de actualizacion
            titulo.textContent = "Editar Grupo"; /
            btnSubmit.textContent = 'Guardar Cambios'; 
            form.action = "../../services/groups/update_group.php"; // Si creas el update después
            
            //rellenar los campos con los valores correspondientes
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