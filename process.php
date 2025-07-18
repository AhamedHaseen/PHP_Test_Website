<?php

require_once 'config.php';

?>

<?php
   if(isset($_POST)){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phonenumber = $_POST['phonenumber'];
            $password = sha1($_POST['password']); // Hashing the password for security

            $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password) VALUES (?, ?, ?, ?, ?)";            
            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $password]);
            if($result){
                echo "User registration successful!";
            } else {
                echo "There was an error while registering the user.";
            }

            #echo $firstname . " " . $lastname . " " . $email . " " . $phonenumber . " " . $password;

            // Here you can add code to insert the data into a database or perform other actions
        }else {
            echo "No data received.";
        }
