<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="login.php">
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" id="login_email" placeholder="email">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password">
        </div>
        <button type="submit">Log In</button>
    </form>

    <section>
        <p>Register here if you don't have an account</p>
        <button>
            <a href="register.php">Register</a>
        </button>
    </section>
</body>
</html>