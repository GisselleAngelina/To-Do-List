<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection

$dsn = "mysql:host=localhost;dbname=lab";
$key = new PDO($dsn, "root", "");


function makeAccount(){
    global $key;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $en_pass = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO user (username, password)
            VALUES (?, ?)";

    $result = $key->prepare($sql);
    $result->execute([$username, $en_pass]);

    $user_id = $key->lastInsertId(); 
    $_SESSION['user_id'] = $user_id;

    header("Location: index.php");
}

function verifyLogin(){
    global $key;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = ?";

    $state = $key->prepare($sql);
    $state->execute([$username]);
    $row = $state->fetch(PDO::FETCH_ASSOC);

    if(!$row){
        header("Location: index.php?error=usernotfound");
    } else {
        if(!password_verify($password, $row['password'])){
            header("Location: index.php?error=wrongpassword");
        } else {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            header('location: list.php');
        }
    }
}

function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
}

if($_POST['mode'] == "verify"){
    verifyLogin();
}else if($_POST['mode'] == "register"){
    makeAccount();
}else{
    logout();
}
?>