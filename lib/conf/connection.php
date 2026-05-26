<?php 
    class Connection {
        private $server;
        private $user;
        private $password;
        private $database;
        private $port;
        private $link;

        function __construct() {
            $this->connection();
            $this->connect();
        }

        private function connection() {
            require 'conf.php';
            $this->server = $server;
            $this->user = $user;
            $this->password = $password;
            $this->database = $database;
            $this->port = $port;
        }

        private function connect(){
            $this->link = pg_connect("host={$this->server} port={$this->port} dbname={$this->database} user={$this->user} password={$this->password}");
            if (!$this->link) {
                die(pg_last_error($this->link));
            }else{
                echo "Conexion Exitosa";
            }
        }

        public function getConnect(){
            return $this->link;
        }

        public function close(){
            pg_close($this->link);
        }
    }


?>