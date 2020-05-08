<?php

class M_sanpham extends CI_Model
{
    public function getSanPham()
    {
        return "Day lay mot danh sach";
    }
    public function getSanPhamId($id) 
    {
        return "Day lay san pham ". $id;
    }

}