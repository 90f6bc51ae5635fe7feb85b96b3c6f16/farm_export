<?php
require_once("BaseModel.php");

class SettingModel extends BaseModel {

    function __construct() {
        if(!static::$db) {
            static::$db = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
        }

        mysqli_set_charset(static::$db,"utf8");
    }

    function getSettingBy() {
        $sql = "SELECT * FROM tb_setting ";

        if ($result = mysqli_query(static::$db, $sql, MYSQLI_USE_RESULT)) {
            $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $result->close();
            return $data;
        }
    }
}
?>