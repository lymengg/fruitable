<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <?php
    require_once('pages/layouts/style.php');
    ?>
    <style>
        #registerForm {
            width: 400px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class=" container h-100 d-flex align-items-center justify-content-center">
        <form id="registerForm">
            <input type="text" name="form_name" hidden value="register_form">
            <div class="h4">
                <h1 class="text-primary display-6 text-center">Fruitables</h1>
            </div>
            <div class="border p-4">
                <p class="text-center font-weight-bold">Sign Up</p>
                <div class="form-group mb-3">
                    <div class="alert alert-danger" role="alert" id="errorAlert">
                        <span></span>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>
                <div class="form-group mb-3">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder=" Enter Confirm Password">
                </div>
                <div class="form-group mb-3">
                    <label for="family_name">Family Name</label>
                    <input type="text" class="form-control" id="family_name" name="family_name" placeholder="Enter Family Name">
                </div>
                <div class="form-group mb-3">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                </div>
                <div class="form-group mb-3">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth">
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                </div>
                <button type="submit" class="btn btn-primary text-white w-100 mb-1">Submit</button>
                <p class="text-center fs-6">Do not have an account? <a href="#" class="text-primary">Sign up</a></p>
                <br>
            </div>
        </form>
    </div>

    <?php
    include("pages/layouts/script.php");
    ?>
    <script>
        $(document).ready(function() {

            const errorAlert = $("#errorAlert");
            const errorMessage = errorAlert.find('span');
            const registerInputs = $("input");

            errorAlert.hide();

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                const formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'http://localhost:81/php-projects/fruitable/server/process.php',
                    data: formData,
                    success: function(response) {
                        if (response !== 'Registration successful!') {
                            errorMessage.text(response);
                            errorAlert.show();
                        } else {
                            toastr["success"]("Registration successful!");
                            window.location.href = 'http://localhost:81/php-projects/fruitables/index.php';
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });

            registerInputs.change(function() {
                if (errorMessage.text()) {
                    errorMessage.text("");
                    errorAlert.hide();
                }
            })
        });
    </script>
</body>

</html>