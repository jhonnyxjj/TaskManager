console.log('Script carregado com sucesso!');


document.addEventListener('DOMContentLoaded', function() {
    const taskForm = document.querySelector('.task-form');
    const taskList = document.querySelector('.task-list');

    function loadTasks() {
        fetch('index.php?action=getAllTasks')
            .then(response => response.json())
            .then(data => {
                taskList.innerHTML = ''; // Limpa lista atual
                data.data.forEach((task, index) => {
                    const taskItem = document.createElement('div');
                    taskItem.classList.add('task-item');
                    taskItem.innerHTML = `${index + 1}. ${task.name}`;
                    taskItem.onclick = () => showTaskDetails(task.name, task.description, task.id);
                    taskList.appendChild(taskItem);
                });
            });
    }

    loadTasks();

    // Cadastrar nova tarefa
    taskForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const name = document.getElementById('task-name').value;
        const description = document.getElementById('task-desc').value;

        const formData = new FormData();
        formData.append('name', name);
        formData.append('description', description);

        fetch('index.php?action=createTask', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            loadTasks(); // Recarrega lista
            taskForm.reset(); // Limpa formulário
        });
    });


    function showTaskDetails(name, description, id) {
        document.getElementById("task-detail-name").innerText = name;
        document.getElementById("task-detail-desc").innerText = description;
        document.getElementById("task-detail").style.display = "block";
        
        // Adiciona ID da tarefa para futuras operações
        document.getElementById("task-detail").dataset.taskId = id;
    }

    function saveTask() {
        const id = document.getElementById("task-detail").dataset.taskId;
        const name = document.getElementById("task-detail-name").innerText;
        const description = document.getElementById("task-detail-desc").value;

        const formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('description', description);

        fetch('index.php?action=updateTask', {
            method: 'PATH',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            loadTasks();
            document.getElementById("task-detail").style.display = "none";
        });
    }

    function deleteTask() {
        const id = document.getElementById("task-detail").dataset.taskId;

        const formData = new FormData();
        formData.append('id', id);

        fetch('index.php?action=deleteTask', {
            method: 'DELETE',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            loadTasks();
            document.getElementById("task-detail").style.display = "none";
        });
    }

    // Expõe funções globalmente para chamadas do HTML
    window.showTaskDetails = showTaskDetails;
    window.saveTask = saveTask;
    window.deleteTask = deleteTask;
});