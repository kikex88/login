<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Login</title>
</head>
<body class="bg-image2">
  <div class="container">
    <!-- echo htmlspecialchars($_SERVER['PHP_SELF']); esto hace mas segura evitando que haya inyección de sql-->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="input-group">
        <i class="fa fa-user-o icons" aria-hidden="false"></i>
        <input type="text" name="usuario" placeholder="Usuario" class="form-control">
      </div>

      <div class="input-group">
        <i class="fa fa-lock icons" aria-hidden="false"></i>
        <input type="password" name="contraseña" placeholder="Contraseña" class="form-control">
      </div>

      <button type="submit" name="submit" class="btn btn-flat-green">Ingresar</button>
    </form>

    <a href="#" class="login-link">¿No tienes cuenta?</a>
  </div>
</body>
</html>
