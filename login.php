<?php
session_start();
require_once 'config.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-10">
            <div class="registration-container">
                <div class="form-header">
                    <h1><i class="fas fa-sign-in-alt"></i> User Login</h1>
                    <p>Please enter your credentials to access your account</p>
                </div>
                
                <form id="loginForm" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="email">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input class="form-control" type="password" id="password" name="password" required>
                    </div>

                    <hr class="divider">

                    <button class="btn btn-register" type="submit" id="login" name="login">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>
                
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="registration.php" class="text-decoration-none">Create one here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
$(function(){
    // Handle form submission
    $("#loginForm").on("submit", function(e){
        e.preventDefault(); // Prevent form submission immediately
        
        var valid = this.checkValidity();
        
        if (valid) {
            // Get the values from the input fields
            var email = $("#email").val();
            var password = $("#password").val();

            // Disable the submit button to prevent multiple submissions
            $("#login").prop('disabled', true).text('Signing in...');

            $.ajax({
                type: "POST",
                url: "login_process.php",
                data: {
                    email: email,
                    password: password
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Login successful. Welcome back!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Redirect to index.php after successful login
                            window.location.href = 'index.php';
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message || 'Invalid email or password.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error details:', xhr.responseText);
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error while logging in. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                },
                complete: function() {
                    // Re-enable the submit button
                    $("#login").prop('disabled', false).html('<i class="fas fa-sign-in-alt"></i> Login');
                }
            });
        } else {
            // If form is not valid, show validation messages
            this.reportValidity();
        }
    });
});
</script>
</body>
</html>
