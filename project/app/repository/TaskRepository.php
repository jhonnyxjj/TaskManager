    <?php

    namespace project\app\repository;

    use project\app\config\database\Database;
    use PDOException;
    use PDO;


    class TaskRepository{
        private PDO $conn;

        public function __construct(PDO $conn)
        {
            $this->conn = $conn;
        }

        public function getAll(){
            try {
                $query = "SELECT * FROM tasks";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new PDOException("Error em buscar as tarefas:".$e->getMessage());
            }
        }

        public function create(string $name, string $description){
            try {
                $query = "INSERT INTO tasks(name, description) VALUES(:name, :description)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                return $stmt->execute();
            } catch (PDOException $e) {
                throw new PDOException("Error em criar as tarefas:".$e->getMessage());
            }
        }

        public function update(int $id, string $name, string $description){
        try {
            $query = "UPDATE tasks SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id',$id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException("Error em atualizar as tarefas:".$e->getMessage());
        }
    }

        public function delete(int $id){
            try{
                $query = "DELETE FROM tasks WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id);
                return $stmt->execute();
            }catch(PDOException $e){
                throw new PDOException("Error em deletar as tarefas:".$e->getMessage());
            }
        }
    }