<?php

require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";


$idEquipo = $_POST["idEquipo"];
$homeEmpleadosService = new homeJefeService();

$empleadosEquipo = $homeEmpleadosService->getEmpleadosEquipoAsign($idEquipo);

$jsonEmpleadosEquipos = json_encode($empleadosEquipo);

echo $jsonEmpleadosEquipos;
