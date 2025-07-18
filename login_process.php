<?php
session_start();
require_once 'config.php';

// Set content type to JSON
header('Content-Type: application/json');

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Get POST data
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validate input
if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required']);
    exit();
}

try {
    // Check if user exists with the provided email
    $stmt = $db->prepare("SELECT id, firstname, lastname, email, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verify password - handle both bcrypt and legacy SHA1
        $passwordValid = false;
        
        // First, try bcrypt verification (new method)
        if (password_verify($password, $user['password'])) {
            $passwordValid = true;
        } 
        // If bcrypt fails, try SHA1 (legacy method)
        else if (sha1($password) === $user['password']) {
            $passwordValid = true;
            
            // Update to bcrypt hash for security
            $newHashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $updatePasswordStmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
            $updatePasswordStmt->bindParam(':password', $newHashedPassword);
            $updatePasswordStmt->bindParam(':id', $user['id']);
            $updatePasswordStmt->execute();
        }
        
        if ($passwordValid) {
            // Password is correct, start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_firstname'] = $user['firstname'];
            $_SESSION['user_lastname'] = $user['lastname'];
            $_SESSION['logged_in'] = true;
            
            // Update last login time (optional)
            $updateStmt = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = :id");
            $updateStmt->bindParam(':id', $user['id']);
            $updateStmt->execute();
            
            echo json_encode([
                'success' => true, 
                'message' => 'Login successful',
                'user' => [
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'email' => $user['email']
                ]
            ]);
        } else {
            // Password is incorrect
            echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
        }
    } else {
        // User doesn't exist
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
    
} catch (PDOException $e) {
    // Database error
    error_log("Login error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
}
?>
