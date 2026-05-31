<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/stylesheet/output.css">

    <title>Login - Chore Check</title>
</head>
<body class=" bg-sky-300">
    <section class="h-full flex justify-center items-center flex-col min-h-screen">
        <h1 class="mb-10 text-white text-6xl">Chore Check</h1>
        <form method="post" action="login.php" class="flex flex-col">
            <div class="flex flex-col">
                <label for="email" class="text-white text-xl">Email:</label>
                <input 
                type="text" 
                name="email" 
                id="login_email" 
                placeholder="email"
                class="w-80 bg-white border border-gray-300 rounded px-3 py-2"
                autofocus
                >
            </div>
            <div class="flex flex-col my-4">
                <label for="password" class="text-white text-xl">Password:</label>
                <input 
                type="password"
                placeholder="password"
                class="bg-white border border-gray-300 rounded px-3 py-2"
                >
            </div>
            <button 
                type="submit" 
                class="w-full px-4 py-2 mt-4 bg-lime-500 text-white rounded-full text-xl cursor-pointer
                <!-- Animation -->
                transition delay-100 duration-300 ease-in-out hover:scale-110 hover:bg-lime-400"
                >Log In
            </button>
        </form>

        <section class="mt-10 flex flex-col items-center">
            <p class="text-white">Don't have an account yet?
                <a href="register.php" class="font-bold underline ml-1">Sign Up</a> <!-- ml is margin left -->
            </p>
        </section>
    </section>
</body>
</html>