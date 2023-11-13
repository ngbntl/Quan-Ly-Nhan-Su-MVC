<?php
include_once("E_NhanVien.php");
include_once("db.php");

class Model_NhanVien
{
    private $db;
    public function __construct()
    {
        $this->db = new Db();
    }
    public function getAllNhanVien()
    {
        $sql = "SELECT * FROM nhanvien";
        $rs = $this->db->conn->query($sql);
        if ($rs) {
            $nhanViens = array();
            while ($row = $rs->fetch_assoc()) {
                $nhanViens[] = $row;
            }
            return $nhanViens;
        } else {
            echo "Error: " . $this->db->conn->error;
            return array();
        }
    }
    public function searchNhanVien($key, $searchBy)
    {
        $sql = "SELECT * FROM nhanvien";
        if ($searchBy == "idnv") {
            $sql .= " WHERE IDNV = '$key'";
        } elseif ($searchBy == "name") {
            $sql .= " WHERE `Họ và tên` = '$key'";
        } elseif ($searchBy == "idpb") {
            $sql .= " WHERE IDPB = '$key'";
        } elseif ($searchBy == "addr") {
            $sql .= " WHERE `Địa chỉ` = '$key'";
        }
        $rs = $this->db->conn->query($sql);
        if ($rs) {
            $nhanViens = array();

            while ($row = $rs->fetch_assoc()) {
                $nhanViens[] = $row;
            }
            return $nhanViens;
        } else {
            echo "Error: " . $this->db->conn->error;
            return array();
        }

    }
    public function getNhanVienDetail($idnv)
    {
        $sql = "SELECT * from nhanvien where idnv = ?";
        $stmt = $this->db->conn->prepare($sql);

        $stmt = $this->db->conn->prepare($sql);
        // Bind the parameters to our prepared statement
        $stmt->bind_param("i", $idnv);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            $stmt->close();
            return $student;
        } else {
            $stmt->close();
            return array();
        }

    }


}



?>