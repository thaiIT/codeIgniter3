<?php

class M_user extends CI_Model
{
    public $username;
    public $fullname;
    public $dob;

    public function getUser() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function insertData($dataPost)
    {
        $this->username    = $dataPost['username'];
        $this->fullname    = $dataPost['fullname'];
        $this->dob    =  date('Y-m-d', strtotime($dataPost['dob']));
        $this->db->insert('users', $this);
    }
}
