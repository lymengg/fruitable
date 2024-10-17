<?php
session_start();

if (empty($_SESSION['logged_in']) || empty($_SESSION['roles'])) {
    header("Location: /fruitable/index.php");
    exit;
}

if (!in_array("ADMIN", $_SESSION['roles'])) {
    header("Location: /fruitable/index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <?php
    require_once('../fruitable/pages/layouts/style.php')
    ?>
    <style>
        #createProduct {
            width: 400px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class=" container h-100 d-flex align-items-center justify-content-center">
        <form id="create_product">
            <input type="text" name="form_name" hidden value="create_product_form">
            <div class="h4">
                <h1 class="text-primary display-6 text-center">Fruitables</h1>
            </div>
            <div class="border p-4">
                <p class="text-center font-weight-bold">Create Product</p>
                <div class="form-group mb-3">
                    <div class="alert alert-danger" role="alert" id="errorAlert">
                        <span></span>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                </div>
                <div class="form-group mb-3">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price">
                </div>
                <?php
                define('__ROOT__', dirname(dirname(__FILE__)));
                require('./classes/Database.php');

                $mydb = Database::getConnection();
                $result = mysqli_query($mydb, "SELECT * FROM category");
                $data = $result->fetch_all(MYSQLI_ASSOC);
                ?>
                <select class="form-select mb-3" name="category_id">
                    <option selected>Select Category Name</option>
                    <?php foreach ($data as $row): ?>
                        <option value="<?= htmlspecialchars($row['category_id']) ?>"><?= htmlspecialchars($row['category_name']) ?></option>
                    <?php endforeach ?>
                </select>
                <div class="form-group mb-3">
                    <label for="product_image" class="form-label">Product Image</label>
                    <input class="form-control" type="file" id="product_image" name="product_image">
                </div>
                <button type="submit" class="btn btn-primary text-white w-100 mb-2">Create Product</button>
                <button type="button" class="btn btn-outline-info w-100 mb-1" onclick="redirectToHomePage()">Back</button>
            </div>
        </form>
    </div>

    <?php
    require_once("./pages/layouts/script.php");
    ?>
    <script>
        $(document).ready(function() {

            const errorAlert = $("#errorAlert");
            const errorMessage = errorAlert.find('span');
            const registerInputs = $("input");

            errorAlert.hide();

            $('#create_product').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: '/fruitable/server/process.php',
                    data: formData,
                    contentType: false,
                    processData: false,
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

        const redirectToHomePage = () => {
            window.location.href = "/fruitable/index.php";
        }
    </script>
</body>

</html>