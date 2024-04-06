<?php
require "base.php";
require __DIR__ . "/../service/homeDesarrollador.php";


if (!isset($_SESSION['IdEmpleado'])) {
    header("Location: http://localhost/dpr/1846/ProyectoFinalMvc/index.php?controller=global&action=index");
    exit();
}
class HomeDesarrolladorController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->serviceObj = new homeDesarrolladorService(); //Creacion del objeto para poder invocar sus metodos 

    }


    public function proyecto()
    {
        $this->view = "proyecto";

        $proyectosObj = $this->serviceObj->getProyecto();

        if ($proyectosObj == "") {
            // Ambos sub-arrays están vacíos
            return "<h4>No tiene ningun proyecto asignado pongase en contacto con administracion </h4>";
        } else {
            // Al menos uno de los sub-arrays no está vacío

            $html = "";
            $html .= "<table class='table'>
        <tbody> 
        <div class='row g-3 align-items-center mt-2 mb-3 seleccionProyecto'>
            <div class='col-3'>
                <label for='comentario' class='col-form-label'><b>Selecion de proyectos</b></label>
            </div>
            <div class='col-8'>
            <select class ='form-control' id='seleccionProyectos'>";
            foreach ($proyectosObj["idProyectos"] as $proyectos) {

                $html .= " <option value='{$proyectos['idProyecto']}' >{$proyectos['nombreProyecto']}</option>";
            }
            $html .= "</select> </div>
            <div class='col-1'></div>
            </div>";
            foreach ($proyectosObj["proyecto"] as $proyecto) {
                $html .= "
                <tr>
                    <th><b>Nombre proyecto:</b></th>
                    <td id='nombreProyecto'>{$proyecto['nombreProyecto']}</td>
                    </tr>
                    <tr>
                        <th><b>Descripcion</b></th>
                        <td id='descripcion'>{$proyecto['descripcion']}</td>
                    </tr>
                    <tr>
                        <th><b>F.inicio</b></th>
                        <td id='fechaInicio'>{$proyecto['fechaInicio']}</td>
                    </tr>
                    <tr>
                        <th><b>F.fin</b></th>
                        <td id='fechaFinalizacion'>{$proyecto['fechaFinalizacion']}</td>
                    </tr>
                    <tr>
                        <th><b>Horas Estipuladas</b></th>
                        <td id='horasTotal'>{$proyecto['horas_total']}</td>
                    </tr>
                    <tr>
                        <th><b>Cliente</b></th>
                        <td id='cliente'>{$proyecto['Cliente']}</td>
                    </tr>
                    <tr>
                        <th><b>Prioridad</b></th>
                        <td id='prioridad'>{$proyecto['prioridad']}</td>
                    </tr>";

                $html .= "<tr>
                        <th><b>Etapas</b></th><td>
                        <div class='accordion' id='accordionExample'>
                        <div class='accordion-item'>
                          <h2 class='accordion-header' id='headingOne'>
                            <button class='accordion-button' type='button' data-target='#collapse1' data-bs-toggle='collapse' data-bs-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                             Etapas del proyecto
                            </button>
                          </h2>
                          <div id='collapseOne' class='accordion-collapse collapse ' aria-labelledby='headingOne' data-bs-parent='#accordionExample'>
                            <div class='accordion-body'><table class='table' id='tablaEtapas' >";
                //tabla con etapas

                if (count($proyectosObj["etapas"]) > 0) {
                    $html .= " <thead>
                                <tr>
                                <th scope='col'>Id etapa</th>
                                <th scope='col'>Nombre etapa</th>
                                <th scope='col'>descripcion</th>
                                <th scope='col'>Estado</th>
                                
                                </tr>
                                </thead>
                                <tbody>";
                    foreach ($proyectosObj["etapas"] as $etapa) {
                        $estado = $etapa["completada"] == 1 ? "<i data-toggle='tooltip' data-placement='top' title='Tarea Completada' class='fa-solid fa-check fa-lg completada'></i>" : "<a  data-toggle='tooltip' data-placement='top' title='Clicke para completar'  href='javascript:completarEtapa({$etapa['idEtapa']})'><i data-bs-toggle='modal' data-bs-target='#modalCompletarEtapa'  class='fa-solid fa-x fa-lg noCompletada' ></i></a>";
                        $html .= "<tr>
                          <td>{$etapa['idEtapa']}</td>
                          <td>{$etapa['nombreEtapa']}</td>
                          <td>{$etapa['descripcion']}</td>
                          <td class='text-center' >{$estado}</td>
                        </tr>";
                    }

                    $html .= "</tbody>";
                } else {

                    $html .= "<span id='infoEtapa'>Este proyecto todavia no tiene etapas</span>";
                }

                $html .= "</table></td></tr></div></div></div></div>";


                $html .= "</tbody></table>";
            }
            return $html;
        }
    }
}
