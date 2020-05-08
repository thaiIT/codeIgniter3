<?php

class Sanpham extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    public function index()
    {
        echo "Day la phuong thuc index";
    }
    public function danhsach()
    {
        //echo "Day la phuong thuc danh sach";
        $this->load->model("sanpham/m_sanpham","msp");
        $dssp = $this->msp->getSanPham();
        echo "<br/>";
        // echo $dssp;
        $data['ds'] = ['1','Mark','Otto','@mdo',$dssp];
        $this->load->view('sanpham/v_sanpham', $data);
    }
    public function them()
    {
        echo "Day la phuong thuc them";
    }
    public function capnhat($id)
    {
        echo "Day la phuong thuc cap nhat " . $id;
    }
    public function xoa($id)
    {
        echo "Day la phuong thuc xoa " . $id;
    }
}
