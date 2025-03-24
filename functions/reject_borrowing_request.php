<?php
// Include database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $book_id = isset($_POST['book_id']) ? trim($_POST['book_id']) : '';
    $borrow_id = isset($_POST['borrow_id']) ? trim($_POST['borrow_id']) : '';
    $book_status = "Available";
    $borrow_status = "Rejected";
 
    // Validate input
    if (empty($book_id) || empty($borrow_id) || empty($book_status) || empty($borrow_status)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare SQL query
    $sql_br_update = "UPDATE borrow SET status = ? WHERE borrow_id = ?;";
    $stmt_br = $conn->prepare($sql_br_update);

    $sql_b_update = "UPDATE book SET status = ? WHERE book_id = ?;";
    $stmt_b = $conn->prepare($sql_b_update);

    if ($stmt_br && $stmt_b) {
        $stmt_br->bind_param('si', $borrow_status, $borrow_id);
        $stmt_b->bind_param('si', $book_status, $book_id);

        // Execute query
        if ($stmt_br->execute() && $stmt_b->execute()) {
            echo "<div style='color: green;'>Book made available successfully..</div>";
        } else {
            echo "Error: " . $stmt_br->error . "<br>" . $stmt_b->error;
        }

        $stmt_br->close();
        $stmt_b->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close database connection
    $conn->close();
    // header("Location: borrowing.php");
}
?>