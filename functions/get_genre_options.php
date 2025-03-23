<?php
include 'db.php';

try {           
    $query = "SELECT * FROM genre";
    $result = $conn->query($query);

    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

    // Fetch all results
    $genre = [];
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($row['genre_id']) . "'>" . htmlspecialchars($row['genre_name']) . "</option>";  
    }


    // Free result set
    $result->free();

    // Close connection
    $conn->close();

} catch (PDOException $e) {
    // Handle database connection errors
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
}   
?>