<?php
include './db.php';

try {

    // Replace PDO with MySQLi
    $query = "SELECT * FROM book";
    $result = $conn->query($query);

    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

    // Fetch all results
    $rentals = [];
    while ($row = $result->fetch_assoc()) {
        $rentals[] = $row;
    }

    print_r($rentals);


    // Free result set
    $result->free();

    // Close connection
    $conn->close();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    header(l)
    

    // Query to fetch rental data
    // $query = "SELECT * FROM rentals";
    // $stmt = $pdo->prepare($query);
    // $stmt->execute();

    // // Fetch all results
    // $rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // // Return data as JSON
    // header('Content-Type: application/json');
    // echo json_encode($rentals);

} catch (PDOException $e) {
    // Handle database connection errors
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
}
?>