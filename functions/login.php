<?php
include './db.php';

try {
    print_r("hello");

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get the posted data
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Password encryption
    $hashed_password = password_hash($password, PASSWORD_;DEFAULT);

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = $WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();
    $dbpassword = $stmt->password;
    print_r($dbpassword);

    // Check if the password is correct
    if(password_verify($dbpassword, $hashed_password)){
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['email'] = $email;
        echo "Password verified";
    } else {
        echo "Password not verified";   

    }

    // Close connections
    $stmt->close();
    $conn->close();

    } catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
}
?>