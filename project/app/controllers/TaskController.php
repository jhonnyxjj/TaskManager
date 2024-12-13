<?php
namespace project\app\controllers;

require_once __DIR__ . '../../utils/ResponseHandler.php';


use project\app\services\TaskService;
use project\app\utils\ResponseHandler;



class TaskController{
    private $taskService;

    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }

    public function getAllTasks(){
        try{
         $tasks = $this->taskService->getAllTask();
         ResponseHandler::jsonResponse(['data' => $tasks], 200);
        }   catch(\Exception $e){
            ResponseHandler::jsonResponse(['error' => $e->getMessage()], 500);
        }
}


    public function createTask(){
        try{
            $inputData = json_decode(file_get_contents('php://input'), true);

            $newTask = $this->taskService->createTask($inputData['name'], $inputData['description']);

            ResponseHandler::jsonResponse(['data'=> $newTask],201);
    } catch(\Exception $e){ 
        ResponseHandler::jsonResponse(['error'=> $e->getMessage()],500);
     }
 }


    public function updateTask(int $id, string $name, string $description){
        try{
            $updateTask = $this->taskService->updateTask($id, $name, $description);
            ResponseHandler::jsonResponse(['data'=> $updateTask],200);
    } catch(\Exception $e){ 
        ResponseHandler::jsonResponse(['error'=> $e->getMessage()],500);
     }
    }

    public function deleteTask(int $id){
        try{    
            $deleteTask = $this->taskService->deleteTask($id);    
            ResponseHandler::jsonResponse(['data'=> $deleteTask],200);    
    } catch(\Exception $e){
            ResponseHandler::jsonResponse(['error'=> $e->getMessage()],500);
    }
 }


}