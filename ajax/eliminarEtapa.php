<?php
require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

$idEtapa = $_POST['idEtapa'];

$jefeService = new homeJefeService();

$result = $jefeService->deleteEtapa($idEtapa);

echo $result;
