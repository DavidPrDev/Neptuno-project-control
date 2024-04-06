<?php

require_once 'Database.php';

class homeJefeService
{

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    public function getListadoEquipos()
    {


        $this->db->connect();
        //SELECT idEmpleado from empleados WHERE idCategoria=3
        $resultSet = $this->db->selectInner(
            "equipos e
            LEFT JOIN empleados j ON e.idJefe = j.idEmpleado
            LEFT JOIN equipos_proyectos ep ON ep.idEquipo = e.idEquipo
            LEFT JOIN proyectos pr ON pr.idProyecto=ep.idProyecto",
            "e.idEquipo,ep.idEquiposProyecto,
            pr.nombreProyecto,
            j.nombre AS nombreJefe
          ",
            "",
            "",
            "",
            "",
            ""
        );

        $this->db->disconnect();

        return  $resultSet;
    }

    public function getCrudEquipo($idEquipoA, $idEquipo)
    {

        $this->db->connect();

        if ($idEquipoA != 0) {
            $resultSet = $this->db->selectInner(
                "equipos e
            LEFT JOIN empleados j ON e.idJefe = j.idEmpleado
            LEFT JOIN equipos_proyectos ep ON ep.idEquipo = e.idEquipo
            LEFT JOIN proyectos pr ON pr.idProyecto=ep.idProyecto",
                "e.idEquipo,pr.nombreProyecto,j.nombre AS nombreJefe",
                "ep.idEquiposProyecto=$idEquipoA",
                "",
                "",
                "",
                ""
            );
            return  $resultSet[0];
        } else {

            $resultSet = $this->db->selectInner(
                "equipos e
                    LEFT JOIN empleados j ON e.idJefe = j.idEmpleado
                    LEFT JOIN equipos_proyectos ep ON ep.idEquipo = e.idEquipo
                    LEFT JOIN proyectos pr ON pr.idProyecto=ep.idProyecto",
                "e.idEquipo,
                pr.nombreProyecto,
                j.nombre AS nombreJefe",
                "e.idEquipo=$idEquipo",
                "",
                "",
                "",
                ""
            );
            return  $resultSet[0];
        }
        $this->db->disconnect();
    }
    public function getEmpleadosEquipo($idEquipoA = null)
    {

        if ($idEquipoA != null) {
            $this->db->connect();

            $empleadosTotales = $this->db->select("empleados", "idEmpleado,nombre");
            $empleadosAsignados = $this->db->selectInner(
                "miembros_equipos m INNER JOIN empleados e 
                ON e.idEmpleado=m.idEmpleado",
                "e.idEmpleado,e.nombre",
                "m.idEquipo=$idEquipoA",
                "",
                "",
                "",
                ""
            );
            $this->db->disconnect();
            $arrayEmpleados = array(
                "empleadosTotales" =>  $empleadosTotales,
                "empleadosAsignados" => $empleadosAsignados
            );
            return $arrayEmpleados;
        } else {
            $this->db->connect();

            $empleadosTotales = $this->db->select("empleados", "idEmpleado,nombre");

            $this->db->disconnect();
            return $empleadosTotales;
        }
    }
    public function getEtapaCompleta($idEtapa)
    {

        $this->db->connect();
        $etapaCompletada = $this->db->selectInner(
            "empleados_etapas em
            INNER JOIN etapas_proyecto epr ON epr.idEtapa=em.idEtapa
            INNER JOIN proyectos pr ON pr.idProyecto=epr.idProyecto
            INNER JOIN empleados e ON e.idEmpleado=em.idEmpleado",
            "em.idEmpleadoEtapa,epr.idEtapa,pr.idProyecto,epr.nombreEtapa, pr.nombreProyecto,e.nombre,em.fecha,em.comentario,em.horas_etapas",
            "em.idEtapa=$idEtapa",
            "",
            "",
            "",
            ""
        );
        $this->db->disconnect();
        return $etapaCompletada[0];
    }


    public function getEmpleadosEquipoAsign($idEquipo)
    {
        $this->db->connect();
        $idEmpleadosAsign = $this->db->select("miembros_equipos", "idEmpleado", "idEquipo=$idEquipo");
        if (count($idEmpleadosAsign) > 0) {
            $indexado = array();

            foreach ($idEmpleadosAsign as $item) {
                $indexado[] = array_values($item);
            }

            $strings = array();

            foreach ($indexado as $subarray) {
                $strings[] = implode(",", $subarray);
            }


            $values = implode(",", $strings);


            $resultSet = $this->db->selectInner(" miembros_equipos m 
            RIGHT JOIN empleados e on e.idEmpleado=m.idEmpleado", "DISTINCT e.nombre,e.idEmpleado", "e.idEmpleado NOT IN ($values)", "", "", "", "");
        } else {
            $resultSet = $this->db->select("empleados", "nombre,idEmpleado", "", "");
        }


        return $resultSet;
    }
    public function setEquipo($dataEquipo)
    {

        $this->db->connect();
        $idConvertido = intval($dataEquipo->idEquipo);

        $values = [];

        $idEquipoProyecto = $this->db->select(
            "equipos_proyectos",
            "idEquiposProyecto",
            "idEquipo=$dataEquipo->idEquipo"
        );
        if (count($idEquipoProyecto) > 0) {
            $resultSet2 = $this->db->update(
                "equipos_proyectos",
                ["idProyecto" => $dataEquipo->nombreProyecto],
                "idEquipo=$dataEquipo->idEquipo"
            );
        } else {
            $resultSet2 = $this->db->insert(
                "equipos_proyectos",
                [$dataEquipo->nombreProyecto, $dataEquipo->idEquipo],
                "idProyecto,idEquipo"
            );
        }

        if ($dataEquipo->jefeEquipo != "") {
            $values += ["idJefe" => $dataEquipo->jefeEquipo];
        }



        $resultSet = $this->db->update(
            "equipos",
            $values,
            "idEquipo=$idConvertido"
        );
        $this->db->disconnect();
    }
    public function getJefe()
    {
        $this->db->connect();
        $resultSet = $this->db->select("empleados", "idEmpleado,nombre", "idCategoria=3");
        $this->db->disconnect();
        return  $resultSet;
    }
    public function updateEmpleadoEquipo($idEmpleado, $idEquipo)
    {
        $this->db->connect();
        $resultSet = $this->db->insert("miembros_equipos", [$idEmpleado, $idEquipo], "idEmpleado,idEquipo");
        $this->db->disconnect();

        return  $resultSet;
    }
    public function deleteEquipo($idEquipo)
    {

        $this->db->connect();

        $resultSet = $this->db->delete("equipos_proyectos", true, "idEquipo=$idEquipo");
        $resultSet = $this->db->delete("miembros_equipos", true, "idEquipo=$idEquipo");
        $resultSet = $this->db->delete("equipos", true, "idEquipo=$idEquipo");
        $this->db->disconnect();
        return $resultSet;
    }
    public function deleteEmpleadoEquipo($idEmpleado, $idEquipo)
    {

        $this->db->connect();
        $resultSet = $this->db->delete("miembros_equipos", true, "idEmpleado=$idEmpleado AND idEquipo=$idEquipo");
        $this->db->disconnect();
        return $resultSet;
    }
    public function crearEquipo($dataEquipo)
    {
        $this->db->connect();
        $values = array();
        $rows = "idJefe";

        if ($dataEquipo->jefeEquipo !== "") {
            array_push($values, $dataEquipo->jefeEquipo);
        }

        $idEquipo = $this->db->insertIdentity("equipos", $values, $rows);


        $idProyecto = $this->db->select(
            "proyectos",
            "idProyecto",
            "nombreProyecto='$dataEquipo->nombreProyecto'"
        );



        $result = $this->db->insert(
            "equipos_proyectos",
            [intval($idProyecto[0]["idProyecto"]), $idEquipo],
            "idProyecto,idEquipo"
        );

        foreach ($dataEquipo->arrayEmpleados as $id) {
            $resultSetId = $this->db->insert("miembros_equipos", [$idEquipo, $id], "idEquipo,idEmpleado");
        }
        $this->db->disconnect();
        return $result;
    }

    public function revertirEtapa($dataEtapa)
    {
        $this->db->connect();


        $horasRegistradas = $this->db->select(
            "proyectos",
            "horas_registradas",
            "idProyecto=$dataEtapa->idProyecto"
        );
        $tiempoRegistrado = explode(':', $horasRegistradas[0]["horas_registradas"]);
        $tiempoARestar = explode(':', $dataEtapa->horasProyecto);

        $horasRestantes = $tiempoRegistrado[0] - $tiempoARestar[0];
        $minutosRestantes = $tiempoRegistrado[1] - $tiempoARestar[1];
        $segundosRestantes = $tiempoRegistrado[2] - $tiempoARestar[2];

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
            "idProyecto=$dataEtapa->idProyecto"
        );


        $resultSet = $this->db->delete("empleados_etapas", true, "idEmpleadoEtapa=$dataEtapa->idEmpleado");


        $resultSet2 = $this->db->update(
            "etapas_proyecto",
            ["completada" => 0],
            "idEtapa=$dataEtapa->idEtapa"
        );
        $this->db->disconnect();

        return $resultSet2;
    }

    public function getListadoEtapas()
    {
        $this->db->connect();

        $resultSet = $this->db->selectInner(
            "etapas_proyecto ep 
        INNER JOIN proyectos pr ON pr.idProyecto=ep.idProyecto",
            "ep.idEtapa,ep.nombreEtapa,pr.nombreProyecto,ep.completada",
            "",
            "",
            "",
            "",
            ""
        );
        $this->db->disconnect();
        return  $resultSet;
    }
    public function deleteEtapa($idEtapa)
    {
        $this->db->connect();

        $resultSet = $this->db->delete("empleados_etapas", true, "idEtapa=$idEtapa");
        $resultSet2 = $this->db->delete("etapas_proyecto", true, "idEtapa=$idEtapa");

        $this->db->disconnect();

        return $resultSet2;
    }
    public function createEtapa($data)
    {

        $this->db->connect();
        $idConvertido = intval($data->nombreProyectoCrear);

        $values = array($data->nombreEtapaCrear, $data->descripcionEtapa, $idConvertido, 0);


        $result = $this->db->insert("etapas_proyecto", $values, "nombreEtapa,descripcion,idProyecto,completada");


        $this->db->disconnect();
        return $result;
    }
}
