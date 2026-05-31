<?php
    // 1. Starts the session so we can store error messages across page reloads
    session_start();

    // Imports your database connection file
    require_once 'includes/conn.php';

    // We create an empty variable right here.
    // This is a placeholder that will temporarily hold the name the user types.
    $household_name = '';

    // Only run this block if the user clicked the "Create" button (POST request)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // Grab the input and trim spaces. 
        // We overwrite our empty variable with the actual text they typed.
        $household_name = trim($_POST['household_name']);

        // --- VALIDATION PHASE ---

        // Check 1: Did they leave it completely blank?
        if (empty($household_name)) 
        {
            // If empty, store a custom message into our session memory
            $_SESSION['error'] = "Household name cannot be empty.";
        }
        // Check 2: Is the name too long for the database column? (e.g., max 50 characters)
        // strlen() counts how many characters are in the text string
        elseif (strlen($household_name) > 50) 
        {
            $_SESSION['error'] = "Household name is too long (maximum 50 characters).";
        }

        // --- DATABASE PHASE ---
        // We ONLY execute the database code if our $_SESSION['error'] box is still completely empty!
        if (!isset($_SESSION['error'])) 
        {
            // Prepare the template
            $insert_query = "INSERT INTO households(name) VALUES (?)";
            $stmt = $conn->prepare($insert_query);

            // Bind the string parameter
            $stmt->bind_param("s", $household_name);

            // Execute query to save it to the database
            $stmt->execute();
            $stmt->close();
            
            // Redirect away to your dashboard because it succeeded!
            header("Location: index.php");
            exit(); 
        }
        
        // NOTE: If validation FAILS, PHP skips the database step and runs the HTML below.
        // Because we didn't redirect, the page reloads instantly, keeping the $household_name intact!
    }
?>