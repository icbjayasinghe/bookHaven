<?php
include './db.php';

try {

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get the posted data
    $email = $_POST['username'];
    $password = $_POST['password'];
    
    // Password encryption
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

    // Get the result set from the prepared statement
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $dbpassword = $data['password'];

    // Check if the password is correct
    if(password_verify($password, $dbpassword)){
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['email'] = $email;
        echo json_encode(['success' => true, 'user_id' => $data['user_id']]);
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