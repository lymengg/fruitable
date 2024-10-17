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
    require_once('pages/layouts/style.php');
    ?>
</head>

<body>


    <!-- Header Section -->
    <?php
    require_once("pages/layouts/header.php");
    ?>


    <!-- Featurs Section Start -->
    <?php
    require_once("pages/layouts/feature-section.php");
    ?>
    <!-- Featurs Section End -->


    <!-- Fruits Shop Start-->
    <?php
    require_once("pages/layouts/fruit-shop.php");
    ?>
    <!-- Fruits Shop End-->


    <!-- Featurs Start -->
    <?php
    require_once("pages/layouts/features.php");
    ?>
    <!-- Featurs End -->


    <!-- Vesitable Shop Start-->
    <?php
    require_once("pages/layouts/vesitable-shop.php");
    ?>
    <!-- Vesitable Shop End -->


    <!-- Banner Section Start-->
    <?php
    require_once("pages/layouts/banner.php");
    ?>
    <!-- Banner Section End -->


    <!-- Bestsaler Product Start -->
    <?php
    require_once("pages/layouts/best-seller.php");
    ?>
    <!-- Bestsaler Product End -->


    <!-- Fact Start -->
    <?php
    require_once("pages/layouts/fact.php");
    ?>
    <!-- Fact Start -->


    <!-- Tastimonial Start -->
    <?php
    require_once("pages/layouts/testimonial.php");
    ?>
    <!-- Tastimonial End -->


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