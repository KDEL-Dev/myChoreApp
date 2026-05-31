<?php
    //  Start the session
    session_start();

    // bring in database connection details
    require_once 'includes/conn.php';

    // create variable to hold name coming from form
    $household_name = '';

    // validation - ADD THIS NEXT!!!!!!!'

    // Tried using PDO Method but I think my conn.php is setup in a way

    if ($_SERVER['REQUEST_METHOD'] === 'POST') //Needed to add this because code was activating when I open page instead of when form was submitted.
    {
        // Get the data from the form and remove spaces
        $household_name = trim($_POST['household_name']);

        // 1. Prepare the query using the connection object
        $insert_query = "INSERT INTO households(name) VALUES (?)";
        $stmt = $conn->prepare($insert_query);

        // 2. Bind the parameter directly on the statement object
        // "s" means string, "i" means integer, "d" means double/float
        $stmt->bind_param("s", $household_name);

        // 3. Execute
        $stmt->execute();
        $stmt->close();
        
        echo "Done! Household created";
        header("Location: new_household.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/stylesheet/output.css">
    <title>New Household - Chore Check</title>
</head>
<body class="min-h-screen flex flex-col">
    
    <header class="h-16 bg-sky-300">
        <!-- Logo and Profile will go here -->
    </header>

    <main class="flex-1 px-4 w-full flex justify-center items-center">
        
        <section class="p-5 w-full max-w-md bg-sky-300 rounded-xl shadow-lg/20">
            <h1 class="text-white text-2xl text-center">Create New Household:</h1>
            
            <section class="w-full my-6">
                <form method="post" action="new_household.php">
                    <div class="flex flex-col">
                        <label for="household_name" class="text-white text-xl text-center font-bold mb-2">Household Name:</label>
                        <input type="text"
                               id="household_name"
                               name="household_name"
                               class="w-full bg-white border border-gray-300 rounded px-3 py-2"
                               autofocus>
                        <!-- Try again to add animation to button below -->
                         <button type="submit" class="mt-5 p-4 bg-lime-500 border-2 border-white rounded-xl text-white text-lg font-semibold">Create</button>
                    </div>
                </form>
            </section>
        </section>

    </main>
</body>
</html>
