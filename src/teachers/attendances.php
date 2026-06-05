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
        <a class="navbar-brand" href="home.php">
          <img src="../assets/logo-transparent-white.png" alt="Bootstrap" width="150" height="auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="home.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Yo</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Estudiantes
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="scores.php">Calificaciones</a></li>
                <li><a class="dropdown-item active" href="attendances.php">Asistencias</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="students.php">Administra tus alumnos</a></li>
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

    <div class="body-container w-100 text-center py-5 m-auto text-align-center p-5 m-5 border-5 m-5">
      <h1>Asistencias</h1>

      <div class="container">
        <div class="card border-0">
          <div class="card-body">

            <form action="" method="POST">
                <div class="mb-5 border-bottom text-start">
                <label class="form-label fw-bold">Buscar listas de asistencia del dia:</label>
                <input 
                  type="date" 
                  class="form-control w-auto"
                  id="#" 
                  name="#"
                  required                
                >
                <button class="btn btn-primary mt-3 mb-3">Buscar</button>
              </div>
            </form>
            
            <form action="../services/create_attendances.php" method="POST">
              
              <div class="mb-4 text-start">
                <label class="form-label fw-bold">Registrar asistencia del día: </label>
                <input 
                  type="date" 
                  class="form-control w-auto"
                  id="dateAttendance" 
                  name="dateAttendance"
                  required                
                >
              </div>

              <div class="table-responsive mb-4">
                <table class="table table-hover align-middle">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th class="text-center">Asistió</th>
                      <th class="text-center">Faltó</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include_once("../services/get_attendance_list.php"); ?>
                  </tbody>
                </table>
              </div>

              <div class="text-end">
                <button type="submit" class="btn btn-dark px-4">Guardar asistencias</button>
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


      /*Script para obtener la fecha actual y de esta manera se coloca en el calendario por default
      AUTHOR: Charlie
      */
      const inputFecha = document.getElementById('dateAttendance');
      if (inputFecha) {
        const hoy = new Date();
        
        const año = hoy.getFullYear();
        const mes = String(hoy.getMonth() + 1).padStart(2, '0'); // Los meses van de 0 a 11
        const dia = String(hoy.getDate()).padStart(2, '0');
        
        const fechaFormateada = `${año}-${mes}-${dia}`;
        
        inputFecha.value = fechaFormateada;
      }
    </script>
  </body>
</html>