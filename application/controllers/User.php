<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    public function index()
    { 
        $this->load->model('user/m_user');
        $dataUser = $this->m_user->getUser();
        $data = [
            'title' => 'List Users',
            'heading' => 'List Users',
            'dataUser' => $dataUser
        ];
        $this->load->view('user/index', $data);
    }

    public function add()
    {
        $dataPost = $this->session->flashdata('dataPost');
        $data = [
            'title' => 'Add Users',
            'heading' => 'Add Users',
            'username' => $dataPost['username'],
            'fullname' => $dataPost['fullname'],
            'dob' => $dataPost['dob'],
        ];
        $this->load->view('user/add', $data);
    }

    public function post()
    {
        $dataPost = [
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'dob' => $this->input->post('dob')
        ];
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_userdata('validation_errors', validation_errors());
            $this->session->set_flashdata('dataPost',$dataPost);
            redirect('user/add');
        } else {
            $this->load->model('user/m_user');
            $data = $this->m_user->insertData();
            redirect('user');
        }
    }
}
