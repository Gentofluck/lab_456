<?php
    class DB{
        private $db;
        public function __construct (){
            try{
                $this->db = new PDO('mysql:host=' . "localhost" . ';dbname=' . "lab_456", "gentofluck", "melonarena03");
                $this->db->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e){
                throw $e;
            }
        }
        public function check($login, $password){
            $query = $this->db->prepare("SELECT * FROM admin_db WHERE login = ?");
            $query->execute([$login]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password, $user['password'])) {
                return true;
            }
            return false;

        }
        public function import_All_flowers(){
            return $this->db->query("SELECT * FROM popular_flower");
        }
        public function add_New_flower($id, $name, $description, $size, $price, $photo){
            try{
                $sql = "INSERT INTO popular_flower (id, name, description, size, price, photo) VALUES (?, ?, ?, ?, ?, ?)";
                $table = $this->db->prepare($sql);
                $table->execute([$id, $name, $description, $size, $price, $photo]);
            }
            catch (PDOException $e){
                throw $e;
            }
        }
        public function find_Flower($id){
            $sth = $this->db->prepare("SELECT * FROM popular_flower WHERE id = $id");
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        }
        public function get_last_id (){
            $list = $this->db->query("SELECT id FROM popular_flower ORDER BY id DESC LIMIT 1 ");
            $row = $list->fetch();
            if ($row){
                return $row['id'];
            }
            return 0;
        }
        public function change_Flower($id, $name, $description, $size, $price, $photo){
            try{
                if ($photo){
                    $sql = "UPDATE popular_flower SET name=?, description=?, size=?, price=?, photo=? where id = ?";
                    $table = $this->db->prepare($sql);
                    $table->execute([$name, $description, $size, $price, $photo, $id]);
                }
                else{
                    $sql = "UPDATE popular_flower SET name=?, description=?, size=?, price=? where id = ?";
                    $table = $this->db->prepare($sql);
                    $table->execute([$name, $description, $size, $price, $id]);
                }
            }
            catch (PDOException $e){
                throw $e;
            }
        }
        public function delete_flower($id){
            try{
                $sql = 'DELETE FROM popular_flower WHERE id = ?';
                $table = $this->db->prepare($sql);
                $table->execute([$id]);
            }
            catch (PDOException $e){
                throw $e;
            }
        }
    }
?>