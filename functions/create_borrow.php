<?php
// Include database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $author = isset($_POST['author']) ? trim($_POST['author']) : '';
    $genre = isset($_POST['genre']) ? trim($_POST['genre']) : '';
    // $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $lender_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
    $status = "Available"; 

    // Validate input
    if (empty($title) || empty($author) || empty($genre) || empty($lender_id)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare SQL query
    $sql = "INSERT INTO book (title, author, status, genre_id, lender_id) values (?, ?, ?, ?, ?);";
    // $sql = "INSERT INTO books (title, author, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

   

    if ($stmt) {
        $stmt->bind_param('sssii', $title, $author, $status, $genre, $lender_id);

        // Execute query
        if ($stmt->execute()) {
            echo "<div style='color: green;'>Book added successfully..</div>";

            // echo "";
        } else {

            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close database connection
    $conn->close();
    header("Location: add_new_rentals.php");
}
?>