<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection


$dsn = "mysql:host=localhost;dbname=lab";
$key = new PDO($dsn, "root", "");
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    $sql = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY progress";
    $state = $key->prepare($sql);
    $state->bindParam(':user_id', $user_id);
    $state->execute();

    if ($state) {
        $result = $state->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>To-Do | Task List</title>
		<script src="https://cdn.tailwindcss.com"></script>
	</head>
	<body>
	<style>
  		body {
    		background-image: url('assets/walpaper2.jpg'); 
   			background-size: cover;
    		background-repeat: no-repeat;
    		background-attachment: fixed;
  			}
	</style>
		<nav class="bg-gray-700 p-4">
			<div class="container mx-auto flex justify-between items-center">
			<div class="flex items-center">
      				<img src="assets/ikon lab.png" alt="To-Do Icon" class="w-10 h-10 mr-2">
      				<div class="text-white text-xl font-semibold">🅽🅾🆃🅴🅳!</div>
   				 </div>
				<?php
				$login = '<a
				href="login.php"
				class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded transition duration-300 ease-in-out"
				>Login</a
				>';

				$logout = '<a
				href="loginprocess.php"
				class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded transition duration-300 ease-in-out"
				>𝙻𝚘𝚐𝚘𝚞𝚝</a
				>';

				if(isset($_SESSION['username'])){
					echo $logout;
				}else{
					echo $login;
				}
				?>
			</div>
		</nav>
		<div class="flex justify-center items-center my-12">
			<div class="container mx-8 my-auto">
				<h1 class="text-6xl font-bold my-2">ᴺᵒᵗᵉᵈ!ᴸⁱˢᵗ!</h1>
				<?php
				if(!isset($_SESSION['username'])){
					echo "<p class='text-lg'>𝙰𝚗𝚍𝚊 𝚋𝚎𝚕𝚞𝚖 𝚕𝚘𝚐𝚒𝚗.</p>";
				}else{
					echo "<p class='text-lg'> 𝚂𝚎𝚕𝚊𝚖𝚊𝚝 𝙳𝚊𝚝𝚊𝚗𝚐, ".$_SESSION['username']."!</p>";
				}
				?>
				<br />
				<div class="flex justify-between">
					<?php
					if(isset($_SESSION['username'])){
						$addTask = '<a
						href="taskProcess/addtask.php"
						class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
						𝚃𝚊𝚖𝚋𝚊𝚑 𝚃𝚊𝚜𝚔
						<svg
							xmlns="http://www.w3.org/2000/svg"
							fill="none"
							viewBox="0 0 24 24"
							stroke="currentColor"
							class="w-4 h-4 inline-block mb-1">
							<path
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="M12 4v16m8-8H4"></path>
						</svg>
						</a>';
						echo $addTask;
					}
					?>
				</div>
				<table class="w-full border-collapse border-slate-500 my-4">
					<thead>
						<tr>
							<th class="border-y-2 px-4 py-2 text-left w-1/2">𝚃𝚊𝚜𝚔</th>
							<th class="border-y-2 px-4 py-2 text-left w-1/12">𝙳𝚘𝚗𝚎?</th>
							<th class="border-y-2 px-4 py-2 text-left w-1/5">𝙿𝚛𝚘𝚐𝚛𝚎𝚜𝚜</th>
							<?php
							if(isset($_SESSION['username'])){
								echo '<th class="border-y-2 px-4 py-2 text-left w-1/12">𝙴𝚍𝚒𝚝</th>';
								echo '<th class="border-y-2 px-4 py-2 text-left w-1/12">𝙳𝚎𝚕𝚎𝚝𝚎</th>';
							}
							?>
						</tr>
					</thead>
					<tbody>
    <?php foreach ($result as $row) { 
        switch ($row['progress']){
            case 1:
                $rowcolor = "bg-green-100";
                break;
            case 2:
                $rowcolor = "bg-yellow-100";
                break;
            case 3:
                $rowcolor = "bg-gray-100";
                break;  
        }
    ?>
    <tr class="<?= $rowcolor; ?>">
        <td class="border-y-2 px-4 py-2">
            <?php if(isset($_SESSION['username'])){ ?>
				<a class="hover:underline <?php if($row['progress'] == 3){ echo 'line-through'; }?>" href="taskProcess/taskdetail.php?id=<?=$row['task_id']?>"><?=$row['title']?></a>
            <?php } else { ?>
                <?= $row['title']; ?>
            <?php } ?>
        </td>
        <td class="border-y-2 px-4 py-2">
            <input type="checkbox" onchange="updateDone(<?=$row['task_id']?>, this.checked)" class="form-checkbox h-5 w-5 text-blue-600" <?php if(!isset($_SESSION['username'])){ echo "disabled"; }?> <?php if($row["done"] == 1 || $row["progress"] == 3){ echo "checked"; } ?> />
        </td>
        <td class="border-y-2 px-4 py-2">
            <?php if(isset($_SESSION['username'])){ ?>
                <select class="block w-1/2 p-1 border border-gray-400 rounded" onchange="updateProgress(<?=$row['task_id']?>, this.value)">
                    <option value="1" <?php if($row["progress"] == 1){ echo "selected"; } ?>>𝙸𝚗 𝙿𝚛𝚘𝚐𝚛𝚎𝚜𝚜</option>
                    <option value="2" <?php if($row["progress"] == 2){ echo "selected"; } ?>>𝙽𝚘𝚝 𝚈𝚎𝚝 𝚂𝚝𝚊𝚛𝚝𝚎𝚍</option>
                    <option value="3" <?php if($row["progress"] == 3){ echo "selected"; } ?>>𝙳𝚘𝚗𝚎</option>
                </select>
            <?php } else { ?>
                <?= ($row['progress'] == 1) ? "In Progress" : (($row['progress'] == 2) ? "Not Yet Started" : "Done"); ?>
            <?php } ?>
        </td>
        <?php if(isset($_SESSION['username'])){ ?>
            <td class="border-y-2 px-4 py-2">
                <a href="taskProcess/edittask.php?id=<?=$row['task_id']?>" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">𝙴𝚍𝚒𝚝</a>
            </td>
            <td class="border-y-2 px-4 py-2">
                <button onclick="confirmDelete(<?=$row['task_id']?>)" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">𝙳𝚎𝚕𝚎𝚝𝚎</button>
            </td>
        <?php } ?>
    </tr>
    <?php } ?>
</tbody>

				</table>
			</div>
		</div>

		<script>
			function updateDone(taskId, isChecked) {
				let xhr = new XMLHttpRequest();
				xhr.open("POST", "update_done.php", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						location.reload();
					}
				};

				let data = "taskId=" + taskId + "&isChecked=" + (isChecked ? "1" : "0");
				xhr.send(data);
			}

			function updateProgress(taskId, selectedProgress) {
				let xhr = new XMLHttpRequest();
				xhr.open("POST", "update_progress.php", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						location.reload();
					}
				};

				let data = "taskId=" + taskId + "&selectedProgress=" + selectedProgress;
				xhr.send(data);
			}

					function confirmDelete(taskId) {
					var r = confirm("Apakah Anda yakin ingin menghapus tugas ini?");
					if (r == true) {
						deleteTask(taskId);
					} else {
					}
				}

				function deleteTask(taskId) {
					let xhr = new XMLHttpRequest();
					xhr.open("POST", "taskProcess/deletetask.php", true);
					xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

					xhr.onreadystatechange = function () {
						if (xhr.readyState === 4 && xhr.status === 200) {
							location.reload();
						}
					};

					let data = "id=" + taskId;
					xhr.send(data);
				}
		</script>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</body>
</html>
