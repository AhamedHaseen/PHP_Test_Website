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
</head>
<body>

<div>
    <?php 
        
    ?>
</div>

    <div>
        <form action="registration.php" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                <h1>User Registration</h1>
                    <p>Please fill in this form to create an account.</p>
                <hr class="mb-3">
                    <label for="firstname">First Name:</label>
                    <input class="form-control" type="text" id="firstname" name="firstname" required>

                    <label for="lastname">Last Name:</label>
                    <input class="form-control" type="text" id="lastname" name="lastname" required>

                    <label for="email">Email:</label>
                    <input class="form-control" type="email" id="email" name="email" required>

                    <label for="phone">Phone Number:</label>
                    <input class="form-control" type="text" id="phonenumber" name="phonenumber" required>

                    <label for="password">Password:</label>
                    <input class="form-control" type="password" id="password" name="password" required>

                     <hr class="mb-3">

                    <input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up" >

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <!-- Jquery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script type="text/javascript">
        $(function(){
            $("#register").click(function(e){

                var valid = this.form.checkValidity();
                
                if (valid) {
                       // Get the values from the input fields
                    var firstname = $("#firstname").val();
                    var lastname = $("#lastname").val();
                    var email = $("#email").val();
                    var phonenumber = $("#phonenumber").val();
                    var password = $("#password").val();

                    e.preventDefault();


                    $.ajax({
                        type: "POST",
                        url: "process.php",
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phonenumber: phonenumber,
                            password: password
                        },
                        success: function(data) {
                            swal.fire({
                                title: 'Success!',
                                text: 'User registration successful.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        },
                        error: function(data) {
                            swal.fire({
                                title: 'Error!',
                                text: 'There was an error while registering the user.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }

                    });

                    //alert('true');
                }else {
                    //alert('false');
                }


             
            });
                        
        });
     </script>
</body>
</html>