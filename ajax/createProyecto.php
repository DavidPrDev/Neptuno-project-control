<?php
require "../config/config.php";
require __DIR__ . "/../service/crudProyectos.php";

$jsonData = $_POST['data'];

$objeto = json_decode($jsonData);


$crudService = new crudProyectosService();

$result = $crudService->createProyecto($objeto);

echo $result;
