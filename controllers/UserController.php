<?php

    class UserController {

        public function register() {

            // Verifica se a requisição HTTP é do tipo POST (se o formulário foi enviado)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Coleta os dados enviados pelo formulário e organiza em um array
            $data = [
                'nome' => $_POST['nome'], // Nome do usuário
                'email' => $_POST['email'], // E-mail do usuário
                'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT), // Criptografa a senha
                'perfil' => $_POST['perfil'] // Perfil do usuário (admin, gestor, colaborador)
            ];

            User::create($data);

            header('Location: index.php');
        } else {
            include 'views/register.php';
        }
    }
}