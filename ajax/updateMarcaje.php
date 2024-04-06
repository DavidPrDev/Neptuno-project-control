<?php
require "../config/config.php";
require __DIR__ . "/../service/homeAdministracion.php";

$jsonData = $_POST['data'];

$objeto = json_decode($jsonData);


$crudService = new homeAdministracionService();

$result = $crudService->setMarcaje($objeto);


echo $result;
