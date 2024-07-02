<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description'];
    
}

$task = new Task();
$task->title = 'Minha primeira Tarefa';
$task->description = 'Está é a descrição da minha primeira tarefa';
$task->save();

$tasks = Task::all();

foreach ($tasks as $task) {
    echo $task->title . ':' . $task->description. '<br>';
}

$task = Task::find($id);

if ($task) {
    echo $task->title . ': ' . $task->description;
} else {
    echo 'Tarefa não encontrada.';
}