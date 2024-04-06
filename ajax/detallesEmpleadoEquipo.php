<?php

require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

if (isset($_POST["idEquipoA"])) {
    $idEquipoA = $_POST["idEquipoA"];
    $homeEmpleadosService = new homeJefeService();

    $empleadosEquipo = $homeEmpleadosService->getEmpleadosEquipo($idEquipoA);

    $jsonEmpleadosEquipos = json_encode($empleadosEquipo);

    echo $jsonEmpleadosEquipos;
} else {
    $homeEmpleadosService = new homeJefeService();

    $empleadosEquipo = $homeEmpleadosService->getEmpleadosEquipo();

    $jsonEmpleadosEquipos = json_encode($empleadosEquipo);

    echo $jsonEmpleadosEquipos;
}
