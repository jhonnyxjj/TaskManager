<?php
namespace project\app\Models;

use project\app\repository\TaskRepository;


class Task{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository){
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks(){
        return $this->taskRepository->getAll();
    }

    public function createTask(string $name, string $description){
        return $this->taskRepository->create($name, $description);
    }

    public function updateTask(int $id, string $name, string $description){
        return $this->taskRepository->update($id, $name, $description );
    }

    public function deleteTask(int $id){
        return $this->taskRepository->delete($id);
    }
}

