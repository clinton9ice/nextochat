<?php


class Database
{
    public $connect;

    public function __construct()
    {
        $this->connect = new mysqli(database["hostname"],
            database["name"], database["password"], database["db"],database["port"]) or die("Error connecting to Database " . $this->getConnect()->error);
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