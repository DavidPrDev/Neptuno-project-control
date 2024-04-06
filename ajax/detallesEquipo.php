<?php

require "../config/config.php";
require __DIR__ . "/../service/crudProyectos.php";

$crudService = new crudProyectosService();

$datosEquipo = $crudService->getEquipos();

$jsonDatosEquipo = json_encode($datosEquipo);
echo $jsonDatosEquipo;
