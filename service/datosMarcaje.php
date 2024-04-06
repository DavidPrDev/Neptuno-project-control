<?php

require __DIR__ . '/../model/datosMarcajeModel.php';
require_once "Database.php";

class datosMarcajeService
{

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }
    public function getDatos($IdEmpleado): DatosMarcaje
    {

        $this->db->connect();
        $result = $this->db->select(
            "empleados",
            "nombre,email",
            "idEmpleado=$IdEmpleado",
        );
        $fechaActual = date("Y-m-d");
        $result2 = $this->db->select(
            "marcado_diario",
            "horaEntrada,horaSalida,horaPausa,horaFinPausa
        ",
            "idEmpleado=$IdEmpleado AND fecha='$fechaActual'",
        );

        if ($result2 != false) {
            if ($result2[0]["horaEntrada"] != NULL) {
                $btnEntrada = "boton-oculto";
                $btnPausa = "";
                $btnReanudar = "boton-oculto";
                $btnFin = "boton-oculto";
            }
            if ($result2[0]["horaPausa"] != NULL) {
                $btnEntrada = "boton-oculto";
                $btnPausa = "boton-oculto";
                $btnReanudar = "";
                $btnFin = "boton-oculto";
            }
            if ($result2[0]["horaFinPausa"] != NULL) {
                $btnEntrada = "boton-oculto";
                $btnPausa = "boton-oculto";
                $btnReanudar = "boton-oculto";
                $btnFin = "";
            }
            if ($result2[0]["horaSalida"] != NULL) {
                $btnEntrada = "boton-oculto";
                $btnPausa = "boton-oculto";
                $btnReanudar = "boton-oculto";
                $btnFin = "boton-oculto";
            }
            if (
                $result2[0]["horaSalida"] == NULL && $result2[0]["horaFinPausa"] == NULL &&
                $result2[0]["horaPausa"] == NULL && $result2[0]["horaEntrada"] == NULL
            ) {
                $btnEntrada = "";
                $btnPausa = "boton-oculto";
                $btnReanudar = "boton-oculto";
                $btnFin = "boton-oculto";
            }
        } else {
            $btnEntrada = "";
            $btnPausa = "boton-oculto";
            $btnReanudar = "boton-oculto";
            $btnFin = "boton-oculto";
        }

        $obj = new DatosMarcaje(
            $result[0]["nombre"],
            $result[0]["email"],
            $btnEntrada,
            $btnPausa,
            $btnReanudar,
            $btnFin
        );
        $this->db->disconnect();
        return $obj;
    }

    public function createMarcaje($idEmpleado,  $comentario)
    {
        session_start();


        $this->db->connect();
        $horaActual = date("H:i:s");
        $fechaActual = date("Y-m-d");
        $idConvertido = intval($idEmpleado);
        $values = [$idConvertido, 0, $horaActual];
        $rows = "idEmpleado,jornadaFinalizada,horaEntrada";

        if ($comentario != "") {

            array_push($values, $comentario);
            $rows .= ",comentario";
        }



        $result1 = $this->db->insert("marcado_diario",  $values, $rows);


        $this->db->disconnect();
        return $result1;
    }
    public function updateMarcaje($idEmpleado)
    {

        $this->db->connect();


        $fechaActual = date("Y-m-d");
        $result1 = $this->db->selectInner("marcado_diario m 
        INNER JOIN empleados e ON e.idEmpleado=m.idEmpleado", "m.idMarcaje,m.horaFinPausa,m.horas_jornada", "e.idEmpleado=$idEmpleado AND m.jornadaFinalizada=0 AND m.fecha='$fechaActual'", "", "", "", "");
        $idConvertido = intval($result1[0]["idMarcaje"]);
        $hora = $result1[0]["horaFinPausa"];
        $horaTotal = diferenciaHoras($hora);

        $horaTSplit = explode(':', $horaTotal);
        $horasSumSplit = explode(':', $result1[0]["horas_jornada"]);

        $horasSum = intval($horaTSplit[0]) + intval($horasSumSplit[0]);
        $minutosSum = intval($horaTSplit[1]) + intval($horasSumSplit[1]);
        $segundosSum = intval($horaTSplit[2]) + intval($horasSumSplit[2]);

        $horaBien = "$horasSum:$minutosSum:$segundosSum";
        $horaActual = date("H:i:s");
        $result = $this->db->update("marcado_diario", ["jornadaFinalizada" => 1, "horas_jornada" => $horaBien, "horaSalida" => $horaActual], "idMarcaje=$idConvertido ");

        $this->db->disconnect();
        return $result;
    }

    public function pausarMarcaje($idEmpleado)
    {

        $this->db->connect();

        $fechaActual = date("Y-m-d");
        $result1 = $this->db->selectInner("marcado_diario m 
        INNER JOIN empleados e ON e.idEmpleado=m.idEmpleado", "m.idMarcaje,m.horaEntrada", "e.idEmpleado=$idEmpleado AND m.jornadaFinalizada=0 AND m.fecha='$fechaActual'", "", "", "", "");
        $idConvertido = intval($result1[0]["idMarcaje"]);
        $hora = $result1[0]["horaEntrada"];
        $horaTotal = diferenciaHoras($hora);
        $horaActual = date("H:i:s");

        $result = $this->db->update(
            "marcado_diario",
            ["horas_jornada" => $horaTotal, "horaPausa" => $horaActual],
            "idMarcaje=$idConvertido "
        );

        $this->db->disconnect();
        return $result;
    }

    public function reanudarMarcaje($idEmpleado)
    {

        $this->db->connect();


        $fechaActual = date("Y-m-d");
        $result1 = $this->db->selectInner("marcado_diario m 
        INNER JOIN empleados e ON e.idEmpleado=m.idEmpleado", "m.idMarcaje", "e.idEmpleado=$idEmpleado AND m.jornadaFinalizada=0 AND m.fecha='$fechaActual'", "", "", "", "");
        $idConvertido = intval($result1[0]["idMarcaje"]);

        $horaActual = date("H:i:s");

        $result = $this->db->update(
            "marcado_diario",
            ["horaFinPausa" => $horaActual],
            "idMarcaje=$idConvertido "
        );

        $this->db->disconnect();
        return $result;
    }
}
function diferenciaHoras($data)
{
    $componentes = explode(':', $data);

    $horasBd = intval($componentes[0]);
    $minutosBd = intval($componentes[1]);
    $segundosBd = intval($componentes[2]);

    $horaActual =  explode(':', date("H:i:s"));
    $hora = intval($horaActual[0]);
    $minutos = intval($horaActual[1]);
    $segundos = intval($horaActual[2]);

    $horaDiferencia =  $hora - $horasBd;
    $minutosDiferencia = $minutos - $minutosBd;
    $segundosDiferencia =  $segundos - $segundosBd;
    if ($segundosDiferencia < 0) {
        $segundosDiferencia += 60;
        $minutosDiferencia--;
    }

    if ($minutosDiferencia < 0) {
        $minutosDiferencia += 60;
        $horaDiferencia--;
    }

    $horaTotal = "$horaDiferencia:$minutosDiferencia:$segundosDiferencia";
    return $horaTotal;
}
