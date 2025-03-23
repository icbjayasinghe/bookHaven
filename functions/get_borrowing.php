<?php
include 'db.php';

try {    
    $userId= $_POST['user_id'];       
    $query = "SELECT * FROM book b 
    inner join genre g on b.genre_id = g.genre_id WHERE status = 'Available' and b.lender_id != ? 
    ORDER BY title ASC";
    // $result = $conn->query($query);

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
        echo "<tr data-genre=" . $row['genre_name'] . " id=" . $row['book_id'] . ">";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['genre_name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo " <td> <button onclick='confAlert(".$row['book_id'].")'>Borrow</button> </td>";
        echo "</tr>";    
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