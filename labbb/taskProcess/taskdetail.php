<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection

if(isset($_SESSION['username'])){
	$dsn = "mysql:host=localhost;dbname=lab";
$key = new PDO($dsn, "root", "");

$id = $_GET['id'];

$sql = "SELECT * FROM tasks WHERE task_id = ?"; 

$state = $key->prepare($sql);
$data = [$id];
$state->execute($data);
$row = $state->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" />
		<title>To-Do | Task Detail</title>
	</head>
	<body class="bg-gray-100 min-h-screen flex items-center justify-center">
		<div class="bg-white p-8 rounded shadow-md w-96">
			<h1 class="text-2xl font-semibold mb-6">𝚃𝚊𝚜𝚔 𝙳𝚎𝚝𝚊𝚒𝚕</h1>
			<form>
				<p class="text-l mb-2">𝚃𝚒𝚖𝚎 𝙲𝚛𝚎𝚊𝚝𝚎𝚍:<br><?=$row['timecreated']?></p>
				<div class="mb-4">
					<label for="taskName">𝚃𝚊𝚜𝚔 𝙽𝚊𝚖𝚎:</label>
					<p><?=$row['title']?></p>
				</div>
				<div class="mb-4">
					<label for="taskDescription">𝚃𝚊𝚜𝚔 𝙳𝚎𝚜𝚌𝚛𝚒𝚙𝚝𝚒𝚘𝚗:</label>
					<p><?=$row['description']?></p>
				</div>
				<p class="text-l">𝙿𝚛𝚘𝚐𝚛𝚎𝚜𝚜:</p>
				<p class="mb-6">
					<?php
						if($row['progress'] == 1){
							echo "In Progress";
						}else if($row['progress'] == 2){
							echo "Not Yet Started";
						}else{
							echo "Done";
						}
					?>
				</p>
				</form>
			<a href="../list.php" class="mt-4 block text-blue-500 hover:underline"
				>𝙺𝚎𝚖𝚋𝚊𝚕𝚒 𝚔𝚎 𝙽𝚘𝚝𝚎𝚍 𝚕𝚒𝚜𝚝</a
			>
		</div>
	</body>
</html>
