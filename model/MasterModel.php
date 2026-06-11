<?php

require_once '../lib/conf/connection.php';

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
        $sql = "SELECT $fields FROM $table WHERE $condition";
        $result = pg_query($this->getConnect(), $sql);
        if ($result && pg_num_rows($result) > 0) {
            return $result;
        } else {
            return null;
        }
    }

    public function autoincrement($table, $field) {
        $sql = "SELECT COALESCE(MAX($field), 0) + 1 AS next_id FROM $table";
        $result = pg_query($this->getConnection(), $sql);
        $row = pg_fetch_assoc($result);
        return $row['next_id'];
    }
}
?>