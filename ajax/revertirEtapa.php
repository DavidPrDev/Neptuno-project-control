<?php
require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

$jsonData = $_POST['data'];

$dataEtapa = json_decode($jsonData);


$jefeService = new homeJefeService();

$result = $jefeService->revertirEtapa($dataEtapa);


echo var_dump($result);
