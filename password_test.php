<?php
// Test file to verify password hashing and verification
require_once 'config.php';

// Test password
$testPassword = "test123";

// Test bcrypt hashing
$bcryptHash = password_hash($testPassword, PASSWORD_DEFAULT);
echo "Original password: " . $testPassword . "<br>";
echo "Bcrypt hash: " . $bcryptHash . "<br>";
echo "Bcrypt verification: " . (password_verify($testPassword, $bcryptHash) ? "PASS" : "FAIL") . "<br><br>";

// Test SHA1 hashing (legacy)
$sha1Hash = sha1($testPassword);
echo "SHA1 hash: " . $sha1Hash . "<br>";
echo "SHA1 verification: " . (sha1($testPassword) === $sha1Hash ? "PASS" : "FAIL") . "<br><br>";

// Test mixed verification (what our login system does)
echo "Mixed verification test:<br>";
echo "- Bcrypt against bcrypt: " . (password_verify($testPassword, $bcryptHash) ? "PASS" : "FAIL") . "<br>";
echo "- SHA1 against SHA1: " . (sha1($testPassword) === $sha1Hash ? "PASS" : "FAIL") . "<br>";
echo "- Bcrypt against SHA1: " . (password_verify($testPassword, $sha1Hash) ? "PASS" : "FAIL") . "<br>";
echo "- SHA1 against bcrypt: " . (sha1($testPassword) === $bcryptHash ? "PASS" : "FAIL") . "<br>";
?>
