<?php

require "../config/config.php";
require '../service/login.php';


$usuario = $_POST['usuario'];

$contrasena = $_POST['contrasenna'];


$empleado = new LoginService();


$cosa = $empleado->getlogin($usuario, $contrasena);

echo $cosa;