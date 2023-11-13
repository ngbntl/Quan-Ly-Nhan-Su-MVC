<?php
include_once("../Model/M_PhongBan.php");

class Ctrl_PhongBan
{
    public function invoke()
    {
        if (isset($_GET['action']) && $_GET['action'] == 'getAllPb') {
            $modelPhongBan = new Model_PhongBan();
            $PhongBan = $modelPhongBan->getAllPhongBan();
            include_once("../View/PhongBanList.html");
        }
    }
}
;
$C_PhongBan = new Ctrl_PhongBan();
$C_PhongBan->invoke();
?>