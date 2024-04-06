<?php

require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

$crudService = new homeJefeService();

$datosEquipo = $crudService->getJefe();

$jsonDatosEquipo = json_encode($datosEquipo);
echo $jsonDatosEquipo;
