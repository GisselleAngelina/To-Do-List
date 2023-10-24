<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection

if(!isset($_SESSION['username'])){
    echo "Mohon login terlebih dahulu.";
    return;
}

$dsn = "mysql:host=localhost;dbname=lab";
$key = new PDO($dsn, "root", "");

$id = $_GET['id'];

$sql = "SELECT * FROM tasks WHERE task_id = ?"; 

$state = $key->prepare($sql);
$data = [$id];
$state->execute($data);
$row = $state->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" />
        <title>To-Do | Edit Task</title>
    </head>
    <body class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-96">
            <h1 class="text-2xl font-semibold mb-6">ᴇᴅɪᴛ ᴛᴀꜱᴋ</h1>
            <form action="../process.php" method="post">
                <div class="mb-4">
                    <p>𝚃𝚒𝚖𝚎 𝙲𝚛𝚎𝚊𝚝𝚎𝚍: <?=$row['timecreated']?></p>
                    <label for="taskName" class="block text-gray-700">𝚃𝚊𝚜𝚔 𝙽𝚊𝚖𝚎:</label>
                    <input
                        type="text"
                        id="taskName"
                        name="title"
                        class="w-full border border-gray-300 rounded px-3 py-2" 
                        value="<?=$row['title']?>"/>
                </div>
                <div class="mb-4">
                    <label for="taskDescription" class="block text-gray-700"
                        >𝚃𝚊𝚜𝚔 𝙳𝚎𝚜𝚌𝚛𝚒𝚙𝚝𝚒𝚘𝚗:</label
                    >
                    <textarea
                        id="taskDescription"
                        name="description"
                        class="w-full border border-gray-300 rounded px-3 py-2"><?=$row['description']?></textarea>
                </div>
                <p class="text-l mb-2">𝙿𝚛𝚘𝚐𝚛𝚎𝚜𝚜:</p>
                <select class="block w-1/2 p-1 border border-gray-400 rounded mb-4" name="progress">
                    <option value="1" <?php if($row['progress'] == "1"){ echo"selected"; } ?>>𝙸𝚗 𝙿𝚛𝚘𝚐𝚛𝚎𝚜𝚜</option>
                    <option value="2" <?php if($row['progress'] == "2"){ echo"selected"; } ?>>𝙽𝚘𝚝 𝚈𝚎𝚝 𝚂𝚝𝚊𝚛𝚝𝚎𝚍</option>
                    <option value="3" <?php if($row['progress'] == "3"){ echo"selected"; } ?>>𝙳𝚘𝚗𝚎</option>
                </select>
                <input type="hidden" name="id" value="<?=$row['task_id']?>"> 
                <input type="hidden" name="mode" value="update">
                <button
                    type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300 ease-in-out">
                    𝚂𝚞𝚋𝚖𝚒𝚝
                </button>
            </form>
            <a href="../list.php" class="mt-4 block text-blue-500 hover:underline"
                >𝙺𝚎𝚖𝚋𝚊𝚕𝚒 𝚔𝚎 𝙽𝚘𝚝𝚎𝚍 𝚕𝚒𝚜𝚝</a
            >
        </div>
    </body>
</html>
