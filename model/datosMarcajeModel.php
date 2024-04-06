<?php
class DatosMarcaje
{
    //esta parte ira para recojer datos de la home 
    private string $nombre;
    private string $email;
    private string $btnEntrada;
    private string $btnPausar;
    private string $btnReanudar;
    private string $btnFin;




    public function __construct(string $nombre, string $email,   string $btnEntrada, string $btnPausar, string $btnReanudar, string $btnFin)
    {
        //constructor
        $this->nombre = $nombre;
        $this->email = $email;
        $this->btnEntrada = $btnEntrada;
        $this->btnPausar = $btnPausar;
        $this->btnReanudar = $btnReanudar;
        $this->btnFin = $btnFin;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getEmail()
    {
        return $this->email;
    }


    public function getBtnEntrada()
    {
        return $this->btnEntrada;
    }
    public function getBtnPausar()
    {
        return $this->btnPausar;
    }
    public function getBtnReanudar()
    {
        return $this->btnReanudar;
    }
    public function getBtnFin()
    {
        return $this->btnFin;
    }
}