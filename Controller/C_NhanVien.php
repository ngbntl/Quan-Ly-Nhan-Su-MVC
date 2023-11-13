<?php
include_once("../Model/M_NhanVien.php");

class Ctrl_NhanVien
{
    public function invoke()
    {
        if (isset($_GET['action']) && $_GET['action'] == 'getAllNv') {
            $modelNhanVien = new Model_NhanVien();
            $nhanViens = $modelNhanVien->getAllNhanVien();
            include_once("../View/NhanVienList.html");

        } else if (isset($_GET['action']) && $_GET['action'] == 'search') {
            include_once("../View/SearchNhanVien.html");

        } else if (isset($_POST['searchNhanVien'])) {
            $key = $_POST['key'];
            $searchBy = $_POST['searchBy'];
            $modelNhanVien = new Model_NhanVien();
            $nhanViens = $modelNhanVien->searchNhanVien($key, $searchBy);
            include_once("../View/NhanVienList.html");

        } else {
            include_once("../View/HomePage.html");
        }
    }
}
;
$C_NhanVien = new Ctrl_NhanVien();
$C_NhanVien->invoke();
?>