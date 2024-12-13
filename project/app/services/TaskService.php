<?php

namespace project\app\Services;

use ErrorException;
use InvalidArgumentException;
use project\app\repository\TaskRepository;

class TaskService{
    private $task;

    public function __construct(TaskRepository $task){
        $this->task = $task;
    }

    public function getAllTask(){
        $allTasks = $this->task->getAll();
        return $allTasks;
}

    public function createTask(string $name, string $description){
        if(empty($name) || trim($name) == ""){
            throw new InvalidArgumentException(
                "O nome do tarefa é obrigatório e não pode estar vazio.");
        }
         $newTask = $this->task->create($name, $description);
         return $newTask;
    }

    public function updateTask(int $taskId, string $name, string $description){
        if(empty($this->task->$name) || empty($description)){
            throw new InvalidArgumentException("O nome e descrição não podem ser vazios");
        }
        $updateTask = $this->task->update($taskId, $name, $description);
        return $updateTask;
    }

    public function deleteTask(int $taskId){   
        if(is_nan($taskId)){
            throw new InvalidArgumentException("O ID do tarefa é inválido, ou não existe");
        } 
        $deleteTask = $this->task->delete($taskId);
        return $deleteTask;
    }

}
