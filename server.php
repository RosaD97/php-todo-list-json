<?php

require_once(__DIR__.'/functions.php');

// Legge il file e ci restituisce il contenuto come stringa
$database = file_get_contents(__DIR__.'/todo-list.json');

// Trasforma la stringa in array associativo
$todo_list = json_decode($database, true);

// Gestione aggiunta todo
if(isset($_POST['add'])){
    $todo_list = addTodo($todo_list, $_POST);
}

// Gestione cancella todo
if(isset($_POST['delete'])){
    $todo_list = deleteTodo($todo_list, $_POST['delete']);
}

// Gestione modifica dati
if(isset($_POST['edit'])){
    $todo_list = editTodo($todo_list, $_POST);
}

// Trasforma di nuovon i file in json
header('Content-Type: application/json');
$result = json_encode($todo_list);
echo $result;



