<?php

class dbCredentials
{
    private $dbHost;
    private $dbPort;
    private $dbName;
    private $dbUsername;
    private $dbPassword;
    private $dbString;

    public function __construct()
    {
        $this->dbHost = "vps2.white-it.net";
        $this->dbPort = 5432;
        $this->dbName = "myfridge";
        $this->dbUsername = "mbandowski";
        $this->dbPassword = "TI/%ERebo8ifg8ib6";
        $this->dbString = "host=" . $this->dbHost . " port=" . $this->dbPort . " dbname=" . $this->dbName . " user=" . $this->dbUsername . " password=" . $this->dbPassword;
    }

    public function getDBString()
    {
        return $this->dbString;
    }
}
