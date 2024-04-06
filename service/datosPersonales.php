<?php
require_once 'Database.php';

class datosPersonalesService
{

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    public function getDatosEmpleado()
    {
        $this->db->connect();
        $idEmpleado = $_SESSION['IdEmpleado'];

        $resultSet = $this->db->selectInner(
            "empleados e INNER JOIN categoriaempleado c on c.idCategoria=e.idCategoria",
            "e.idEmpleado,e.nombre,e.direccion,e.pais,e.ciudad,e.telDomicilio,e.usuario,e.email,c.nombreCategoria",
            "e.idEmpleado=$idEmpleado",
            "",
            "",
            "",
            "",
        );

        $this->db->disconnect();

        return $resultSet[0];
    }
}
