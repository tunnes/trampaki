<?php
    require_once('model/DAO/usuarioDAO.php');
    
    class anuncianteDAO extends usuarioDAO{
    #   Padrão de Projeto Singleton -----------------------------------------------------------------------------    
        private static $instance;
        public function getInstance(){
            return !isset(self::$instance) ? self::$instance = new anuncianteDAO() : self::$instance;
        }
        
    #   Funções de acesso ao banco ------------------------------------------------------------------------------
        public function cadastrarAnunciante(Anunciante $objetoAnunciante){
        #   Cadastrando um usuário genérico e recebendo seu 
        #   atributo identificador do banco de dados: 
            $codUsuario = $this->cadastrarUsuario($objetoAnunciante, '0');
            
            $bancoDeDados = Database::getInstance();
            $querySQL = "INSERT INTO anunciante (cd_usuario) VALUES (:cd_usuario)";
            $comandoSQL = $bancoDeDados->prepare($querySQL);
            $comandoSQL->bindParam(':cd_usuario', $codUsuario);
            $comandoSQL->execute();
        }
    }
?>