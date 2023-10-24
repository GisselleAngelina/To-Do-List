<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection


$dsn = "mysql:host=localhost;dbname=lab";
$key = new PDO($dsn, "root", "");

function addTask(){
    global $key;

    $title = $_POST['title'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $done = $_POST['done'];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO tasks (title, description, progress, done, user_id) 
                VALUES (?, ?, ?, ?, ?)";

        $state = $key->prepare($sql);
        $data = [$title, $description, $progress, $done, $user_id];
        $state->execute($data);
    } else {
    }

    header('Location: list.php');
}

function updateTask(){
    global $key;

    $task_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $done = $_POST['done'];

    $sql = "UPDATE tasks SET title = ?, description = ?, progress = ?
    WHERE task_id = ?"; 

    $state = $key->prepare($sql);
    $data = [$title, $description, $progress, $task_id]; 
    $state->execute($data);

    header('Location: list.php');
}


if($_POST['mode'] == "add"){
    addTask();
}elseif($_POST['mode'] == "update"){
    updateTask();
}
?>
