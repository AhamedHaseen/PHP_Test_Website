<?php

require_once 'config.php';

// Set content type to JSON
header('Content-Type: application/json');

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Check if POST data exists
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phonenumber']) && isset($_POST['password'])){
    
    // Get and sanitize POST data
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    $password = $_POST['password'];
    
    // Validate input
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phonenumber) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit();
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit();
    }
    
    try {
        // Check if email already exists
        $checkStmt = $db->prepare("SELECT id FROM users WHERE email = :email");
        $checkStmt->bindParam(':email', $email);
        $checkStmt->execute();
        
        if ($checkStmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'Email already exists']);
            exit();
        }
        
        // Hash the password using bcrypt (more secure than sha1)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password, created_at) VALUES (?, ?, ?, ?, ?, NOW())";            
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $hashedPassword]);
        
        if($result){
            echo json_encode(['success' => true, 'message' => 'User registration successful!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'There was an error while registering the user.']);
        }
        
    } catch (PDOException $e) {
        // Log the error and return a generic message
        error_log("Registration error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error occurred']);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'No data received or incomplete data']);
}

?>
