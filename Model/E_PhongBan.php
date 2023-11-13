<?php
class Entity_PhongBan
{
    public $idpb;
    public $tenphongban;
    public $mota;

    function __construct($_idpb, $_tenphongban, $_mota)
    {
        $this->idpb = $_idpb;
        $this->tenphongban = $_tenphongban;
        $this->mota = $_mota;
    }


}
?>