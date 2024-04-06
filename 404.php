<?php
require_once 'config/config.php';
$requested_url = $_SERVER['REQUEST_URI'];

$redirect_url = "";


if (strpos($requested_url, "marcaje-empleados/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=global&action=marcaje";
}
if (strpos($requested_url, "datos-empleados/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=global&action=datosPersonales";
}
if (strpos($requested_url, "gestion-etapas/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=homeJefe&action=crudEtapas";
}

if (strpos($requested_url, "gestion-equipos/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=homeJefe&action=crudEquipos";
}
if (strpos($requested_url, "crud-proyectos/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=global&action=crudProyectos";
}
if (strpos($requested_url, "crud-empleados/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=homeAdministracion&action=crudEmpleados";
}
if (strpos($requested_url, "crud-marcajes/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=homeAdministracion&action=crudMarcajes";
}

if (strpos($requested_url, "logout/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=global&action=logOut";
}
if (strpos($requested_url, "datos-proyecto/") !== false) {
    $redirect_url = BASE_URL . "index.php?controller=homeDesarrollador&action=proyecto";
}

//... resto de situaciones SEO


if ($redirect_url != "") {
    //SEO
    header("Location: $redirect_url");
    exit();
} else {
    //URL inexistente


    require_once 'view/template/header.php';

?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Página inexistente</h1>
                    <p>Repase su solicitud o acceda a la barra de navegación.</p>
                </div>
            </div>
        </div>
    </main>
<?php
    require_once 'view/template/aside.php';
    require_once 'view/template/links.php';
    require_once 'view/template/footer.php';
}
?>