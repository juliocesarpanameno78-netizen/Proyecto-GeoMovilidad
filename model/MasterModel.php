<?php
    include_once("../lib/conf/connection.php");

    class MasterModel extends Connection {

        public function select($sql) {
            $result = pg_query($this->getConnect(), $sql);
            return $result;
        }

        public function insert($sql) {
            $result = pg_query($this->getConnect(), $sql);
            return $result;
        }

        public function update($sql) {
            $result = pg_query($this->getConnect(), $sql);
            return $result;
        }

        public function delete($sql) {
            $result = pg_query($this->getConnect(), $sql);
            return $result;
        }

        public function findOne($table, $fields, $condition) {
            $sql    = "SELECT $fields FROM $table WHERE $condition";
            $result = pg_query($this->getConnect(), $sql);

            if (pg_num_rows($result) > 0) {
                return $result;
            } else {
                return "No se encontró ningún registro";
            }
        }
    }
?>