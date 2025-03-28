<?php
include 'db.php';

try {
    // Get the user ID from the session
    //$userId = $_SESSION['user_id'];
    $userId= $_POST['user_id'];

    // Prepare and execute the query
    $query = "SELECT br.*, b.author, b.title, b.lender_id,br.end_date,u.first_name,u.last_name  FROM borrow br 
    INNER JOIN book b ON br.book_id = b.book_id  
    INNER JOIN user u ON b.lender_id = u.user_id WHERE br.borrower_id = ?;";
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
        if ($row['end_date'] == null) {
            echo "<td>Not Set</td>";
        } else {
            echo "<td>" . (substr($row['end_date'], 0, 10)) . "</td>";
        }
        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
        // Display message or button based on status
        if ($row['status'] === 'Requested') {
            echo "<td>Pending Approval</td>";
        } elseif ($row['status'] === 'Rented') {
            echo "<td><button type='button' onclick='confAlert(". $row['borrow_id'].")'>Ready to Return</button></td>";
        } elseif ($row['status'] === 'Ready') {
            echo "<td>Return In Progress</td>";
        }
         else {
            echo "<td>" . $row['status'] . "</td>";
        }
        
        echo "</tr>";echo "</tr>";
    }


    // Free result set
    $result->free();

    // Close connection
    $conn->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} 
?>