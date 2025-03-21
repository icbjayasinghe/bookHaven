<?php
// Include database connection
include './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve signup data
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $status = "Active"; 

    // Password encryption
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Validate input
    if (empty($firstname) || empty($lastname) || empty($email) || empty($hashed_password) || empty($status)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare SQL query
    $sql = "INSERT INTO user (email, first_name, last_name, status, password) values (?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);

   

    if ($stmt) {
        $stmt->bind_param('sssss', $email, $firstname, $lastname, $status, $hashed_password);
        print_r("hello ");

        // Execute query
        if ($stmt->execute()) {
            echo "<div style='color: green;'>User added successfully..</div>";

            // echo "";
        } else {
            print_r("Error");

            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close database connection
    $conn->close();
    header("Location: index.html");
}
?>