<?php

require_once 'Database.php';


class homeAdministracionService
{

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    public function getListadoCrudEmpleados()
    {
        $this->db->connect();


        $resultSet = $this->db->select(
            "empleados",
            "idEmpleado,nombre,direccion,pais,telDomicilio,usuario,email,idCategoria
        "
        );
        $this->db->disconnect();


        return $resultSet;
    }
    public function getCrudEmpleado($idEmpleado)
    {

        $this->db->connect();
        $idConvertido = intval($idEmpleado);

        $resultSet = $this->db->select(
            "empleados",
            "idEmpleado,nombre,direccion,ciudad,pais,telDomicilio,usuario,email,idCategoria",
            "idEmpleado=$idConvertido"
        );
        $this->db->disconnect();

        return $resultSet[0];
    }
    public function setEmpleado($data)
    {

        $this->db->connect();
        $idConvertido = intval($data->idEmpleado);

        $values = [];

        if ($data->nombre != "") {
            $values += ["nombre" => $data->nombre];
        }
        if ($data->direccion != "") {
            $values += ["direccion" => $data->direccion];
        }
        if ($data->ciudad != "") {
            $values += ["ciudad" => $data->ciudad];
        }
        if ($data->pais != "") {
            $values += ["pais" => $data->pais];
        }

        if ($data->telefono != "") {
            $values += ["telDomicilio" => $data->telefono];
        }
        if ($data->usuario != "") {
            $values += ["usuario" => $data->usuario];
        }
        if ($data->contrasenna != "") {
            $values += ["contrasenna" => $data->contrasenna];
        }
        if ($data->email != "") {
            $values += ["email" => $data->email];
        }
        if ($data->idCategoria != "") {
            $values += ["idCategoria" => $data->idCategoria];
        }


        $resultSet = $this->db->update(
            "empleados",
            $values,
            "idEmpleado=$idConvertido"
        );
        $this->db->disconnect();

        return var_dump($data);
    }
    public function deleteEmpleado($idEmpleado)
    {

        $this->db->connect();
        $idConvertido = intval($idEmpleado);
        $resultSet = $this->db->delete("empleados", true, "idEmpleado=$idConvertido");
        $this->db->disconnect();
        return $resultSet;
    }
    public function createEmpleado($data)
    {
        $this->db->connect();

        $values = [
            $data->nombreInput, $data->direccionInput,
            $data->ciudadInput, $data->paisInput,
            $data->telefonoInput, $data->usuarioInput,
            $data->contrasenna
        ];
        $rows = "nombre,direccion,ciudad,pais,telDomicilio,usuario,contrasenna";
        if ($data->emailInput != "") {

            array_push($values, $data->emailInput);
            $rows .= ",email";
        }
        if ($data->idCategoriaInput != "") {

            array_push($values, $data->idCategoriaInput);
            $rows .= ",idCategoria";
        }

        $resultSet = $this->db->insert("empleados", $values, $rows);
        $this->db->disconnect();
        return $resultSet;
    }

    public function getListadoCrudMarcajes()
    {
        $this->db->connect();

        $resultSet = $this->db->selectInner(
            "marcado_diario m
            inner join empleados e on e.idEmpleado=m.idEmpleado",
            "m.idMarcaje,e.nombre,m.horaEntrada,m.horaSalida,m.fecha,m.jornadaFinalizada",
            "",
            "",
            "",
            "",
            ""
        );
        $this->db->disconnect();

        return $resultSet;
    }
    public function getCrudMarcaje($idMarcaje)
    {

        $this->db->connect();
        $idConvertido = intval($idMarcaje);
        $resultSet = $this->db->selectInner(
            "marcado_diario m
            inner join empleados e on e.idEmpleado=m.idEmpleado",
            "m.idMarcaje,e.nombre,m.horaEntrada,m.horaSalida,m.fecha,m.comentario,m.horas_jornada,m.horaPausa,m.horaFinPausa,m.jornadaFinalizada",
            "idMarcaje=$idConvertido",
            "",
            "",
            "",
            ""
        );
        $this->db->disconnect();

        return $resultSet[0];
    }
    public function setMarcaje($data)
    {

        $this->db->connect();
        $idConvertido = intval($data->idMarcaje);

        $values = [];

        if ($data->horaEntrada != "") {
            $values += ["horaEntrada" => $data->horaEntrada];
        }
        if ($data->horaSalida != "") {
            $values += ["horaSalida" => $data->horaSalida];
        }
        if ($data->comentario != "") {
            $values += ["comentario" => $data->comentario];
        }
        if ($data->horasJornada != "") {
            $values += ["horas_jornada" => $data->horasJornada];
        }

        if ($data->jornadaFinalizada != "") {
            $values += ["jornadaFinalizada" => $data->jornadaFinalizada];
        }
        if ($data->horaPausa != "") {
            $values += ["horaPausa" => $data->horaPausa];
        }
        if ($data->horaFinPausa != "") {
            $values += ["horaFinPausa" => $data->horaFinPausa];
        }


        $resultSet = $this->db->update(
            "marcado_diario",
            $values,
            "idMarcaje=$idConvertido"
        );
        $this->db->disconnect();

        return $resultSet;
    }

    public function deleteMarcaje($idMarcaje)
    {

        $this->db->connect();
        $idConvertido = intval($idMarcaje);
        $resultSet = $this->db->delete("marcado_diario", true, "idMarcaje=$idConvertido");
        $this->db->disconnect();
        return $resultSet;
    }

    public function getCategoria()
    {
        $this->db->connect();

        $resultSet = $this->db->select("categoriaempleado", "idCategoria,nombreCategoria");
        $this->db->disconnect();

        return  $resultSet;
    }
}
