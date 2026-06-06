<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Inicio | Maestros</title>
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
        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="btn btn-outline-danger" href="../services/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

    <div class="body-container w-100 text-center py-5 m-auto text-align-center p-5 m-5 border-5 m-5">
    <h1 id="greet-hour">Carlos</h1>
      <h3 class="text-secondary">Tus accesos directos:</h2> <br>

      <div class="col-sm-2">
      <div class="card">
        <div class="card-body">
          <img src="../assets/icons/person-gear.svg" width="50px">
          <br><br>
          <h5 class="card-title">Administrar alumnos</h5>
          <p class="card-text">Administra la información de tu grupo como nombre, correo, teléfono, etc.</p>
          <a href="students.php" class="btn btn-primary">Ir</a>
        </div>
      </div>
      </div>

      <div class="col-sm-2">
      <div class="card">
        <div class="card-body">
          <img src="../assets/icons/person-gear.svg" width="50px">
          <br><br>
          <h5 class="card-title">Administrar profesores</h5>
          <p class="card-text">Administra la información de los profesores.</p>
          <a href="teachers.php" class="btn btn-primary">Ir</a>
        </div>
      </div>
      </div>



    </div>
    <script>
      const greetContainer = document.getElementById('greet-hour');

      if(greetContainer){
        const now = new Date();
        const time = now.getHours();

        let greet = "";

        if(time>=0 && time < 12){
          greet="Buenos días, ";
        } else if(time>=12 && time<19){
          greet="Buenas tardes, ";
        }else{
          greet="Buenas noches, ";
        }
        greetContainer.prepend(greet);
      }
    </script>
</body>
</html>