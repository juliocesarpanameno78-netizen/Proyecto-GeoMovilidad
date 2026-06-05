<?php

class Connection {

    private $host;
    private $user;
    private $password;
    private $database;
    private $port;
    private $link;

    public function __construct() {
        $this->setConnect();
        $this->connect();
    }

    private function setConnect() {
        require_once 'conf.php';

        $this->host     = $host;
        $this->user     = $user;
        $this->password = $password;
        $this->database = $database;
        $this->port     = $port;
    }

    private function connect() {
        $cadena = "host={$this->host} port={$this->port} dbname={$this->database} user={$this->user} password={$this->password}";
        $this->link = pg_connect($cadena);

        if (!$this->link) {
            die("Error al conectar con la base de datos");
        }
    }

    public function getConnect() {
        return $this->link;
    }
}

?>