<?php


class Database
{
    public $connect;

    public function __construct()
    {
        $this->connect = new mysqli("localhost",
            "root", "", "g-strip",3306) or die("Error connecting to Database " . $this->getConnect()->error);
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