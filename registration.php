<?php

require_once 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="registration-container">
                <div class="form-header">
                    <h1><i class="fas fa-user-plus"></i> User Registration</h1>
                    <p>Please fill in this form to create an account</p>
                </div>
                
                <form action="registration.php" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="firstname">
                            <i class="fas fa-user"></i> First Name
                        </label>
                        <input class="form-control" type="text" id="firstname" name="firstname" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="lastname">
                            <i class="fas fa-user"></i> Last Name
                        </label>
                        <input class="form-control" type="text" id="lastname" name="lastname" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">
                            <i class="fas fa-phone"></i> Phone Number
                        </label>
                        <input class="form-control" type="text" id="phonenumber" name="phonenumber" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input class="form-control" type="password" id="password" name="password" required>
                    </div>

                    <hr class="divider">

                    <button class="btn btn-register" type="submit" id="register" name="create">
                        <i class="fas fa-user-plus"></i> Create Account
                    </button>
                </form>
                
                <div class="text-center mt-3">
                    <p>Already have an account? <a href="login.php" class="text-decoration-none">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <!-- Jquery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script type="text/javascript">
        $(function(){
            // Handle form submission instead of button click
            $("form").on("submit", function(e){
                e.preventDefault(); // Prevent form submission immediately
                
                var valid = this.checkValidity();
                
                if (valid) {
                    // Get the values from the input fields
                    var firstname = $("#firstname").val();
                    var lastname = $("#lastname").val();
                    var email = $("#email").val();
                    var phonenumber = $("#phonenumber").val();
                    var password = $("#password").val();

                    // Disable the submit button to prevent multiple submissions
                    $("#register").prop('disabled', true).text('Processing...');

                    $.ajax({
                        type: "POST",
                        url: "process_new.php",
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phonenumber: phonenumber,
                            password: password
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'User registration successful.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Clear the form after successful registration
                                        $("form")[0].reset();
                                        // Optional: redirect to login page
                                        // window.location.href = 'login.php';
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message || 'There was an error while registering the user.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('Error details:', xhr.responseText);
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error while registering the user.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        },
                        complete: function() {
                            // Re-enable the submit button
                            $("#register").prop('disabled', false).html('<i class="fas fa-user-plus"></i> Create Account');
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