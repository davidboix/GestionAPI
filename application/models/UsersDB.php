<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersDB extends CI_Model
{
    public function __construct()
    {
        //$this->load->database("users");
    }

    public function setUser()
    {

        $this->db->close();
    }

    public function getUsers()
    {
        $this->load->database("gestionapi");
        $this->db->select("*");
        $this->db->from("users");
        $query = $this->db->get();
        $result = $query->result();
        $data = [];

        if ($query->num_rows() > 0) {
            foreach ($result as $row) {
                //D'aquesta manera estem passan al array TOT el objecte 
                //$data["nomActor"] = $result;
                //Necessitem passar unicament al array, el valor del objecte que estem buscant.
                //$data["nomActor"] = $row->Nom_Actor;
                array_push($data, $row->Usuario);
            }
            $this->db->close();
            return $data;
        }
        $this->db->close();
        return FALSE;
    }

    public function isUserExists($nom,$password)
    {
        $this->load->database("gestionapi");
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("Usuario", $nom);
        $this->db->where("Contraseña",$password);
        $query = $this->db->get();
        $result = $query->result();
        $data = [];
        if ($query->num_rows() > 0) {
            foreach ($result as $row) {
                array_push($data, $row->Usuario);
            }
            $this->db->close();
            return $data;
        }
        $this->db->close();
        return FALSE;
    }

    public function setUsuario ($user,$password) {
        $this->load->database("gestionapi");
        $this->db->set("Usuario ",$user);
        $this->db->set("Contraseña",$password);
        $insert = $this->db->insert("users");
        return $insert;
    }
}
