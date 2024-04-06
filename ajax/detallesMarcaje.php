<?php

require "../config/config.php";
require __DIR__ . "/../service/homeAdministracion.php";


$idEmpleado = $_POST['idEmpleado'];
$crudService = new homeAdministracionService();

$datosProyecto = $crudService->getCrudMarcaje($idEmpleado);

$jsonDatosProyecto = json_encode($datosProyecto);
echo $jsonDatosProyecto;
