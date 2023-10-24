<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection

if (isset($_SESSION['username'])) {
    if (isset($_POST['taskId']) && isset($_POST['isChecked'])) {

        $taskId = $_POST['taskId'];
        $isChecked = ($_POST['isChecked'] === "1") ? 1 : 0;

        $dsn = "mysql:host=localhost;dbname=lab";
        $key = new PDO($dsn, "root", "");

        if($isChecked == 1){
            $sql = "UPDATE tasks SET progress = 3, done = :isChecked WHERE task_id = :taskId";
        }else{
            $sql = "UPDATE tasks SET progress = 2, done = :isChecked WHERE task_id = :taskId";
        }
        $state = $key->prepare($sql);
        $state->bindParam(':isChecked', $isChecked, PDO::PARAM_INT);
        $state->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        $state->execute();
    }
}
?>
