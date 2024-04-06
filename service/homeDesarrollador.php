<?php
require_once 'Database.php';

class homeDesarrolladorService
{

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    public function getProyecto($idProyectoDetalle = null)
    {
        $this->db->connect();
        $IdEmpleado = $_SESSION['IdEmpleado'];

        $idProyecto = $this->db->selectInner(
            "proyectos pr 
            INNER JOIN equipos_proyectos ep ON ep.idProyecto=pr.idProyecto
            INNER JOIN equipos e ON e.idEquipo=ep.idEquipo
            INNER JOIN miembros_equipos me on me.idEquipo=e.idEquipo
            INNER JOIN empleados emp ON emp.idEmpleado=me.idEmpleado
        ",
            "pr.idProyecto,pr.nombreProyecto",
            "me.idEmpleado=$IdEmpleado",
            "",
            "",
            "",
            ""
        );
        $resultEtapas = [];
        if (count($idProyecto) == 0) {
            return "";
        } else {

            if ($idProyectoDetalle !== null) {

                $result = $this->db->select("proyectos", "*", "idProyecto=$idProyectoDetalle");
                $resultEtapas = $this->db->select("etapas_proyecto", "nombreEtapa,descripcion,idEtapa,completada", "idProyecto=$idProyectoDetalle");
            } else {
                $idConvertido = intval($idProyecto[0]["idProyecto"]);
                $result = $this->db->select("proyectos", "*", "idProyecto=$idConvertido");
                $resultEtapas = $this->db->select("etapas_proyecto", "nombreEtapa,descripcion,idEtapa,completada", "idProyecto=$idConvertido");
            }


            $arrayResultados = [
                'idProyectos' => $idProyecto,
                'proyecto' => $result,
                'etapas' => $resultEtapas
            ];

            $this->db->disconnect();
            return $arrayResultados;
        }
    }

    public function updateEtapa($data)
    {
        session_start();
        $this->db->connect();

        $idEmpleado = $_SESSION['IdEmpleado'];
        //recuperar id Proyecto de la tabla etapas_proyecto
        $idProyecto = $this->db->select(
            "etapas_proyecto",
            "idProyecto",
            "idEtapa=$data->idEtapa"
        );
        //obtener horas del poryecto y restar horas de la etapa a revertir 
        $idConvertido = intval($idProyecto[0]["idProyecto"]);
        $horasRegistradas = $this->db->select(
            "proyectos",
            "horas_registradas",
            "idProyecto=$idConvertido"
        );

        $tiempoRegistrado = explode(':', $horasRegistradas[0]["horas_registradas"]);
        $horasSumar = explode(':', $data->horasEmpleadas);

        $horasRestantes = $tiempoRegistrado[0] + $horasSumar[0];
        $minutosRestantes = $tiempoRegistrado[1] + $horasSumar[1];
        $segundosRestantes = $tiempoRegistrado[2] + $horasSumar[2];

        if ($segundosRestantes < 0) {
            $minutosRestantes--;
            $segundosRestantes += 60;
        }

        if ($minutosRestantes < 0) {
            $horasRestantes--;
            $minutosRestantes += 60;
        }

        $horasRestantes = ($horasRestantes < 10) ? '0' . $horasRestantes : $horasRestantes;
        $minutosRestantes = ($minutosRestantes < 10) ? '0' . $minutosRestantes : $minutosRestantes;
        $segundosRestantes = ($segundosRestantes < 10) ? '0' . $segundosRestantes : $segundosRestantes;

        $nuevaHoraProyecto = $horasRestantes . ":" . $minutosRestantes . ":" . $segundosRestantes;



        $resultSet2 = $this->db->update(
            "proyectos",
            ["horas_registradas" => $nuevaHoraProyecto],
            "idProyecto= $idConvertido"
        );


        $resultSet2 = $this->db->update(
            "etapas_proyecto",
            ["completada" => 1],
            "idEtapa=$data->idEtapa"
        );

        $values = [$idEmpleado, $data->idEtapa, $data->horasEmpleadas];
        $rows = "idEmpleado,idEtapa,horas_etapas";

        if ($data->descripcion != "") {

            array_push($values, $data->descripcion);
            $rows .= ",comentario";
        }

        $result = $this->db->insert("empleados_etapas", $values, $rows);

        $this->db->disconnect();

        return $result;
    }
}
