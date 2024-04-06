<?php
require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

$jsonData = $_POST['data'];

$objeto = json_decode($jsonData);

$jefeService = new homeJefeService();

$result = $jefeService->createEtapa($objeto);

echo $result;
