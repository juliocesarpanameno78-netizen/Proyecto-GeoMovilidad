<?php

require_once dirname(__FILE__) .'../../lib/conf/connection.php';

class MasterModel extends Connection {

    public function select($sql) {
        $result = pg_query($this->getConnection(), $sql);

        if (!$result) {
            die(pg_last_error($this->getConnection()) . "<br><br>" . $sql);
        }

        $rows = array();

        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function insert($sql) {
        $result = pg_query($this->getConnection(), $sql);
        return $result;
    }

    public function update($sql) {
        $result = pg_query($this->getConnection(), $sql);
        return $result;
    }

    public function delete($sql) {
        $result = pg_query($this->getConnection(), $sql);
        return $result;
    }

    public function findOne($table, $fields, $condition) {
        $sql = "SELECT $fields FROM $table WHERE $condition";
        $result = pg_query($this->getConnection(), $sql);
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