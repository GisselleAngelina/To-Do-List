<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<title>To-Do | Register</title>
		<script src="https://cdn.tailwindcss.com"></script>
	</head>

	<body>
	
	<nav class="bg-gray-700 text-white p-4 w-full">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center">
            <img src="assets/ikon lab.png" alt="To-Do Icon" class="w-10 h-10 mr-2">
            <div class="text-xl font-semibold">🅽🅾🆃🅴🅳!</div>
        </div>

    </div>
</nav>

	<div class="bg-gray-100 min-h-screen flex items-center justify-center">
		
	
	
		<div class="bg-white p-8 rounded shadow-md w-96 mx-auto text-center">
			
			<h1 class="text-2xl font-semibold mb-6">Register</h1>
			<form action="loginprocess.php" method="post" onsubmit="return validateForm();">
				<div class="mb-4">
					<label for="username" class="block text-gray-700">Username:</label>
					<input type="text" id="username" name="username" class="w-full border border-gray-300 rounded px-3 py-2" />
				</div>
				<div class="mb-4">
					<label for="password" class="block text-gray-700">Password:</label>
					<input type="password" id="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2" />
				</div>
				<button
					type="submit"
					class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300 ease-in-out mx-auto">
					Register
				</button>

				<input type="hidden" name="mode" value="register">
			</form>
			<div class="mt-4 text-center">
				<p>
					Sudah punya akun?
					<a href="index.php" class="text-blue-500 hover:underline">Login!</a>
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
	</body>
</html>
