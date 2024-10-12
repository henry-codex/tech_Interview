<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $pwd = trim($_POST['pwd']);
    
    // Basic validation
    if (empty($username) || empty($pwd)) {
        echo "Please fill in all fields";
    } else {
        try {
            // Hash the password
            $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
            
            // Prepare SQL and bind parameters
            $sql = "INSERT INTO users (username, pwd) VALUES (:username, :pwd)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pwd', $hashed_pwd);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Something went wrong. Please try again.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "Username already exists. Please choose a different one.";
            } else {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
?>