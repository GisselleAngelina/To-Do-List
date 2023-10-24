<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			rel="icon"
			href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎯</text></svg>" />
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" />
		<title>To-Do | Add Task</title>
	</head>
	<body class="bg-gray-100 min-h-screen flex items-center justify-center">
		<div class="bg-white p-8 rounded shadow-md w-96">
			<h1 class="text-6xl font-semibold mb-6">ᴀᴅᴅ ᴛᴀꜱᴋ</h1>
			<form action="../process.php" method="post">
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

    <div class="mb-4">
        <label for="taskName" class="block text-gray-700">𝚃𝚊𝚜𝚔 𝙽𝚊𝚖𝚎:</label>
        <input
            type="text"
            id="taskName"
            name="title"
            class="w-full border border-gray-300 rounded px-3 py-2" />
    </div>
    <div class="mb-4">
        <label for="taskDescription" class="block text-gray-700"
            >𝚃𝚊𝚜𝚔 𝙳𝚎𝚜𝚌𝚛𝚒𝚙𝚝𝚒𝚘𝚗:</label
        >
        <textarea
            id="taskDescription"
            name="description"
            class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
    </div>
    <p class="text-l mb-2">𝙿𝚛𝚘𝚐𝚛𝚎𝚜𝚜</p>
    <select class="block w-1/2 p-1 border border-gray-400 rounded mb-4" name="progress">
        <option value="1">𝙸𝚗 𝙿𝚛𝚘𝚐𝚛𝚎𝚜𝚜</option>
        <option value="2" selected>𝙽𝚘𝚝 𝚈𝚎𝚝 𝚂𝚝𝚊𝚛𝚝𝚎𝚍</option>
        <option value="3">𝙳𝚘𝚗𝚎</option>
    </select>
    <input type="hidden" name="done" value="0">
    <input type="hidden" name="mode" value="add">
    <button
        type="submit"
        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300 ease-in-out">
        𝙰𝚍𝚍 𝚃𝚊𝚜𝚔
    </button>
</form>

			<a href="../list.php" class="mt-4 block text-blue-500 hover:underline"
				>𝙺𝚎𝚖𝚋𝚊𝚕𝚒 𝚔𝚎 𝙽𝚘𝚝𝚎𝚍 𝚕𝚒𝚜𝚝</a
			>
		</div>
	</body>
</html>
