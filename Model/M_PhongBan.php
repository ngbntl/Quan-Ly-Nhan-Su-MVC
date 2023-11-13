<?php
include_once("E_PhongBan.php");
include_once("db.php");

class Model_PhongBan
{
    private $db;
    public function __construct()
    {
        $this->db = new db();
    }
    public function getAllPhongBan()
    {
        $sql = "SELECT * FROM phongban";
        $rs = $this->db->conn->query($sql);
        if ($rs) {
            $listPB = array();
            while ($row = mysqli_fetch_assoc($rs)) {
                $listPB[] = $row;
            }
            return $listPB;
        } else {
            echo "Error: " . $this->db->conn->error;
            return array();
        }
    }
}
?>