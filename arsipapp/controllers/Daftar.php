<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        $this->load->model("m_model");
    }

    public function index()
    {
        if ($this->m_model->checkSession()) {
            redirect(base_url());
        }

        $data['page'] = 'daftar';
        $data['title'] = 'Daftar';

        $this->load->view('templates/head', $data);
        $this->load->view('templates/header');
        $this->load->view('arsip/daftar');
        $this->load->view('templates/footer');
        $this->load->view('templates/foot');
    }

    public function processDaftar()
    {
        if ($this->m_model->checkSession()) {
            redirect(base_url());
        }

        $username = $this->input->post("username");
        $password = sha1($this->input->post("password"));
        $nama = $this->input->post("nama");
        $unit = $this->input->post("unit");

        // echo "<pre>";
        // echo $username."<br/>";
        // echo $password."<br/>";
        // echo $nama."<br/>";
        // echo $unit."<br/>";
        // echo "</pre>";

        if ($username !== null && $password !== null && $nama !== null && $unit !== null) {
            $insertData = array(
                'username' => $username,
                'password' => $password,
                'nama' => $nama,
                'unit' => $unit
            );
    
            $affRows = $this->m_model->addUser($insertData);
            if ($affRows > 0) {
                echo "Sign up success"."<br/>";
                echo "Redirecting to Log in page..";
                redirect(base_url("login"));
            }
            else {
                echo "Sign up failed";
                redirect(base_url("daftar?status=-1"));
            }
        }
        else {
            redirect("daftar");
        }
    }
}