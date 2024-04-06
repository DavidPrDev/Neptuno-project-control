<?php
require "../config/config.php";
require __DIR__ . "/../service/crudProyectos.php";

$idProyecto = $_POST['idProyecto'];

$crudService = new crudProyectosService();

$result = $crudService->deleteProyecto($idProyecto);

echo $result;
