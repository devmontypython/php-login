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
    public function edit($id) {

        session_start();
        if($_SESSION['perfil'] == 'admin' || $_SESSION['perfil'] == 'gestor') {
            $user = User::find($id);
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'nome' => $_POST['nome'],
                    'email' => $_POST['email'],
                    'perfil' => $_POST['perfil']
                ];

                User::update($id, $data);
                header('Location: index.php?action=list');
            } else {
                include 'views/edit_user.php';
            }
        } else {
            echo "Você nãp tem permissão para editar usuários";
        }
    }

    public function list() {
        // Chama o método all do Model User para obter todos os usuários do banco de dados
        $users = User::all();
        // Inclui a View que exibe a lista de usuários
        include 'views/list_users.php';
    }
}