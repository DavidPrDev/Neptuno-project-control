<?php
require "../config/config.php";
require __DIR__ . "/../service/homeJefe.php";

$idEquipo = $_POST['idEquipo'];

$jefeService = new homeJefeService();

$result = $jefeService->deleteEquipo($idEquipo);

echo $result;
