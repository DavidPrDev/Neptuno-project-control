<?php
require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

$jsonData = $_POST['data'];

$dataEquipo = json_decode($jsonData);


$crudService = new homeJefeService();

$result = $crudService->crearEquipo($dataEquipo);


echo var_dump($result);
