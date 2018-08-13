<?php session_start();

//importamos nuestra ruta
require 'admin/config.php';

//importamos las nuestrasfunciones
require 'functions.php';

//si el metdodo requerido es igual a post vamos a extraer los nombres de los imputs a utilizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //vamos a guardar los datos de los imputs en variables
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];
  $password = hash('sha512', $password);
  $rol = $_POST['rol'];

  //creamos una variable que se llame errores y estara vacia
  //ya que en ella se van a ir almacenando los errores que aparezcan para luego mostrarlos
  $errores = '';

  //validar los campos de texto que no esten vacios
  if (empty($usuario) || empty($password) || empty($rol) ) {
    //mandamos un mensaje de error
    $errores.="<li class='error'>Por favor rellene todos los campos</li>";
  }else {
    // validacion de que el usuario no exista
    //primero hacemos la conexión a la base de datos
    $conexion = conexion($config_BD);

    //vamos a asignar a la variable $stament la siguiente sentencial sql
    //seleccionar todos los campos de la tabla usuario donde usuario sea igual a la ariable :usuario que normalmente es un placeholder
    //y que tenga un limite de 1 registro con el nombre de ese usuario.
    $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
    //vamos a ejecutar la sentencia sql
    $statement->execute([
      ':usuario' => $usuario
    ]);

    /* la variable $resultado nos va a traer toda la sentencia sql preparada, mas la ejecución
    y todos los valores de esa tabla*/
    $resultado = $statement->fetch();

    //creamos una condición para evaluar si el usuario existe
    if ($resultado != false) {
      //si el usuario existe concatenamos un mensaje de error a la variable $errores
      $errores .= '<li class="error">Este usuario ya existe</li>';
    }//fin del if para verificar que el usuario existe


    #si no hay ningún error haremos la insercción en la base de datos
    if ($errores == '') {
      //nos conectamos a la bd
      $conexion = conexion($config_BD);

      $statement = $conexion->prepare('INSERT INTO usuarios (id_usuarios, usuario, password, tipo_usuario)
        VALUES(null, :usuario, :password, :tipo_usuario) ');

      //ejecutamos la sentencial
      $statement->execute([
        ':usuario' => $usuario,
        ':password' => $password,
        ':tipo_usuario' => $rol
      ]);

      //si se cumple todo esto, se redirecciona a login.php
        header('Location '.RUTA.'login.php');
    }//fin de if($errores == '')


  }//fin del if(empty($usuario) || empty($password) || empty($rol) )

}

//importamos nuestra vista
require 'views/registro.view.php';


 ?>
