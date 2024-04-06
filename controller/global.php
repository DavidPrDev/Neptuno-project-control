<?php
require "base.php";
require "service/login.php";
require __DIR__ . "/../service/datosMarcaje.php";
require __DIR__ . "/../service/crudProyectos.php";
require __DIR__ . "/../service/datosPersonales.php";
class GlobalController extends BaseController
{
    protected $datosService;
    protected $projectoService;
    protected $datosPersonalesService;

    public function __construct()
    {
        parent::__construct();
        $this->datosService = new datosMarcajeService();
        $this->projectoService = new crudProyectosService();
        $this->datosPersonalesService = new datosPersonalesService();
    }

    public function index()
    {
        //pagina corporativa de la aplicacion
        $this->view = "index";
        $this->page_title = 'Login Neptuno';
        $this->description = 'pagina para hacer login en neptuno taks manager';
    }
    public function logOut()
    {
        session_start();
        session_destroy();
        header("location:index.php");
    }
    public function marcaje()
    {
        //pagina corporativa de la aplicacion
        $this->view = "marcaje";
        $this->page_title = 'Marcaje empleados';
        $this->description = 'pagina de home de un empleado de administracion de neptuno';
        if (!isset($_SESSION['IdEmpleado'])) {
            header("Location: http://localhost/dpr/1846/ProyectoFinalMvc/index.php?controller=global&action=index");
            exit();
        }
        $IdEmpleado = $_SESSION['IdEmpleado'];

        $horasObj = $this->datosService->getDatos($IdEmpleado);

        return $horasObj;
    }
    public function crudProyectos()
    {
        if (!isset($_SESSION['IdEmpleado'])) {
            header("Location: http://localhost/dpr/1846/ProyectoFinalMvc/index.php?controller=global&action=index");
            exit();
        }
        //pagina corporativa de la aplicacion
        $this->view = "crudProyectos";
        $this->page_title = 'Gestion Proyectos';
        $this->description = 'Pagina para la gestion de proyectos de la empresa neptuno ';

        $proyectoObj = $this->projectoService->getListadoCrudProyectos();
        $html = "";

        foreach ($proyectoObj as $proyecto) {

            $html .= "<tr>
        <td> {$proyecto['idProyecto']} </td>
        <td> {$proyecto['nombreProyecto']} </td>
        <td> {$proyecto['fechaFinalizacion']} </td>
        <td> {$proyecto['horas_registradas']} </td>
        <td> {$proyecto['horas_total']} </td>
        <td> {$proyecto['Cliente']} </td>
        <td> {$proyecto['prioridad']} </td>
        <td >
            <a href='javascript:mostrarDetalles({$proyecto['idProyecto']})'><i data-bs-toggle='modal'
            data-bs-target='#staticBackdrop' class='fa-regular fa-folder-open fa-xl'></i></a>
                <a class='iconoBorrar' href='javascript:eliminarProyecto({$proyecto['idProyecto']})'><i class='fa-solid fa-trash-can fa-xl'></i></a>
        </td>
        </tr>";
        }
        return $html;
    }
    public function datosPersonales()
    {
        if (!isset($_SESSION['IdEmpleado'])) {
            header("Location: http://localhost/dpr/1846/ProyectoFinalMvc/index.php?controller=global&action=index");
            exit();
        }
        //pagina corporativa de la aplicacion
        $this->view = "datosPersonales";
        $this->page_title = 'Datos Personales';
        $this->description = 'Pagina con los datos personales del empleado ';

        $datosObj = $this->datosPersonalesService->getDatosEmpleado();


        $html = "<input type='hidden' id='idEmpleadoD' value='{$datosObj['idEmpleado']}'>";
        $html .= "<table class='table'><tbody>";
        $categoria = $datosObj['nombreCategoria'] == null ? "(Sin categoria)" : $datosObj['nombreCategoria'];
        $html .= "
         <tr>
            <th><b>Nombre Empleado:</b></th>
            <td ><input id='nombreD'  value='{$datosObj['nombre']}' type='text' class='form-control' disabled></td>
        </tr>
        <tr>
            <th><b>Direccion</b></th>
            <td ><input id='direccionD' value='{$datosObj['direccion']}' type='text' class='form-control' disabled></td>
        </tr>
        <tr>
            <th><b>Pais</b></th>
            <td ><input id='paisD' value='{$datosObj['pais']}' type='text' class='form-control' disabled></td>
        </tr>
        <tr>
            <th><b>Ciudad</b></th>
            <td ><input id='ciudadD' value='{$datosObj['ciudad']}' type='text' class='form-control' disabled></td>
        </tr>
        <tr>
            <th><b>Telefono</b></th>
            <td ><input id='telefonoD'value='{$datosObj['telDomicilio']}' type='text' class='form-control' disabled></td>
        </tr>
        <tr>
            <th><b>Usuario</b></th>
            <td ><input id='usuarioD' value='{$datosObj['usuario']}' type='text' class='form-control' disabled></td>
        </tr>
        <tr>
            <th><b>Contraseña</b></th>
            <td ><input id='contrasennaD' value='123456' type='password' class='form-control' disabled></td>
        </tr>
        <tr>
            <th><b>Email</b></th>
            <td ><input id='emailD' value='{$datosObj['email']}' type='text' class='form-control' disabled></td>
        </tr>
        
        <tr>
            <th><b>Categoria</b></th>
            <td ><input value='{$categoria}' type='text' class='form-control' disabled></td>
        </tr>
            
        </tbody>
        </table>";

        return $html;
    }
}
