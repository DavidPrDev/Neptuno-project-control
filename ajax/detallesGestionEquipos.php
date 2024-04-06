<?php

require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";


$idEquipo = $_POST['idEquipo'];
$idEquipoA = $_POST['idEquipoA'];

$homeJefeService = new homeJefeService();

$datosEquipo = $homeJefeService->getCrudEquipo($idEquipoA, $idEquipo);

$jsonDatosEquipos = json_encode($datosEquipo);

echo $jsonDatosEquipos;
