<?php

abstract class BaseModel{
    public static $db;

    //local
    protected $host="rvscsdevelop-db.cfbckbnxiox7.ap-southeast-1.rds.amazonaws.com";
    protected $db_name="farm_base_db";
    protected $username="admin";
    protected $password="ezVrr6ia56frWz9dCUSR";
    

    function __construct() {
        static::$db = mysqli_connect($host, $username, $password, $db_name);
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        mysqli_set_charset(static::$db,"utf8");
    }
}
?>