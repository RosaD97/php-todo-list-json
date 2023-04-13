<?php

// Funzione per aggiungere un todo
function addTodo($todo_list, $params) 
{
    $backup_todo_list = $todo_list;

    $todo = [
        'text' => $params['todo'],
        'done' => false
    ];

    $todo_list[] = $todo;

    // Salvare in db
    saveFile('todo-list.json', json_encode($backup_todo_list), json_encode($todo_list));
    return $todo_list;
}

// Funzione per cancellare un todo
function deleteTodo($todo_list, $index)
{
    $backup_todo_list = $todo_list;
    unset($todo_list[$index]);
    // Salvare in db
    saveFile('todo-list.json', json_encode($backup_todo_list), json_encode($todo_list));
    return $todo_list;
}

// Funzione per modificare un todo
function editTodo($todo_list, $params)
{
    $backup_todo_list = $todo_list;
    $index = $params['edit'];
    $todo_list[$index]['text'] = $params['text'];

    $todo_list[$index] = array(
        'text' => $params['text'],
        'done' => false
    );

    // Salvare in db
    saveFile('todo-list.json', json_encode($backup_todo_list), json_encode($todo_list));
    return $todo_list;
}


function saveFile($file, $old_data = NULL, $new_data = NULL)
{
    if ($old_data !== NULL) {

        // Crea cartella se non esiste
        if (!is_dir(__DIR__ . '/bk')) {
            // dir doesn't exist, make it
            mkdir(__DIR__ . '/bk');
        }


        $filename = __DIR__ . '/' . date("ymdHis") . '/' . $file;
        file_put_contents($filename, $old_data);
    }
    if ($new_data !== NULL) {
        $filename = __DIR__ . '/' . $file;
        file_put_contents($filename, $new_data);
    }
}
