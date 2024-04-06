<?php
require "base.php";
require __DIR__ . "/../service/homeAdministracion.php";


if (!isset($_SESSION['IdEmpleado'])) {
    header("Location: http://localhost/dpr/1846/ProyectoFinalMvc/index.php?controller=global&action=index");
    exit();
}

class HomeAdministracionController extends BaseController
{
    protected $tituloSeoIndex;

    public function __construct()
    {
        parent::__construct();
        $this->serviceObj = new homeAdministracionService(); //Creacion del objeto para poder invocar sus metodos 

    }

    public function crudEmpleados()
    {
        //pagina corporativa de la aplicacion
        $this->view = "crudEmpleados";
        $this->page_title = 'Gestion Empleador';
        $this->description = 'Pagina para la gestion de empleados de la empresa neptuno ';

        $empleadosObj = $this->serviceObj->getListadoCrudEmpleados();

        $html = "";

        foreach ($empleadosObj as $empleado) {
            $html .= "<tr>
                        <td> {$empleado["idEmpleado"]} </td>
                        <td>{$empleado["nombre"]} </td>
                        <td>{$empleado["pais"]} </td>
                        <td>{$empleado["telDomicilio"]}</td>
                        <td>{$empleado["usuario"]}</td>
                        <td>{$empleado["email"]}</td>
                        <td>
                            <a href='javascript:detallesEmpleado({$empleado['idEmpleado']})'><i data-bs-toggle='modal'
                                    data-bs-target='#staticBackdropEmpleados' class='fa-regular fa-folder-open fa-xl'></i></a>
                            <a class='iconoBorrar' href='javascript:eliminarEmpleado({$empleado["idEmpleado"]})'><i class='fa-solid fa-trash-can fa-xl'></i></a>
                        </td>
                    </tr>";
        }
        return $html;
    }
    public function crudMarcajes()
    {
        //pagina corporativa de la aplicacion
        $this->view = "crudMarcajes";
        $this->page_title = 'Gestion Marcajes';
        $this->description = 'Pagina para la gestion de marcajes de los empleados de la empresa neptuno ';

        $empleadosObj = $this->serviceObj->getListadoCrudMarcajes();
        $html = "";
        $horaActual = "08:00:00";
        $horaLimite = "08:15:00";
        $datetime3 = DateTime::createFromFormat('H:i:s', $horaLimite);
        $datetime1 = DateTime::createFromFormat('H:i:s', $horaActual);
        foreach ($empleadosObj as $empleado) {

            $datetime2 = DateTime::createFromFormat('H:i:s', $empleado["horaEntrada"]);
            $finalizada = ($empleado["jornadaFinalizada"] == 1) ? 'Si' : 'No';
            $claseHorario = "";
            if ($datetime2 > $datetime1 && $datetime2 < $datetime3) {
                $claseHorario = "class='badge bg-warning text-dark'";
            } else if (
                $datetime2 >
                $datetime3
            ) {
                $claseHorario = "class='badge bg-danger'";
            } else {
                $claseHorario = "class='badge bg-success'";
            }
            $html .= "<tr>";
            $html .= "<td>{$empleado["idMarcaje"]}</td>";
            $html .= "<td>{$empleado["nombre"]}</td>";
            $html .= "<td><span {$claseHorario} >{$empleado["horaEntrada"]}</span></td>";
            $html .= "<td>{$empleado["horaSalida"]}</td>";
            $html .= "<td>{$empleado["fecha"]}</td>";
            $html .= "<td>{$finalizada}</td>";
            $html .= "<td><a href='javascript:detallesMarcaje({$empleado["idMarcaje"]})'><i data-bs-toggle='modal'
                    data-bs-target='#staticBackdropMarcaje' class='fa-regular fa-folder-open fa-xl'></i></a>
            <a class='iconoBorrar' href='javascript:eliminarMarcaje( {$empleado["idMarcaje"]} )'><i
                    class='fa-solid fa-trash-can fa-xl'></i></a>
        </td>";
            $html .= "</tr>";
        }

        return $html;
    }
}
