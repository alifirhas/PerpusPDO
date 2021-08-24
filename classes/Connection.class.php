<?php

class Connection{

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbName = "dts_vsga_perpus";

    protected function connect(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;//data sourse name
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}