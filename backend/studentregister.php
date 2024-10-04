<?php
include '../db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // Check if the fields are not empty
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Check if the email is valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO student (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $email);

            // Execute and check for success
            if ($stmt->execute()) {
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Registration Success</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            margin: 0;
                            background-color: #f4f4f4;
                        }
                        .popup {
                            text-align: center;
                            padding: 20px;
                            background-color: #fff;
                            border-radius: 8px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            animation: popup 0.5s ease-out;
                        }
                        @keyframes popup {
                            from { transform: scale(0.8); opacity: 0; }
                            to { transform: scale(1); opacity: 1; }
                        }
                        .blast {
                            color: #4CAF50;
                            font-size: 1.5em;
                            margin-bottom: 20px;
                            animation: blast-animation 1s ease-out;
                        }
                        @keyframes blast-animation {
                            0% { transform: scale(0.8); opacity: 0; }
                            100% { transform: scale(1.2); opacity: 1; }
                        }
                        .redirect-msg {
                            margin-top: 20px;
                            color: #333;
                            font-size: 1em;
                        }
                    </style>
                </head>
                <body>
                    <div class="popup">
                        <div class="blast">Congratulations!</div>
                        <p>You have registered successfully.</p>
                        <p class="redirect-msg">Redirecting you to the login page...</p>
                    </div>
                    <script>
                        setTimeout(function() {
                            window.location.href = "../index.html";
                        }, 3000);
                    </script>
                </body>
                </html>';
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Invalid email format!";
        }
    } else {
        echo "All fields are required!";
    }
}

// Close the connection
$conn->close();
?>
