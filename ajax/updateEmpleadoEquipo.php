<?php
require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

$idEmpleado = $_POST['idEmpleado'];
$idEquipo = $_POST['idEquipo'];

$crudService = new homeJefeService();

$result = $crudService->updateEmpleadoEquipo($idEmpleado, $idEquipo);

echo $result;
