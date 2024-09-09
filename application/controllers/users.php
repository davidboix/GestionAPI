<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("form");
        // Si tenemos que utilizar librerias o helper lo pondremos aqui...
    }

    public function index()
    {
        //Averiguar que podemos poner en el index...
        // Ponemos el login???
    }

    public function login()
    {
        $this->load->model("Consulta");
        $user = strtoupper($this->input->post("user"));
        $password = $this->input->post("password");
        $arr = $this->Consulta->isUserExists($user);
        if (!$arr) {
            $msg = "Usuari No Existent";
            $this->loginErronio($msg);
        }

    }

    public function registro()
    {
        echo "<h1>WORKING ON IT</h1>";
    }

    public function getDades()
    {
        $this->load->model("Consulta");
        $arr = $this->Consulta->getUsers();
        foreach ($arr as $row) {
            echo $row . "<br>";
        }
        //D'aquesta manera estem accedint al array de objectes i printem tot el objecte
        // foreach ($data["nomActor"] as $row) {
        //     echo $row->Nom_Actor . "<br>";
        // }
    }

    private function loginErronio($data)
    {
        $this->load->view("header");
        $this->load->view("login", $data);
    }
}