<?php
session_start();
require "../config/config.php";
require __DIR__ . "/../service/datosMarcaje.php";

$IdEmpleado = $_SESSION['IdEmpleado'];
$data = $_POST["jsonData"];
$dataReceived = json_decode($data, true);


if (isset($dataReceived["comentario"])) {
    $comentario = $dataReceived["comentario"];
} else {
    $comentario = null;
}


$devService = new datosMarcajeService();
$Obj = $devService->createMarcaje($IdEmpleado,  $comentario);

var_dump($dataReceived["comentario"]);
