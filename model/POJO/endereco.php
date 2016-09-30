<?php
#   Classe 'Endereco':

#   Na classe 'Endereco' estão contidas informações relativas ao endereço as instancias de usuários
#   conceitualmente o endereço possui relação de composição a classe 'Usuario' pois para a existêcia
#   logica de um usuário no sistema é imprescindível que o mesmo possua um endereço contendo suas 
#   respectivas cordenadas.

    require_once 'dataBase.php';
    
    class Endereco{
        private $estado;         
        private $cidade;
        private $CEP;
        private $numeroResidencia;
        private $longitude;
        private $latitude;
        
        public function  __construct($estado, $cidade, $CEP, $numeroResidencia, $longitude, $latitude){
            $this->estado = $estado;
            $this->cidade = $cidade;
            $this->CEP = $CEP;
            $this->numeroResidencia = $numeroResidencia;
            $this->longitude = $longitude;
            $this->latitude = $latitude;
        }
        public function  novoEndereco(){
            $bancoDeDados = Database::getInstance();
            $querySQL = "INSERT INTO endereco (cd_numResiden, cd_cep, nm_cidade, sg_estado, cd_lon, cd_lat) 
                         VALUES (:cd_numResiden, :cd_cep, :nm_cidade, :sg_estado, :cd_lon, :cd_lat)";
            $comandoSQL =  $bancoDeDados->prepare($querySQL);
            $comandoSQL -> bindParam(':cd_numResiden', $this->numeroResidencia);
            $comandoSQL -> bindParam(':cd_cep', $this->CEP);
            $comandoSQL -> bindParam(':nm_cidade', $this->cidade);
            $comandoSQL -> bindParam(':sg_estado', $this->estado);
            $comandoSQL -> bindParam(':cd_lon', $this->longitude);
            $comandoSQL -> bindParam(':cd_lat', $this->latitude);
            $comandoSQL->execute();
            
            return $bancoDeDados->lastInsertId();
        }
        public function  verEndereco($codigoEndereco){
            $querySQL = "SELECT * FROM ENDERECO WHERE cd_endereco = :cd_endereco";
            $comandoSQL = dataBase::prepare($querySQL);
            $comandoSQL->bindParam(':cd_endereco',$codigoEndereco);
            $comandoSQL->execute();
            return $comandoSQL->fetchAll();
        }
        public function  editarEndereco($codigoEndereco){
            $querySQL = "UPDATE ENDERECO SET (cd_numeroResidencia = :cd_numeroResidencia, cd_cep = :cd_cep, nm_cidade = :nm_cidade, sg_estado = :sg_estado, cd_logitude = :cd_logitude, cd_latitude = :cd_latitude) 
                         WHERE cd_endereco = :cd_endereco";
            $comandoSQL = dataBase::prepare($querySQL);
            $comandoSQL->bindParam(':cd_numeroResidencia', $this->numeroResidencia);
            $comandoSQL->bindParam(':cd_logitude', $this->longitude);
            $comandoSQL->bindParam(':cd_latitude', $this->latitude);
            $comandoSQL->bindParam(':nm_cidade', $this->cidade);
            $comandoSQL->bindParam(':sg_estado', $this->estado);
            $comandoSQL->bindParam(':cd_cep', $this->CEP);
            $comandoSQL->bindParam(':cd_endereco', $codigoEndereco);
            return $comandoSQL->execute();
        }
        
    }
?>