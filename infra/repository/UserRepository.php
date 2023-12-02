<?php
    class UserRepository{

        private $mysqli;

        public function __construct($mysqli){
            $this->mysqli = $mysqli;
        }
        
        public function addUser(string $ipv4){
            $stmt = $this->mysqli->prepare("insert into users (ipv4) values (?)");
            $stmt->bind_param("s", $ipv4);
            $stmt->execute(); 
            $insertedUserId = $this->mysqli->insert_id;
            $stmt->close();
            return $insertedUserId;
        }

        public function findIPV4(string $ipv4){
            $stmt = $this->mysqli->prepare("select * from users where ipv4 = ?");
            $stmt->bind_param("s", $ipv4);
            $stmt->execute();

            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            $stmt->close();

            if ($user) {
                return $user['id'];
            } else {
                return null;
            }
        }
    }
?>