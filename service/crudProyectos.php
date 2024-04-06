<?php
require_once "Database.php";

class crudProyectosService
{

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }
    public function getListadoCrudProyectos()
    {

        $this->db->connect();

        // selectInner($innerJoin, $rows, $where, $group, $having, $order, $limit) 
        $resultSet = $this->db->select(
            "proyectos",
            "idProyecto,nombreProyecto,fechaFinalizacion,horas_registradas,horas_total,Cliente,prioridad
        "
        );
        $this->db->disconnect();
        //obtención del array del objeto CiudadListad
        return $resultSet;
    }

    public function getCrudProyecto($idProyecto = null)
    {

        $this->db->connect();
        $idConvertido = intval($idProyecto);
        // selectInner($innerJoin, $rows, $where, $group, $having, $order, $limit) 
        if ($idProyecto != null) {
            $resultSet = $this->db->select(
                "proyectos",
                "*",
                "idProyecto=$idConvertido"
            );
            $idEquipos = $this->db->select(
                "equipos",
                "idEquipo",
                "",
                "idEquipo ASC"
            );
            $idEquiposAsignados = $this->db->select(
                "equipos_proyectos",
                "idEquipo",
                "idProyecto=$idConvertido"
            );

            $arrayProyectos = array(
                "proyecto" => $resultSet[0],
                "idEquipos" => $idEquipos,
                "idEquiposAsignados" => $idEquiposAsignados
            );

            return $arrayProyectos;
        } else {
            $resultSet = $this->db->select("proyectos", "nombreProyecto,idProyecto");
            return $resultSet;
        }
        $this->db->disconnect();
        //obtención del array del objeto CiudadListado



    }

    public function setProyecto($data)
    {

        $this->db->connect();
        $idConvertido = intval($data->idProyecto);

        $values = [];
        if ($data->nombreProyecto != "") {
            $values += ["nombreProyecto" => $data->nombreProyecto];
        }
        if ($data->descripcion != "") {
            $values += ["descripcion" => $data->descripcion];
        }
        if ($data->fechaInicio != "") {
            $values += ["fechaInicio" => $data->fechaInicio];
        }
        if ($data->fechaFinalizacion != "") {
            $values += ["fechaFinalizacion" => $data->fechaFinalizacion];
        }
        if ($data->horasRegistradas != "") {
            $values += ["horas_registradas" => $data->horasRegistradas];
        }

        if ($data->horasTotal != "") {
            $values += ["horas_total" => $data->horasTotal];
        }
        if ($data->cliente != "") {
            $values += ["Cliente" => $data->cliente];
        }
        if ($data->prioridad != "") {
            $values += ["prioridad" => $data->prioridad];
        }

        $resultSet = $this->db->update(
            "proyectos",
            $values,
            "idProyecto=$idConvertido"
        );



        if (count($data->arrayIdEquipo) > 0) {
            $this->db->delete("equipos_proyectos", true, "idProyecto=$idConvertido");
            foreach ($data->arrayIdEquipo as $id) {
                $resultSetId = $this->db->insert("equipos_proyectos", [$id, $idConvertido], "idEquipo,idProyecto");
            }
        }
        //update("marcado_diario", ["jornadaFinalizada" => 1, "horas_jornada" => $horaBien, "horaSalida" => $horaActual],

        $this->db->disconnect();
        //obtención del array del objeto CiudadListado


    }
    public function deleteProyecto($idProyecto)
    {

        $this->db->connect();
        $idConvertido = intval($idProyecto);
        $resultSet = $this->db->delete("proyectos", true, "idProyecto=$idConvertido");
        $this->db->disconnect();
        return $resultSet;
    }
    public function createProyecto($data)
    {
        $this->db->connect();

        $values = [$data->nombreInput, $data->clienteInput];
        $rows = "nombreProyecto,Cliente";
        if ($data->descripcionInput != "") {
            array_push($values, $data->descripcionInput);
            $rows .= ",descripcion";
        }
        if ($data->fechaInicioInput != "") {

            array_push($values, $data->fechaInicioInput);
            $rows .= ",fechaInicio";
        }

        if ($data->fechaFinInput != "") {

            array_push($values, $data->fechaFinInput);
            $rows .= ",fechaFinalizacion";
        }

        if ($data->prioridadInput != "") {

            array_push($values, $data->prioridadInput);
            $rows .= ",prioridad";
        }
        $resultSet = $this->db->insertIdentity("proyectos", $values, $rows);
        foreach ($data->arrayIdEquipo as $id) {
            $resultSetId = $this->db->insert("equipos_proyectos", [$id, $resultSet], "idEquipo,idProyecto");
        }

        $this->db->disconnect();
        return $resultSet;
    }
    public function getEquipos()
    {
        $this->db->connect();
        $resultSet = $this->db->select("equipos", "idEquipo", "", "idEquipo ASC");
        $this->db->disconnect();
        // Comprobar si se encontraron resultados

        // Cerrar la conexión a la base de datos
        return  $resultSet;
    }
}
