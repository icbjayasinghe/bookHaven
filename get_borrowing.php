<?php
include './db.php';

try {           
    $query = "SELECT * FROM book b inner join genre g on b.genre_id = g.genre_id";
    $result = $conn->query($query);

    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

    // Fetch all results
    $rentals = [];
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-genre=" . $row['genre_name'] . ">";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['genre_name'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        // echo " <td><a class="btn btn-primary" href="borrowing.php?book_id=' . $row['book_id'] . '" role="button">Borrow</a></td>";
        echo " <td> <a class='btn btn-primary' href='borrowing.php?book_id= ".$row['book_id']."' >Borrow</a> </td>";
        // echo " <td><button>Borrow</button></td>";
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