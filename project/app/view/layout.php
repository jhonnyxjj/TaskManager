<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="../../public/css/style.css">

</head>

<body>
    <div class="container">
        <h1>Gerenciador de Tarefas</h1>
        <form class="task-form">
            <label for="task-name">Tarefa:</label>
            <input type="text" id="task-name" placeholder="Nome da tarefa">

            <label for="task-desc">Descrição:</label>
            <textarea id="task-desc" placeholder="Descrição da tarefa"></textarea>

            <button type="submit">Cadastrar</button>
        </form>
        <hr>

        <div class="task-list">
            <div class="task-item" onclick="showTaskDetails('Compras', 'Comprar mantimentos para a semana')">1. Compras
            </div>
            <div class="task-item" onclick="showTaskDetails('Blábláblá', 'Fazer isso e aquilo')">2. Blábláblá</div>
            <div class="task-item" onclick="showTaskDetails('Kkk', 'Detalhes da tarefa Kkk')">3. Kkk</div>
        </div>
    </div>


    <div class="task-detail" id="task-detail" style="display: none;">
        <button class="salvar-task" onclick="saveTask()">Salvar Tarefa</button>
        <h2 id="task-detail-name">Nome da Tarefa</h2>
        <textarea id="task-detail-desc" onclick="task-desc">Descrição da Tarefa</textarea>
        <button class="delete-task" onclick="deleteTask()">Deletar Tarefa</button>
    </div>

    <script src="../../public/js/script.js"></script>
</body>

</html>