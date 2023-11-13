<?php
class Entity_Admin
{
    public $id;
    public $username;
    public $password;
    function __construct($_id, $_username, $_password)
    {
        $this->id = $_id;
        $this->username = $_username;
        $this->password = $_password;

    }
}
?>