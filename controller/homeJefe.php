<?php
require "base.php";
require __DIR__ . "/../service/homeJefe.php";

if (!isset($_SESSION['IdEmpleado'])) {
    header("Location: http://localhost/dpr/1846/ProyectoFinalMvc/index.php?controller=global&action=index");
    exit();
}

class HomeJefeController extends BaseController
{
    protected $tituloSeoIndex;

    public function __construct()
    {
        parent::__construct();
        $this->serviceObj = new homeJefeService();
    }

    public function crudEquipos()
    {
        //pagina corporativa de la aplicacion
        $this->view = "crudEquipos";
        $this->page_title = 'Gestion Equipos';
        $this->description = 'Pagina para la gestion de los equipos  de la empresa neptuno ';


        $equiposObj =  $this->serviceObj->getListadoEquipos();
        $html = "";

        foreach ($equiposObj as $equipo) {


            $jefe = ($equipo["nombreJefe"] != null) ? $equipo["nombreJefe"] : "(sin datos)";
            $nombreProyecto = ($equipo["nombreProyecto"] != null) ? $equipo["nombreProyecto"] : "(sin datos)";
            $idEquipoProyecto = $equipo["idEquiposProyecto"] == null ? 0 : $equipo["idEquiposProyecto"];
            $idEquipo = $equipo["idEquipo"];
            $parametros = $idEquipoProyecto . "," . $idEquipo;
            $html .= "<tr>
                        <td> {$equipo["idEquipo"]} </td>
                        <td>{$nombreProyecto}</td>
                        <td>{$jefe} </td>
                        <td>
                        <a href='javascript:detallesEquipo({$parametros})'><i data-bs-toggle='modal'
                        data-bs-target='#staticBackdropEquipos' class='fa-regular fa-folder-open fa-xl'></i></a>
                            <a class='iconoBorrar' href='javascript:eliminarEquipo({$equipo["idEquipo"]})'><i class='fa-solid fa-trash-can fa-xl'></i></a>
                        </td>
                    </tr>";
        }
        return $html;
    }


    public function crudEtapas()
    {
        $this->view = "crudEtapas";
        $this->page_title = 'Gestion Etapas';
        $this->description = 'Pagina para la gestion de las etapas  de un proyecto ';
        $etapasObj =  $this->serviceObj->getListadoEtapas();
        $html = "";
        foreach ($etapasObj as $etapa) {

            $completada = $etapa["completada"] == 1 ? "<i data-toggle='tooltip' data-placement='top' title='Tarea Completada' class='fa-solid fa-check fa-lg completada' ></i>" : "<i data-toggle='tooltip' data-placement='top' title='No completada' class='fa-solid fa-x fa-lg noCompletada' data-value='0'></i>";


            $html .= "<tr data-idetapa='{$etapa['idEtapa']}'>
                        <td> {$etapa['idEtapa']} </td>
                        <td>{$etapa['nombreEtapa']}</td>
                        <td>{$etapa['nombreProyecto']} </td>
                        <td class='text-center'>{$completada}</td>
                        <td>
                        <a href='javascript:detallesEtapa({$etapa["idEtapa"]})'><i  class='fa-regular fa-folder-open fa-xl'></i></a>
                            <a class='iconoBorrar' href='javascript:eliminarEtapa({$etapa["idEtapa"]})'><i class='fa-solid fa-trash-can fa-xl'></i></a>
                        </td>
                    </tr>";
        }
        return $html;
    }
}
