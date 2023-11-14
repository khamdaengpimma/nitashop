<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
require("../db.php");
$data = json_decode(file_get_contents("php://input"));
try {
        // Prepare SQL statement
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            return true; // Authentication successful
        } else {
            return false; // Authentication failed
        }
} catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
// Example usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming form fields are named 'username' and 'password'
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticateUser($username, $password, $conn)) {
        echo "Login successful!";
        // Redirect to the dashboard or home page
        // header("Location: dashboard.php");
    } else {
        echo "Login failed. Invalid username or password.";
    }
}
// Close the database connection
?>