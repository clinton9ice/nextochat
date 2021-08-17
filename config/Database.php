<?php
//namespace Database;
//include_once "arrays.php";

//use mysqli_stmt;

class Database
{
    public $connect;

    public function __construct()
    {
        $this->connect = new mysqli("sql4.freemysqlhosting.net",
            "sql4431286", "wvsHK65t8S", "sql4431286",3306) or die("Error connecting to Database " . $this->getConnect()->error);
    }

    /**
     * @return \mysqli
     */
    public function getConnect(): \mysqli
    {
        return $this->connect->error ? false : $this->connect;
    }

    public function Cookie(): Cookies
    {
        return new Cookies();
    }

    public function Session(): Session
    {
        return new Session();
    }

}