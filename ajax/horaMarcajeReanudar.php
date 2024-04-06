<?php
session_start();
require "../config/config.php";
require __DIR__ . "/../service/datosMarcaje.php";

$IdEmpleado = $_SESSION['IdEmpleado'];

$devService = new datosMarcajeService();

$obj = $devService->reanudarMarcaje($IdEmpleado);

var_dump($obj);
