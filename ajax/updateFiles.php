<?php
session_start();
require "../config/config.php";
require __DIR__ . "/../service/homeDesarrollador.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $tipoArchivo = $_FILES['archivo']['type'];
    $tamanoArchivo = $_FILES['archivo']['size'];
    $contenidoArchivo = file_get_contents($_FILES['archivo']['tmp_name']);
}

$archivo = array(
    "nombreArchivo" => $nombreArchivo,
    "tipoArchivo" => $tipoArchivo,
    "tamanoArchivo" => $tamanoArchivo,
    "contenidoArchivo" =>  $contenidoArchivo
);

$devService = new homeDesarrolladorService();
$Obj = $devService->updateFiles($archivo);

var_dump($Obj);
