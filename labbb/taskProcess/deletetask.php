<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection

if(isset($_SESSION['username'])){
    $dsn = "mysql:host=localhost;dbname=lab";
    $key = new PDO($dsn, "root", "");

    if(isset($_POST['id']) && is_numeric($_POST['id'])){
        $taskId = $_POST['id'];

        $sql = "DELETE FROM tasks WHERE task_id = :taskId";
        $state = $key->prepare($sql);
        $state->bindValue(':taskId', $taskId, PDO::PARAM_INT);

        if($state->execute()){
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "invalid";
    }
} else {
    echo "not_logged_in";
}
?>
