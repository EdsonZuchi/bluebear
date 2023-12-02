<?php
    class CepRepository{

        private $mysqli;

        public function __construct($mysqli){
            $this->mysqli = $mysqli;
        }
        
        public function addCep(array $data){
            $stmt = $this->mysqli->prepare("insert into ceps (cep, logradouro, complemento, bairro, localidade, uf, ibge) values (?, ?, ?, ?, ?, ?, ?)");
            $cep = intval(str_replace('-', '', $data["cep"]));
            $stmt->bind_param("isssssi", $cep, $data["logradouro"], $data["complemento"], $data["bairro"], $data["localidade"], $data["uf"], intval($data["ibge"]));
            $stmt->execute(); 
            $insertedCepId = $this->mysqli->insert_id;
            $stmt->close();
            return $insertedCepId;
        }

        public function findByCep(int $cep){
            $stmt = $this->mysqli->prepare("select * from ceps where cep = ?");
            $stmt->bind_param("i", $cep);
            $stmt->execute();

            $result = $stmt->get_result();
            $cepResult = $result->fetch_assoc();

            $stmt->close();

            if ($cepResult) {
                return $cepResult['id'];
            } else {
                return null;
            }
        }

        public function deleteCep(int $id){
            $stmt = $this->mysqli->prepare("delete from ceps where id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
?>