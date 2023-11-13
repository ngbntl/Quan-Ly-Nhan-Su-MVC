<?php
class Entity_NhanVien
{
    public $idnv;
    public $hoten;
    public $idpb;
    public $diachi;

    public function __construct($_idnv, $_hoten, $_idpb, $_diachi)
    {
        $this->idnv = $_idnv;
        $this->hoten = $_hoten;
        $this->idpb = $_idpb;
        $this->diachi = $_diachi;
    }
}

?>