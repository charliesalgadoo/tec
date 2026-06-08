<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Inicio | Estudiantes</title>
    <link rel="icon" type="svg+xml" href="../../assets/logo-icon.svg" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
   
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
          <img src="../../assets/logo-transparent-white.png" alt="Logo" width="150" height="auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="home.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="me.php">Yo</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Mi Historial</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="scores.php">Mis Calificaciones</a></li>
                <li><a class="dropdown-item" href="attendances.php">Mis Asistencias</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav justify-content-end">
            <li class="nav-item"><a class="btn btn-outline-danger" href="../../services/logout.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="body-container w-100 text-center py-5">
      <h1 id="greet-hour"></h1>
      <h3 class="text-secondary mb-4">Tus accesos directos:</h3>

      <div class="row justify-content-center g-4">
        
        <div class="col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="../assets/icons/star.svg" width="50px" class="mb-3">
              <h5 class="card-title">Ver mis calificaciones</h5>
              <p class="card-text">Revisa las calificaciones de cada materia.</p>
              <a href="scores.php" class="btn btn-primary">Ir</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="../../assets/icons/person-check.svg" width="50px" class="mb-3">
              <h5 class="card-title">Ver asistencias</h5>
              <p class="card-text">Revisa los dia que has asistido y que clase tomaste.</p>
              <a href="attendances.php" class="btn btn-primary">Ir</a>
            </div>
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
          greet="Buenos días";
        } else if(time>=12 && time<19){
          greet="Buenas tardes";
        }else{
          greet="Buenas noches";
        }
        greetContainer.prepend(greet);
      }
    </script>
</body>
</html>