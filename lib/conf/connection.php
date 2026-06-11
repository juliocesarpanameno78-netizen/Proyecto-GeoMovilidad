<?php 
    class Connection{

        private $server;
        private $user;
        private $password;
        private $database;
        private $port;
        private $link;

          function __construct(){
            $this ->setConnection();
            $this ->connect();
          }


          private function setConnection(){
            require 'conf.php';
            $this ->server = $server;
            $this ->user = $user;
            $this ->password = $password;
            $this ->database = $database;
            $this ->port = $port;
          }


          private function connect(){

            $this ->link = mysqli_connect($this ->server, $this ->user, $this ->password, $this ->database, $this ->port);



            if (!$this ->link){
                die (mysqli_error($this->link));

          }else{
               //echo "Conexion exitosa";
            }
          }
          public function getConnection(){
            return $this ->link;
    }
    public function close(){
        mysqli_close($this ->link);
    }   

    }

?>