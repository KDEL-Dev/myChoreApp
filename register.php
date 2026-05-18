<?php

    // Debug
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    // This is so that when user inputs wrong information, it won't wipe all entire page and
    // make them start again.
    // This is why I need session start on this page specifically
    session_start();
    
    // Pull in your database connection details
    require_once 'includes/conn.php';       
    
    // Check if the user actually clicked the submit button
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        
        // 4. Grab data from the form and sanitize it by trimming extra spaces
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirmPassword']);

        // --- PHASE 2: VALIDATION LOGIC GOES HERE ---
        
        if(empty($name) || empty($email) || empty($password) || empty($confirmPassword))
        {
            $_SESSION['error'] = "All fields are required";
            header("Location: register.php");
            exit();    
        }
    
        // password validation

        if(strlen($password) < 6 )
        {
            $_SESSION['error'] = "Password must be at least 6 characters long.";
            header("Location: register.php");
            exit();
        }

        if($password !== $confirmPassword)
        {
            $_SESSION['error'] = "Your passwords do not match";
            header("Location: register.php");
            exit();
        }

        $check_email = "
            SELECT email
            FROM users
            WHERE email = ?
        ";
        $stmt = mysqli_prepare($conn, $check_email);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0)
        {
            $_SESSION['error'] = "This email is already registered.";
            header("Location: register.php");
            exit();
        }

        // Once everything is good, send info to the databse.

        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into your users table
        $insert_query = "
            INSERT INTO users (name, email, password) 
            VALUES (?, ?, ?)
        ";

        $insert_stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "sss", $name, $email, $hashed_password);

        if (mysqli_stmt_execute($insert_stmt)) {
            // Log them in automatically via the session!
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['logged_in'] = true;
            
            // Send them right into the main application dashboard
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Something went wrong on our database server. Please try again.";
            header("Location: register.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/stylesheet/styles.css">

    <title>Registration</title>
</head>
<body>
    <button>
        <a href="login.php">Return</a>
    </button>
    <!-- Error Message -->
    <?php
        if(isset($_SESSION['error'])): ?>
            <div>
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>  
            </div>
    <?php endif ?>

    <form method="POST" action="register.php" id="registerationForm">
        <div>
            <label for="name">Name:</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                placeholder="Albert" 
                required 
                autofocus
            >
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="abc123@example.com" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input 
                type="password" 
                name="password" 
                minlength="6" 
                required
            >
        </div>
        <div>
            <label for="confirmPassword">Confirm Password:</label>
            <input 
                type="password" 
                name="confirmPassword" 
                minlength="6" 
                required
            >
        </div>
        <div>Password must be atleast <span id="passwordMinNum">6</span> characters long</div>

        <button type="submit">Register</button>

    </form>
    <!-- Javascript -->
    <script src="assets/js/script.js"></script>
</body>
</html>