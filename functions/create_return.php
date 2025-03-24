<?php
// Include database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    //$book_id = isset($_POST['book_id']) ? trim($_POST['book_id']) : '';
    $borrow_id = isset($_POST['borrow_id']) ? trim($_POST['borrow_id']) : '';
    //$book_status = "Unavailable";
    $borrow_status = 'Ready';
 
    // Validate input
    if (empty($borrow_id) || empty($borrow_status)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare SQL query
    $sql_update = "UPDATE borrow SET status = ? WHERE borrow_id = ?;";
    $stmt_update = $conn->prepare($sql_update);

    if ($stmt_update) {
        $stmt_update->bind_param('si', $borrow_status, $borrow_id);

        // Execute query
        if ($stmt_update->execute()) {
            echo "<div style='color: green;'>Return request sent successfully..</div>";
        } else {
            echo "Error: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close database connection
    $conn->close();
    //header("Location: rental_requests.php");
}
?>