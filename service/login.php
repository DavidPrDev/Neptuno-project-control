<?php

require_once 'interfaces/ILogin.php';

require_once 'Database.php';

class LoginService implements ILogin
{

    private $table = '';

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    public function getLogin($usuario, $contrasena)
    {

        $this->db->connect();

        $result = $this->db->select("empleados", "IdEmpleado ,usuario,idCategoria", "usuario='$usuario' AND contrasenna='$contrasena'");


        if (count($result) > 0) {

            session_start();
            $_SESSION['IdEmpleado'] = $result[0]["IdEmpleado"];
            $_SESSION['usuario'] = $result[0]["usuario"];
            $_SESSION['categoria'] = $result[0]["idCategoria"];
            $idEmpleado = $result[0]["IdEmpleado"];

            $this->db->disconnect();
            echo $result[0]["idCategoria"];
        } else {
            echo "KO";
        }
    }
}
