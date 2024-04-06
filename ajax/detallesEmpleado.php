<?php

require "../config/config.php";
require __DIR__ . "/../service/homeAdministracion.php";


$idEmpleado = $_POST['idEmpleado'];
$crudService = new homeAdministracionService();

$datosEmpleados = $crudService->getCrudEmpleado($idEmpleado);

$jsonDatosProyecto = json_encode($datosEmpleados);

echo $jsonDatosProyecto;
