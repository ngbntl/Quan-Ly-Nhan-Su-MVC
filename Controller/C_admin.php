<?php
include_once("../Model/M_Admin.php");
include_once("../Model/M_NhanVien.php");
include_once("../Model/M_PhongBan.php");
class Ctrl_Admin
{

    public function invoke()
    {
        if (isset($_GET['action']) && $_GET['action'] === 'login') {
            include_once("../View/Login.html");
        } else if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $modelAdmin = new Model_Admin();
            $result = $modelAdmin->Login($username, $password);

            if ($result) {
                session_start();
                $_SESSION["admin"] = $username;
                include_once("../View/AdminPage.html");
            }
        } else if (isset($_GET['action']) && $_GET['action'] === 'logout') {
            session_start();
            unset($_SESSION["admin"]);
            session_destroy();
            include_once("../View/HomePage.html");
        } else if (isset($_GET['action']) && $_GET['action'] == 'quanly') {
            $modelNhanVien = new Model_NhanVien();
            $nhanViens = $modelNhanVien->getAllNhanVien();

            include_once("../View/QuanLyNhanVien.html");
        } else if (isset($_GET['action']) && $_GET['action'] == 'add') {
            include_once('../View/AddNhanVien.html');
        } else if (isset($_POST['addNewNv'])) {
            $idnv = $_POST['idnv'];
            $name = $_POST["name"];
            $idpb = $_POST["idpb"];
            $addr = $_POST["addr"];

            $modelAdmin = new Model_Admin();
            $modelNhanVien = new Model_NhanVien();
            if (!empty($idnv) && !empty($name) && !empty($idpb) && !empty($addr)) {
                $result = $modelAdmin->addNewNv($idnv, $name, $idpb, $addr);
                if ($result) {
                    $nhanViens = $modelNhanVien->getAllNhanVien();
                    include_once("../View/QuanLyNhanVien.html");
                }
            } else {
                echo "Error: Điền đủ tt!";
            }
        } else if (isset($_GET['action']) && $_GET['action'] == 'update') {
            $idnv = $_GET['IDNV'];
            $modelAdmin = new Model_Admin();
            if (!empty($idnv)) {
                $nhanVien = $modelAdmin->getNvDetail($idnv);
                include_once("../View/UpdateNv.html");
            } else {
                echo "Error:Vui lòng Điền đủ thông tin!";
            }
        } elseif (isset($_POST['updateNv'])) {
            $idnv = $_POST['idnv'];
            $hoten = $_POST['name'];
            $idpb = $_POST['idpb'];
            $diachi = $_POST['addr'];

            $modelNhanVien = new Model_NhanVien();
            $modelAdmin = new model_Admin();
            if (!empty($hoten) && !empty($idpb) && !empty($diachi)) {
                $result = $modelAdmin->updateNv($idnv, $hoten, $idpb, $diachi);

                if ($result) {
                    $nhanViens = $modelNhanVien->getAllNhanVien();
                    include_once("../View/QuanLyNhanVien.html");
                } else {
                    echo "Error: Cập nhật sinh viên thất bại.";
                }
            } else {
                echo "Error: Vui lòng điền  đủ thông tin.";
            }
        } else if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            $idnv = $_GET['IDNV'];
            $modelAdmin = new Model_Admin();
            $modelNhanVien = new model_NhanVien();
            if (!empty($idnv)) {
                $rs = $modelAdmin->deleteNv($idnv);
                if ($rs) {
                    $nhanViens = $modelNhanVien->getAllNhanVien();
                    include_once('../View/QuanLyNhanVien.html');
                } else {
                    echo 'Delete Failed';
                }
            } else {
                echo 'Not Found Student ID';
            }
        } else if (isset($_GET['action']) && $_GET['action'] == 'quanlyPB') {
            $modelPhongBan = new Model_PhongBan();
            $phongBan = $modelPhongBan->getAllPhongBan();

            include_once("../View/QuanLyPhongBan.html");
        } else if (isset($_GET['action']) && $_GET['action'] == 'updatePb') {
            $idpb = $_GET['IDPB'];
            $modelAdmin = new Model_Admin();
            if (!empty($idpb)) {
                $phongBan = $modelAdmin->getPbDetail($idpb);
                include_once("../View/UpdatePhongBan.html");
            } else {
                echo "Error:Vui lòng Điền đủ thông tin!";
            }
        } elseif (isset($_POST['updatePb'])) {
            $idpb = $_POST['idpb'];
            $tenPb = $_POST['name'];
            $moTa = $_POST['mota'];
            $modelAdmin = new Model_Admin();
            $modelPhongBan = new Model_PhongBan();


            if (!empty($idpb) && !empty($tenPb) && !empty($moTa)) {
                $result = $modelAdmin->updatePb($idpb, $tenPb, $moTa);

                if ($result) {
                    $phongBan = $modelPhongBan->getAllPhongBan();
                    include_once("../View/QuanLyPhongBan.html");
                } else {
                    echo "Error: Cập nhật sinh viên thất bại.";
                }
            } else {
                echo "Error: Vui lòng điền  đủ thông tin.";
            }
        } else if (isset($_GET['action']) && $_GET['action'] === 'addPb') {
            include_once("../View/AddPhongBan.html");
        } else if (isset($_POST['addNewPb'])) {
            $idpb = $_POST['idpb'];
            $name = $_POST["name"];
            $moTa = $_POST["moTa"];
            $modelAdmin = new Model_Admin();
            $modelPhongBan = new Model_PhongBan();

            if (!empty($idpb) && !empty($name) && !empty($moTa)) {
                $result = $modelAdmin->addNewPb($idpb, $name, $moTa);
                if ($result) {
                    $phongBan = $modelPhongBan->getAllPhongBan();
                    include_once("../View/QuanLyPhongBan.html");
                }
            } else {
                echo "Error: Điền đủ tt!";
            }
        } else {
            include_once("../View/AdminPage.html");
        }




    }


}
;
$C_admin = new Ctrl_Admin();
$C_admin->invoke();
?>