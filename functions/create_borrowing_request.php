<?php
// Include database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $book_id = isset($_POST['book_id']) ? trim($_POST['book_id']) : '';
    $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
    $book_status = "Unavailable";
    $borrow_status = "Requested";
    // $borrowed_date = date("Y-m-d");
    // $return_date = date('Y-m-d', strtotime($borrowed_date. ' + 14 days')); 
    // $last_updated_date = date("Y-m-d");
 
    // Validate input
    if (empty($book_id) || empty($user_id) || empty($book_status) || empty($borrow_status)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare SQL query
    $sql = "INSERT INTO borrow (borrower_id, book_id, status) values (?, ?, ?);";
    $stmt = $conn->prepare($sql);

    $sql_update = "UPDATE book SET status = ? WHERE book_id = ?;";
    $stmt_update = $conn->prepare($sql_update);

    if ($stmt && $stmt_update) {
        $stmt->bind_param('iis', $user_id, $book_id, $borrow_status);
        $stmt_update->bind_param('si', $book_status, $book_id);

        // Execute query
        if ($stmt->execute() && $stmt_update->execute()) {
            echo "<div style='color: green;'>Book added successfully..</div>";
        } else {

            echo "Error: " . $stmt->error . "<br>" . $stmt_update->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close database connection
    $conn->close();
    // header("Location: borrowing.php");
}
?>