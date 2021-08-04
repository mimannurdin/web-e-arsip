<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
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
        
        $data['page'] = 'masuk';
        $data['title'] = 'Masuk';

        $this->load->view('templates/head', $data);
        $this->load->view('templates/header');
        $this->load->view('arsip/login');
        $this->load->view('templates/footer');
        $this->load->view('templates/foot');
    }

    public function processLogin()
    {
        if ($this->m_model->checkSession()) {
            redirect(base_url());
        }

        $username = $this->input->post("username");
        $password = sha1($this->input->post("password"));

        // echo "<pre>";
        // echo $username."<br/>";
        // echo $password."<br/>";
        // echo "</pre>";

        if ($username !== null && $password !== null) {
            $where = array(
                'username' => $username,
                'password' => $password
            );
    
            $responses = $this->m_model->getUser($where);
            $numRows = $responses->num_rows();
            if ($numRows > 0) {
                echo "Login success..<br/>Redirecting to homepage...";
                // echo "<pre>";
                // print_r($responses->result_array()[0]);
                
                // echo "</pre>";
                $this->session->set_userdata($responses->result_array()[0]);
                redirect(base_url());
            }
            else {
                echo "Login failed..<br/>Redirecting to login page...";
                redirect(base_url("login?status=-1"));
            }
        }
        else {
            redirect(base_url("login"));
        }
    }
}