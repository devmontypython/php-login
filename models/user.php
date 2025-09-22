<?php

// Inclui o arquivo 'database.php' que contém a classe Database para gerenciar a conexão com o banco de dados
require_once 'models/database.php';

// Definição da classe User, que representa as operações relacionadas aos usuários no sistema
class User {

     // Função para encontrar um usuário pelo email
     public static function findByEmail($email){
         // Obtém a conexão com o banco de dados
         $conn = Database::getConnection();
         
         // Prepara uma consulta SQL para buscar o usuário pelo email
         $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
         
         // Executa a consulta com o email passado como parâmetro
         $stmt->execute(['email' => $email]);
         
         // Retorna os dados do usuário encontrado como um array associativo
         return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        // Função para criar um novo usuário no banco de dados
        public static function create($data)
        {
            // Obtém a conexão com o banco de dados
            $conn = Database::getConnection();
            
            // Prepara uma consulta SQL para inserir um novo usuário na tabela 'usuarios'
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (:nome, :email, :senha, :perfil)");
            
            // Executa a consulta, passando os dados do novo usuário (nome, email, senha e perfil)
            $stmt->execute($data);
        }

        public static function find($id) {

            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public static function update($id, $data) {

            $conn = Database::getConnection();
            $stmt = $conn->prepare("UPDATE usuarios SET nome = :nome, email = :email, perfil = :perfil WHERE id = :id");

            $data['id'] = $id;

            $stmt->execute($data);
        }

        public static function all() {
            // Obtém a conexão com o banco de dados
            $conn = Database::getConnection();
            // Executa uma consulta SQL simples para buscar todos os registros da tabela 'usuarios'
            $stmt = $conn->query("SELECT * FROM usuarios");
            // Retorna todos os resultados como um array associativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

}