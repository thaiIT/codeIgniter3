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

    public function deleteUser($id) {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }

    public function updateUser($dataPost) {
        $id = $dataPost['id'];
        $this->username    = $dataPost['username'];
        $this->fullname    = $dataPost['fullname'];
        $this->dob    =  date('Y-m-d', strtotime($dataPost['dob']));
        $this->db->where('id', $id);
        $this->db->update('users', $this);
    }
}
