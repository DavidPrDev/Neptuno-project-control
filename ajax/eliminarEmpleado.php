<?php
require "../config/config.php";
require __DIR__ . "/../service/homeAdministracion.php";


$idEmpleado = $_POST['idEmpleado'];

$crudService = new homeAdministracionService();

$datosEmpleados = $crudService->deleteEmpleado($idEmpleado);

echo $datosEmpleados;
