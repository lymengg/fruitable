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
        body {
            height: 100vh;
        }

        #loginForm {
            width: 400px;
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="container h-100 d-flex align-items-center justify-content-center">
        <form id="loginForm">
            <input type="text" name="form_name" hidden value="login_form">
            <?php
            $redirect_url = "";
            if (isset($_GET['redirect_url'])) {
                $redirect_url = $_GET['redirect_url'];
                echo "<input type='text' name='redirect_url' hidden value='$redirect_url'>";
            }
            ?>
            <div class="h4">
                <h1 class="text-primary display-6 text-center">Fruitables</h1>
                <p class="text-center text-small fs-6">Sign in to your account</p>
            </div>
            <div class="border p-4">
                <br>
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>
                <button type="submit" class="btn btn-primary text-white w-100 mb-1">Submit</button>
                <p class="text-center fs-6">Do not have an account? <a href="/fruitable/register.php" class="text-primary">Sign up</a></p>
                <br>
            </div>
        </form>
    </div>
    <?php
    require_once("./pages/layouts/script.php")
    ?>
    <script>
        $(document).ready(function() {

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                const formData = $(this).serialize();

                $.ajax({
                    url: '/fruitable/server/process.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        const jsonResponse = JSON.parse(response);
                        if (jsonResponse.redirect_url != '') {
                            window.location.href = jsonResponse.redirect_url;
                        } else {
                            toastr['error']("Invalid Username or Password");
                        }
                    },
                    error: function() {
                        toastr['error']("Something went wrong, unable to login!");
                    }
                })
            })

        })
    </script>
</body>

</html>