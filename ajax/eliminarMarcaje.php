<?php
require "../config/config.php";
require __DIR__ . "/../service/homeAdministracion.php";


$idMarcaje = $_POST['idMarcaje'];
$crudService = new homeAdministracionService();

$datosEmpleados = $crudService->deleteMarcaje($idMarcaje);

echo $result;
