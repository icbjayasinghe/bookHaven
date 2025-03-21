<?php
include './db.php';

try {
    // Replace PDO with MySQLi              
    $query = "SELECT * FROM book b inner join genre g on b.genre_id = g.genre_id";
    $result = $conn->query($query);

    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

    // Fetch all results
    $rentals = [];
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-genre=" . $row['genre_id'] . ">";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['genre_name'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo " <td><button>Borrow</button></td>";
        echo "</tr>";

        
    }


    // Free result set
    $result->free();

    // Close connection
    $conn->close();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Handle database connection errors
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
}   
?>