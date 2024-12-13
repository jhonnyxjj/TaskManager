<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/database/Database.php';
require_once __DIR__ . '/../app/repository/TaskRepository.php';
require_once __DIR__ . '/../app/services/TaskService.php';
require_once __DIR__ . '/../app/controllers/TaskController.php';
require_once __DIR__ . '/../app/router/InitializeRouter.php';


use project\app\config\database\Database;
use project\app\repository\TaskRepository;
use project\app\Services\TaskService;
use Project\App\router\InitializeRouter;
use project\app\controllers\TaskController;


try {

    $database = new Database();
    $pdoConnection = $database->Connect();

    $taskRepository = new TaskRepository($pdoConnection);
    
    $taskService = new TaskService($taskRepository);

    $taskController = new TaskController($taskService);
    

    $router = new InitializeRouter($taskController);
    $router->setupRoutes();

        echo "Sistema iniciado com sucesso!";

    }   catch (Exception $e){
        
          echo "Erro ao iniciar o sistema:" . $e->getMessage();
    }
