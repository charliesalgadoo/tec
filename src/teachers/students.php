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
              <a class="nav-link inactive" aria-current="page" href="home.html">Inicio</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Yo</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Estudiantes
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="scores.html">Calificaciones</a></li>
                <li><a class="dropdown-item" href="attendances.html">Asistencias</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item active" href="students.html">Administra tus alumnos</a></li>
              </ul>
            </li>
            
            

          </ul>

          <ul class="nav justify-content-end">
            <li class="nav-item">
                <li class="nav-item">
                    <a class="btn btn-outline-danger" href="../login.html">Cerrar sesión</a>
                  </li>
              </li>
          </ul>

          
          
        
          <!--
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        -->
        </div>
      </div>
    </nav>
    <div class="body-container w-100 text-center py-5 m-auto text-align-center p-5 m-5 border-5 m-5">
    <h1>Administrar estudiantes</h1>
    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalAñadir">+ Agregar alumno</button>


        
  <div class="container">
    <div class="card border-0">
      <div class="card-body">
        

        <div class="table-responsive">
          <table class="table">
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
              <?php
                include_once("../services/get_students.php");
              ?>       
            </tbody>
          </table>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Alumno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEditar">
        <div class="modal-body">
          <input type="hidden" id="edit-id">
          
          <div class="mb-3">
            <label class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="edit-fullname" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Curp</label>
            <input type="text" class="form-control" id="edit-curp" required>
          </div>
 
          <div class="mb-3">
            <label class="form-label">Número de teléfono</label>
            <input type="text" class="form-control" id="edit-phone" required>
          </div>

            <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="text" class="form-control" id="edit-mail" required>
          </div>
            
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="text" class="form-control" id="edit-password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAñadir" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Añadir Alumno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formAgregar" method="POST" action="../services/register_student.php">
        <div class="modal-body">
          <input type="hidden" id="edit-id">
          
          <div class="mb-3">
            <label class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" name="fullName" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Curp</label>
            <input type="text" class="form-control" name="curp" required>
          </div>
 
          <div class="mb-3">
            <label class="form-label">Número de teléfono</label>
            <input type="text" class="form-control" name="phone" required>
          </div>

            <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="text" class="form-control" name="email" required>
          </div>
            
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="text" class="form-control" name="password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar alumno</button>
        </div>
      </form>
    </div>
  </div>
</div>





    </div>

    <script>
document.addEventListener('DOMContentLoaded', () => {
  const modalEditar = document.getElementById('modalEditar');

  if (modalEditar) {
    modalEditar.addEventListener('show.bs.modal', event => {
      const boton = event.relatedTarget; // Botón que disparó el modal
      

      const id = boton.getAttribute('data-id');
      const fullname = boton.getAttribute('data-fullname'); 
      const curp = boton.getAttribute('data-curp');
      const phone = boton.getAttribute('data-phone');
      const mail = boton.getAttribute('data-mail'); 
      const password = boton.getAttribute('data-password');

      // 2. Rellenar los campos correspondientes en el formulario del modal
      document.getElementById('edit-id').value = id;
      document.getElementById('edit-fullname').value = fullname;
      document.getElementById('edit-curp').value = curp;
      document.getElementById('edit-phone').value = phone;
      document.getElementById('edit-mail').value = mail;
      document.getElementById('edit-password').value = password;
    });
  }

  const formEditar = document.getElementById('formEditar');
  if (formEditar) {
    formEditar.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const id = document.getElementById('edit-id').value;
      const nombre = document.getElementById('edit-fullname').value;
      
      alert(`Actualizando al alumn@: ${nombre}`);
    });
  }
});
    </script>
</body>
</html>