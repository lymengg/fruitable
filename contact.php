<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- styles-->
    <?php
    require_once('pages/shop/style.php');
    ?>
</head>

<body>

    <!-- Header -->
    <?php
    require_once("pages/layouts/header.php");
    ?>


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Contact</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Contact</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Contact Start -->
    <?php
    require_once("pages/contact/contact.php");
    ?>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php
    require_once("pages/layouts/footer.php");
    ?>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <?php
    require_once("pages/layouts/copy-right.php");
    ?>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <?php
    include("pages/layouts/script.php");
    ?>
</body>

</html>