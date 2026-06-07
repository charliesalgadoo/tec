<?php
// validacion de usuario (RBAC)
  include_once('../services/auth.php');
  require_role('ADMIN'); //rol necesario
?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Inicio | Admin</title>
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
            <li class="nav-item"><a class="nav-link active" href="home.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="me.php">Yo</a></li>
            <li class="nav-item"><a class="nav-link" href="teachers.php">Profesores</a></li>
            <li class="nav-item"><a class="nav-link" href="students.php">Alumnos</a></li>
            <li class="nav-item"><a class="nav-link" href="groups.php">Grupos</a></li>
            <li class="nav-item"><a class="nav-link" href="subjects.php">Materias</a></li>
          </ul>
          <ul class="nav justify-content-end">
            <li class="nav-item"><a class="btn btn-outline-danger" href="../services/logout.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container py-5">
      <h1 id="greet-hour" class="mb-4"></h1>
      <h3 class="text-secondary mb-5">Panel de Control:</h3>

      <div class="row justify-content-center g-4">
        
        <div class="col-md-3 col-lg-2">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="../assets/icons/person-gear.svg" width="50px" class="mb-3">
              <h5 class="card-title">Alumnos</h5>
              <p class="card-text small">Administra alumnos, inscripciones y datos personales.</p>
              <a href="students.php" class="btn btn-outline-primary btn-sm">Ir</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-2">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="../assets/icons/person-gear.svg" width="50px" class="mb-3">
              <h5 class="card-title">Profesores</h5>
              <p class="card-text small">Gestión de docentes y sus datos de contacto.</p>
              <a href="teachers.php" class="btn btn-outline-primary btn-sm">Ir</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-2">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="../assets/icons/person-gear.svg" width="50px" class="mb-3">
              <h5 class="card-title">Grupos</h5>
              <p class="card-text small">Administra grupos y asignación de tutores.</p>
              <a href="groups.php" class="btn btn-outline-primary btn-sm">Ir</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-2">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="../assets/icons/person-gear.svg" width="50px" class="mb-3">
              <h5 class="card-title">Materias</h5>
              <p class="card-text small">Crea materias y asígnalas a los docentes.</p>
              <a href="subjects.php" class="btn btn-outline-primary btn-sm">Ir</a>
            </div>
          </div>
        </div>

      </div>
    </div>

<!-- etiqueta para colocar scripts de JavaScript-->
    <script>
      const greetContainer = document.getElementById('greet-hour');

      //verificamos que el contenedor del texto se haya cargado correctamente
      if(greetContainer){
        const now = new Date(); //creamos un objeto date para obtener y trabajar fechas
        const time = now.getHours(); //obtener la hora actual

        let greet = ""; //mensaje que se va a mostrar, inicia vacio

        //verifiacion de los horarios en 24 horas
        if(time>=5 && time < 12){
          greet="Buenos días";//mostrar mensaje si es de dia
        } else if(time>=12 && time<19){
          greet="Buenas tardes"; //mostar si es tarde (entre las 12 y las 19 horas)
        }else{
          greet="Buenas noches"; //mostrar si es de noche si lo horarios anteriores no se cumplen
        }
        //poner el mensaje en el contenedor
        greetContainer.apend(greet);
      }
    </script>
</body>
</html>