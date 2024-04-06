<?php
require "../config/config.php";
require __DIR__ . "/../service/homeDesarrollador.php";

$jsonData = $_POST['data'];

$objeto = json_decode($jsonData);


$devService = new homeDesarrolladorService();

$result = $devService->updateEtapa($objeto);

echo $result;
