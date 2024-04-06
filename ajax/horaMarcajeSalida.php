<?php
session_start();
require "../config/config.php";
require __DIR__ . "/../service/datosMarcaje.php";

$idEmpleado = $_SESSION['IdEmpleado'];

$devService = new datosMarcajeService();
$Obj = $devService->updateMarcaje($idEmpleado);

var_dump($Obj);
