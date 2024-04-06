<?php

require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";


$idEtapa = $_POST["idEtapa"];

$homeEmpleadosService = new homeJefeService();

$etapaCompleta = $homeEmpleadosService->getEtapaCompleta($idEtapa);

$jsonEmpleadosEquipos = json_encode($etapaCompleta);

echo $jsonEmpleadosEquipos;
