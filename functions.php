<?php
//archivo donde estaran todas nuestrasfunciones a realizar con la base de datos
//podria ser el modelo

//mandamos a llamar el archivo de configuración
require 'admin/config.php';

//creamos la función para conectarse a la base de datos que usara PDO para conectarse
function conexion($config_BD){
  try {
    #ESTRUCTURA DE UNA CONEXION PDO
    // $variable = new PDO('mysql:host=localhost;dbname=NombreBD','usuario','password');
    //hacemos la conexion a la base de datos
    $conexion = new PDO('mysql:host=localhost;dbname='.$config_BD['db_name'],$config_BD['user'],$config_BD['pass']);
    return $conexion;

  } catch (PDOException $e) {
    return false;
      //aquí va lo que pasara u ocurrida en caso no se logre la conexión a la base de datos

  }

}//fin de la función conexion

//función limpiarDatos nos servira a limpiar de caracteres que puedan inyectar codigo sql en nuestra base de datos
function limpiarDatos($datos){
  //evita que haya espacios al principio
  $datos = trim($datos);

  //htmlspecialchars — Convierte caracteres especiales en entidades HTML
  //nos tranforma todo caracter que pueda ser ejecutado como codigo a texto por ejemplo <>
  $datos = htmlspecialchars($datos);

  //filter_var — Filtra una variable con el filtro que se indique
  //parametro primero valor a filtrar y luego el filtro a aplicar
  //borrara todos los caracteres especiales y solo dejara texto
  //FILTER_SANITIZE_STRING ---- Elimina etiquetas, opcionalmente elimina o codifica caracteres especiales
  /*por ejemplo si escriben en el form
    <br> hola </br> con esta función borraria tanto las etiquetas br y el espacio en blanco
    dando como resultado el texto hola*/
  $datos = filter_var($datos, FILTER_SANITIZE_STRING);

  //retornamos los datos ya limpios
  return $datos;
}//final de la función limpiarDatos




 ?>
