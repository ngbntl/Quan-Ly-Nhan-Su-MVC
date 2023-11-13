<?php
include_once("E_admin.php");
include_once("db.php");
include_once("E_NhanVien.php");
class Model_Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function Login($username, $password)
    {
        $sql = "SELECT * FROM admin WHERE username = ? ";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            $hashedPassword = $admin['password'];

            if ($password == $hashedPassword) {
                return true;
                exit();
            } else {
                echo "Sai mật khẩu";
            }
        } else {
            echo "Người dùng không tồn tại";
        }
    }

    public function addNewNv($idnv, $hoten, $idpb, $diachi)
    {

        $check = "SELECT * FROM nhanvien WHERE IDNV = ?";
        $cstmt = $this->db->conn->prepare($check);
        $cstmt->bind_param("s", $idnv);
        $cstmt->execute();
        $checkRs = $cstmt->get_result();
        if ($checkRs->num_rows > 0) {
            echo "Đã tồn tại nhân viên có id: " . $idnv;
            return false;
        }
        $cstmt->close();

        $sql = "INSERT INTO nhanvien (IDNV, Name, IDPB, Address) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param('ssss', $idnv, $hoten, $idpb, $diachi);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            echo 'Error: ' . $stmt->error;
        }
        $stmt->close();
        return false;
    }
    public function updateNv($idnv, $hoten, $idpb, $diachi)
    {
        $query = "UPDATE nhanvien SET Name = ?, IDPB = ?, Address = ? WHERE IDNV = ?";

        $stmt = $this->db->conn->prepare($query);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssss", $hoten, $idpb, $diachi, $idnv);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }
    public function getNvDetail($idnv)
    {
        $sql = "SELECT * from nhanvien where IDNV = ?";
        $stmt = $this->db->conn->prepare($sql);

        $stmt = $this->db->conn->prepare($sql);
        // Bind the parameters to our prepared statement
        $stmt->bind_param("s", $idnv);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $nhanVien = $result->fetch_assoc();
            $stmt->close();
            return $nhanVien;
        } else {
            $stmt->close();
            return array();
        }

    }
    public function deleteNv($idnv)
    {
        $query = "DELETE FROM nhanvien WHERE IDNV=?";
        $stmt = $this->db->conn->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('s', $idnv);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }
    public function getPbDetail($idpb)
    {
        $sql = "SELECT * from phongban where IDPB = ?";
        $stmt = $this->db->conn->prepare($sql);

        $stmt = $this->db->conn->prepare($sql);
        // Bind the parameters to our prepared statement
        $stmt->bind_param("s", $idpb);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $phongBan = $result->fetch_assoc();
            $stmt->close();
            return $phongBan;
        } else {
            $stmt->close();
            return array();
        }

    }

    public function updatePb($idpb, $tenPb, $moTa)
    {
        $query = "UPDATE phongban SET TenPhongBan = ?, MoTa = ? WHERE IDPB = ?";

        $stmt = $this->db->conn->prepare($query);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("sss", $tenPb, $moTa, $idpb);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }

    public function addNewPb($idpb, $tenPb, $moTa)
    {

        $check = "SELECT * FROM phongban WHERE IDPB = ?";
        $cstmt = $this->db->conn->prepare($check);
        $cstmt->bind_param("s", $idpb);
        $cstmt->execute();
        $checkRs = $cstmt->get_result();
        if ($checkRs->num_rows > 0) {
            echo "Đã tồn tại phòng ban có id: " . $idpb;
            return false;
        }
        $cstmt->close();

        $sql = "INSERT INTO phongban (IDPB, TenPhongBan, MoTa) VALUES ( ?, ?, ?)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param('sss', $idpb, $tenPb, $moTa);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            echo 'Error: ' . $stmt->error;
        }
        $stmt->close();
        return false;
    }
}
?>