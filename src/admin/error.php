<!-- Esta vista aparece cuando hay un error de mysql-->
<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Error en el sistema</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="svg+xml" href="../assets/logo-icon.svg" />
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-lg rounded-4 p-5">
          
          <div class="text-danger mb-4">
            <i class="fas fa-exclamation-triangle fa-5x"></i>
          </div>
          
          <h1 class="fw-bold mb-3">¡Uy! Algo salió mal</h1>
          
          <p class="text-muted fs-5 mb-4">
            Ocurrio un error inesperado en el <strong>servidor</strong>.
          </p>
          
          <button onclick="window.history.back();" class="btn btn-dark btn-lg rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i> Regresar e intentar de nuevo
          </button>
          
        </div>
      </div>
    </div>
  </div>

</body>
</html>