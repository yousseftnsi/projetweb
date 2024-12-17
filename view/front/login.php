<?php
// Start session and connect to the database
session_start();
require_once '../../config.php';

// Check if the user is already logged in
if (isset($_SESSION['id_user'])) {
    header("Location: panier.php");
    exit();
}

// Initialize error message
$error_message = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Validate input
    if (empty($id_user) || empty($name) || empty($password)) {
        $error_message = "All fields are required.";
    } else {
        // Check credentials in the database
        $conn = config::getConnexion();
        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE id = ? AND nom = ? AND mdp = ?");
        $stmt->execute([$id_user, $name, $password]);
        $user = $stmt->fetch();

        if ($user) {
            // Store user information in session
            $_SESSION['id_user'] = $user['id'];
            $_SESSION['name_user'] = $user['nom'];

            // Redirect to panier.php
            header("Location: panier.php");
            exit();
        } else {
            $error_message = "Invalid credentials. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grow&Glow</title>
    <style>
        /* Basic styling for centering the form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Title style */
        h1 {
            color: green;
            font-weight: bold;
        }

        /* Form container */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin: 5px 0;
        }

        button {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Grow&Glow</h1>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form id="loginForm" action="" method="POST">
            <div>
                <input type="text" id="id_user" name="id_user" placeholder="Enter User ID" >
                <div id="id_user_error" class="error-message"></div>
            </div>
            <div>
                <input type="text" id="name" name="name" placeholder="Enter Name" >
                <div id="name_error" class="error-message"></div>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Enter Password" >
                <div id="password_error" class="error-message"></div>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        // JavaScript for form validation
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            let valid = true;
            const idUser = document.getElementById("id_user").value.trim();
            const name = document.getElementById("name").value.trim();
            const password = document.getElementById("password").value.trim();

            // Clear previous error messages
            document.getElementById("id_user_error").textContent = "";
            document.getElementById("name_error").textContent = "";
            document.getElementById("password_error").textContent = "";

            // Validate ID User
            if (idUser === "") {
                document.getElementById("id_user_error").textContent = "User ID is required.";
                valid = false;
            }

            // Validate Name
            if (name === "") {
                document.getElementById("name_error").textContent = "Name is required.";
                valid = false;
            }

            // Validate Password
            if (password === "") {
                document.getElementById("password_error").textContent = "Password is required.";
                valid = false;
            }

            if (!valid) {
                event.preventDefault();  // Prevent form submission if validation fails
            }
        });
    </script>
    
</body>
</html>
