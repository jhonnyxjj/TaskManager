<?php

namespace Project\App\router;

use project\app\controllers\TaskController;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class InitializeRouter{

    private TaskController $controller;

    public function __construct(TaskController $controller){
        $this->controller = $controller;
    }


    public function setupRoutes(){
    $dispatcher = simpleDispatcher(function (RouteCollector $r) {
        $r->addRoute('GET', '/tasks', [$this->controller, "getAllTasks" ] );
      
        $r->addRoute('POST', '/tasks', [$this->controller, "createTask"] );
        
        $r->addRoute('PATCH', '/tasks/{id}', [$this->controller, "updateTask"] );

        $r->addRoute('DELETE','/tasks/{id}', [$this->controller, "deleteTask"] );
    });
    
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                http_response_code(404);
                echo "Route not found!";
                break;

            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                echo "Method not allowed!";
                break;

            case \FastRoute\Dispatcher::FOUND:
                // Executa o handler da rota
                $handler = $routeInfo[1];
                $vars = $routeInfo[2]; // Parâmetros da rota
                call_user_func_array($handler, $vars);
                break;
        }
    }
}
    