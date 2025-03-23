<?php
include 'db.php';

//session_start();

try {
    // Get the user ID from the session
    //$userId = $_SESSION['user_id'];
    $userId=1;

    // Prepare and execute the query
    $query = "SELECT * FROM book WHERE lender_id = ?;"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    // Get the result set from the prepared statement
    $result = $stmt->get_result();

    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

    // Fetch all results
    $rentals = [];
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "</tr>";
    }


    // Free result set
    $result->free();

    // Close connection
    $conn->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} 
?>