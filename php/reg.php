<?php
// Initialize variables
$name = $email = $password = $confirm_password = $phone = "";
$name_err = $email_err = $password_err = $confirm_password_err = $phone_err = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate Name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Name is required.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // Validate Email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Validate Password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Password is required.";
    } elseif (strlen($_POST["password"]) < 6) {
        $password_err = "Password must be at least 6 characters.";
    } else {
        $password = $_POST["password"];
    }

    // Confirm Password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } elseif ($_POST["confirm_password"] !== $_POST["password"]) {
        $confirm_password_err = "Passwords do not match.";
    } else {
        $confirm_password = $_POST["confirm_password"];
    }

    // If no errors, process registration
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err)) {
        
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Normally, you would store these values in a database
        echo "<p style='color:green;'>Registration successful! </p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
             font-family: Arial, sans-serif; 
             padding: 20px;
             }
        .container { 
            max-width: 400px;
             margin: auto;
             }
        input { 
            width: 100%;
             padding: 8px;
              margin: 5px 0;
            }
        .error { color: red; }
    </style>
</head>
<body bgcolor="#FFB6C1">

<div class="container">
    <h2>Registration Form</h2>
    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br>

        <span class="error"><?= $name_err ?></span>

        <label>Email:</label>
        <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br>
        <span class="error"><?= $email_err ?></span>

        <label>Password:</label>
        <input type="password" name="password"><br>
        <span class="error"><?= $password_err ?></span>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password"><br>
        <span class="error"><?= $confirm_password_err ?></span>

    
        <br><br>
        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>