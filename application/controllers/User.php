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

    public function addAjax() {
        $result = [];
        $dataPost = $this->input->post();
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        if ($this->form_validation->run() == FALSE) {
            $result['success'] = 0;
            $result['content'] = validation_errors();
        } else {
            try {
                $result['success'] = 1;
                $result['content'] = 'You added '. $dataPost["username"];
                $this->load->model('user/m_user');
                $data = $this->m_user->insertData($dataPost);
            } catch (\Exception $e) {
                $result['success'] = 0;
                $result['content'] = $e->getMessage();
            }
        }
        echo json_encode($result);
    }
}
