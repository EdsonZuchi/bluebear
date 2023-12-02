<?php
    class FavoriteRepository{

        private $mysqli;

        public function __construct($mysqli){
            $this->mysqli = $mysqli;
        }
        
        public function addFavorite(int $id_user, int $id_cep){
            $stmt = $this->mysqli->prepare("insert into favorite_ceps (id_user, id_cep) values (?, ?)");
            $stmt->bind_param("ii", $id_user, $id_cep);
            $stmt->execute(); 
            $insertedFavoriteId = $this->mysqli->insert_id;
            $stmt->close();
            return $insertedFavoriteId;
        }

        public function allFavorite(int $id_user){
            $stmt = $this->mysqli->prepare("select cp.* from favorite_ceps fc inner join ceps cp on cp.id = fc.id_cep where id_user = ?");
            $stmt->bind_param("i", $id_user);
            $stmt->execute();

            $result = $stmt->get_result();

            $stmt->close();

            return $result;
        }

        public function deleteFavorite(int $id){
            $stmt = $this->mysqli->prepare("delete from favorite_ceps where id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        public function deleteCEP(int $id_cep){
            $stmt = $this->mysqli->prepare("delete from favorite_ceps where id_cep = ?");
            $stmt->bind_param("i", $id_cep);
            $stmt->execute();
            $stmt->close();
        }
    }
?>