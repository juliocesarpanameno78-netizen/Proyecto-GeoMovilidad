<?

    include_once ("../lib/conf/connection.php");

        class MasterModel extends Connection{
            
            public function select($sql){
                $result = mysqli_query($this->getConnect(),$sql);
                return $result;
            }

            public function insert($sql){
                $result = mysqli_query($this->getConnect(),$sql);
                return $result;
            }

            public function update($sql){
                $result = mysqli_query($this->getConnect(),$sql);
                return $result;
            }

            public function delete($sql){
                $result = mysqli_query($this->getConnect(),$sql);
                return $result;
            }

            public function findOne($table, $fields, $condition){
                $sql = "SELECT $fields FROM $table WHERE $condition";

                $result = mysqli_query($this->getConnect(), $sql);

                if(mysqli_num_rows($result)>0){
                    return $result;
                }else{
                    return "No se encontro ningun registro";
                }
            }

            public function autoincrement($table, $field){
                $sql = "SELECT MAX($field) FROM $table";

                $result = mysqli_query($this->getConnect(), $sql);

                $max_id = mysqli_fetch_array($result);

                return $max_id[0] + 1;
            }

        }

 ?>