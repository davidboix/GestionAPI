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
        $this->load->model("UsersDB");
        $user = strtoupper($this->input->post("user"));
        $password = $this->input->post("password");
        $arr = $this->UsersDB->isUserExists($user,$password);
        print_r($arr);
        if (!$arr) {
            $msg = "Usuari No Existent";
            echo $msg;
            $this->loginErronio($msg);
            //Deberiamos cargar una ventana emergente que avisase que el usuario no existe y que se redirigiese a la pagina de registro 
            return;
        }

        echo "hem fet login";
    }

    public function registro()
    {
        echo "<h1>WORKING ON IT</h1>";
        $this->load->view("header");
        $this->load->view("registro");
        $this->load->view("footer");
    }

    public function setRegistro () {
        $this->load->model("UsersDB");
        $user = strtoupper($this->input->post("user"));
        $password = $this->input->post("password");
        $this->UsersDB->setUsuario($user,$password);
    }

    public function getDades()
    {
        $this->load->model("UsersDB");
        $arr = $this->UsersDB->getUsers();
        if (!isset($arr)) {
            foreach ($arr as $row) {
                echo $row . "<br>";
            }
        }
        echo "no hi han dades";

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