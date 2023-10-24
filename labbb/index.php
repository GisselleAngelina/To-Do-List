<?php
session_start();
error_reporting(0); // hide undefine index
include("connect.php"); // connection

$dsn = "mysql:host=localhost;dbname=lab";
$key = new PDO($dsn, "root", "");
$sql = "SELECT * FROM tasks ORDER BY progress";
$result = $key->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To-Do | Task List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'wrongusername') {
            echo "alert('Username / Password salah. Silakan coba lagi.');";
        }
        if (isset($_GET['error']) && $_GET['error'] == 'wrongpassword') {
            echo "alert('Username / Password salah. Silakan coba lagi.');";
        }
        ?>
    </script>
</head>
	</head>
	<body>
	<style>
  		body {
    		background-image: url('assets/walpaper.jpg'); 
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
				$logout = '<a href="loginprocess.php"
				class="text-white bg-red-500 hover:bg-red-500 px-4 py-2 rounded transition duration-300 ease-in-out"
				>Logout</a
				>';

				if(isset($_SESSION['username'])){
					echo $logout;
				}
				?>
				
		</nav>
				
			</div>
		</nav>
			<div class="flex justify-center items-center text-center my-12">
				<div class="container mx-8 my-auto">
					<h1 class="text-6xl font-bold my-2">ᴺᵒᵗᵉᵈ!ᴸⁱˢᵗ!</h1>

					<?php
					if(!isset($_SESSION['username'])){
						echo "<p class='text-lg'>𝙰𝚗𝚍𝚊 𝚋𝚎𝚕𝚞𝚖 𝚕𝚘𝚐𝚒𝚗.</p>";
					}else{
						echo "<p class='text-lg'> 𝚂𝚎𝚕𝚊𝚖𝚊𝚝 𝙳𝚊𝚝𝚊𝚗𝚐, ".$_SESSION['username']."!</p>";
					}
					?>
						</br>
						</br>

					<div class="bg-white p-8 rounded shadow-md w-96 mx-auto text-center">
						<h1 class="text-2xl font-semibold mb-6">𝚕𝚘𝚐𝚒𝚗</h1>
						<form action="loginprocess.php" method="post" onsubmit="return validateForm();">
									<div class="mb-4">
										<label for="username" class="block text-gray-700">𝚄𝚜𝚎𝚛𝚗𝚊𝚖𝚎:</label>
										<input type="text" id="username" name="username" class="w-full border border-gray-300 rounded px-3 py-2" />
									</div>
									<div class="mb-4">
										<label for="password" class="block text-gray-700">𝙿𝚊𝚜𝚜𝚠𝚘𝚛𝚍:</label>
										<input type="password" id="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2" />
									</div>
									<button
										type="submit"
										class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300 ease-in-out">
										𝚕𝚘𝚐𝚒𝚗
									</button>
									<input type="hidden" name="mode" value="verify">
						</form>
						<div class="mt-4 text-center">
							<p>
							𝚃𝚒𝚍𝚊𝚔 𝚙𝚞𝚗𝚢𝚊 𝚊𝚔𝚞𝚗?
								<a href="register.php" class="text-blue-500 hover:underline">𝚁𝚎𝚐𝚒𝚜𝚝𝚎𝚛!</a>
							</p>
						</div>
				</div>

			</div>
			<script>
			function validateForm() {
				var username = document.getElementById("username").value;
				var password = document.getElementById("password").value;
				
				if (username === "" || password === "") {
					alert("Please fill out all fields.");
					return false;
				}
				
				return true;
			}
		</script>

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
		</script>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</body>
</html>
