<?php

require "../config/config.php";
require __DIR__ . "/../service/crudProyectos.php";
$crudService = new crudProyectosService();
if (isset($_POST['idProyecto'])) {
    $idProyecto = $_POST['idProyecto'];


    $datosProyecto = $crudService->getCrudProyecto($idProyecto);

    $jsonDatosProyecto = json_encode($datosProyecto);
    echo $jsonDatosProyecto;
} else {

    $datosProyecto = $crudService->getCrudProyecto();
    $jsonDatosProyecto = json_encode($datosProyecto);
    echo  $jsonDatosProyecto;
}
