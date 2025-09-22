<?php

    //é um arquivo que define como as URLs de um site são mapeadas para as diferentes funcionalidades da aplicação$a
    // Inclui arquivos de controlador necessários para lidar com diferentes ações
    require 'controllers/AuthController.php'; // Inclui o controlador de autenticação
    require 'controllers/UserController.php';
    require 'controllers/DashboardController.php';


    // Cria instâncias dos controladores para utilizar seus métodos
    $authController = new AuthController(); // Instancia o controlador de autenticação
    $userController = new UserController();
    $dashboardController = new DashboardController();


        // Coleta a ação da URL, se não houver ação definida, usa 'login' como padrão
    $action = $_GET['action'] ?? 'login'; // Usa o operador de coalescência nula (??) para definir 'login' se 'action' não estiver presente

    // Verifica a ação solicitada e chama o método apropriado do controlador
    switch ($action) {
        case 'login':
            $authController->login(); // Chama o método de login do controlador de autenticação
            break;
        case 'logout':
            $authController->logout();
            break;
        case 'register':
            $userController->register();
            break;
        case 'list':
            $userController->list();
            break;
        case 'dashboard':
            $dashboardController->index();
            break;
        case 'edit':
            $id = $_GET['id'];
            $userController->edit($id);
            break;
        case 'delete':
            $id = $_GET['id'];
            $userController->delete($id);
            break;
        default;
            $authController->login(); // Chama o método de logout do controlador de autenticação
            break;
            
    }