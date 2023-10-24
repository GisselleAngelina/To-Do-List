<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection


if (isset($_SESSION['username'])) {
    if (isset($_POST['taskId']) && isset($_POST['selectedProgress'])) {

        $taskId = $_POST['taskId'];
        $selectedProgress = $_POST['selectedProgress'];


        $dsn = "mysql:host=localhost;dbname=lab";
        $key = new PDO($dsn, "root", "");

        $sql = "UPDATE tasks SET progress = :progress WHERE task_id = :taskId";
        $state = $key->prepare($sql);
        $state->bindParam(':progress', $selectedProgress, PDO::PARAM_INT);
        $state->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        $state->execute();
    }
}
?>
