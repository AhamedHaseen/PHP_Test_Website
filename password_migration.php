<?php
// Migration script to convert SHA1 passwords to bcrypt
require_once 'config.php';

echo "<h2>Password Migration Script</h2>";
echo "<p>This script will identify and help migrate SHA1 passwords to bcrypt.</p>";

try {
    // Get all users
    $stmt = $db->prepare("SELECT id, email, password FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Analysis Results:</h3>";
    
    $sha1Count = 0;
    $bcryptCount = 0;
    
    foreach ($users as $user) {
        $passwordLength = strlen($user['password']);
        
        // SHA1 hashes are always 40 characters
        // bcrypt hashes start with $2y$ and are ~60 characters
        if ($passwordLength === 40) {
            $sha1Count++;
            echo "User ID {$user['id']} ({$user['email']}): SHA1 hash detected<br>";
        } elseif (substr($user['password'], 0, 4) === '$2y$') {
            $bcryptCount++;
            echo "User ID {$user['id']} ({$user['email']}): bcrypt hash (secure)<br>";
        } else {
            echo "User ID {$user['id']} ({$user['email']}): Unknown hash format<br>";
        }
    }
    
    echo "<br><strong>Summary:</strong><br>";
    echo "- SHA1 passwords (need migration): {$sha1Count}<br>";
    echo "- bcrypt passwords (secure): {$bcryptCount}<br>";
    
    if ($sha1Count > 0) {
        echo "<br><p style='color: orange;'><strong>Note:</strong> Users with SHA1 passwords will be automatically migrated to bcrypt when they next login successfully.</p>";
    }
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}
h2, h3 {
    color: #333;
}
p {
    color: #666;
}
</style>
