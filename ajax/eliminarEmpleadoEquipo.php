<?php
require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

$idEmpleado = $_POST['idEmpleado'];
$idEquipo = $_POST['idEquipo'];

$jefeService = new homeJefeService();

$result = $jefeService->deleteEmpleadoEquipo($idEmpleado, $idEquipo);

echo $result;
