<?php

require "../config/config.php";
require __DIR__ . "/../service/homeAdministracion.php";

$crudService = new homeAdministracionService();

$datosEquipo = $crudService->getCategoria();

$jsonDatosEquipo = json_encode($datosEquipo);
echo $jsonDatosEquipo;
