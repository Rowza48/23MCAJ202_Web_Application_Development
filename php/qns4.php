<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = ""; // replace with your DB password
$database = "test_db";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$sql = "SELECT id, name, position, salary FROM employees";
$result = $conn->query($sql);

// Display results in a formatted HTML table
if ($result->num_rows > 0) {
    echo "<h2>Employee Details</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Position</th><th>Salary</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["position"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["salary"]) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();
?>
