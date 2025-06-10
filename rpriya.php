<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = ""; // Default in XAMPP is empty
$dbname = "test_db";

// Create connection
$conn = new mysqli($host, $user, $password);

// Check connection to MySQL server
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbname' created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Connect to the newly created database
$conn->select_db($dbname);

// Create a sample table
$tableSql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
)";
if ($conn->query($tableSql) === TRUE) {
    echo "Table 'users' created or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// Insert sample data
$insertSql = "INSERT INTO users (name, email) VALUES 
    ('Alice', 'alice@example.com'),
    ('Bob', 'bob@example.com')";

if ($conn->query($insertSql) === TRUE) {
    echo "Sample users inserted.<br>";
} else {
    echo "Sample data already exists or error inserting data: " . $conn->error . "<br>";
}

// Display all users
$result = $conn->query("SELECT * FROM users");
if ($result->num_rows > 0) {
    echo "<h3>User List:</h3><ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["name"] . " (" . $row["email"] . ")</li>";
    }
    echo "</ul>";
} else {
    echo "No users found.";
}

// Close connection
$conn->close();
?>
