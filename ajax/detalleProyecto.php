<?php
require "../config/config.php";
require __DIR__ . "/../service/homeDesarrollador.php";

$idProyecto = $_POST['data'];
session_start();
$crudService = new homeDesarrolladorService();

$result = $crudService->getProyecto($idProyecto);

$json = json_encode(array("proyecto" => $result["proyecto"][0], "etapas" => $result["etapas"]));
echo $json;
