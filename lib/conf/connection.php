<?php 
class Connection {

    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $link;

    function __construct() {
        $this->setConnection();
        $this->connect();
    }

    private function setConnection() {
        require 'conf.php';
        $this->server   = $server;
        $this->user     = $user;
        $this->password = $password;
        $this->database = $database;
        $this->port     = $port;
    }

    private function connect() {
        $connString = "host={$this->server} port={$this->port} dbname={$this->database} user={$this->user} password={$this->password} connect_timeout=5";
        $this->link = @pg_connect($connString);

        if (!$this->link) {
            $pgError = pg_last_error();
            $safeError = $pgError ? $pgError : 'No se pudo obtener el detalle del error';

            die(
                "Error de conexion a PostgreSQL. " .
                "Revise credenciales en lib/conf/conf.php " .
                "(host={$this->server}, port={$this->port}, dbname={$this->database}, user={$this->user}). " .
                "Detalle: {$safeError}"
            );
        }
    }

    public function getConnection() {
        return $this->link;
    }

    public function close() {
        pg_close($this->link);
    }
}
?>