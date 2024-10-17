    <?php
    require_once('pages/layouts/style.php');
    ?>
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Our Organic Products</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 130px;">Vegetables</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 130px;">Fruits</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                    <span class="text-dark" style="width: 130px;">Bread</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                    <span class="text-dark" style="width: 130px;">Meat</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <form id="fruitShop">
                        <input type='hidden' name='form_name' value='add_to_cart_form'>
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">

                                        <?php


                                        define('__ROOT__', dirname(dirname(__FILE__)));
                                        require('./classes/Database.php');

                                        $mydb = Database::getConnection();
                                        $result = mysqli_query($mydb, "SELECT * FROM product");
                                        $data = $result->fetch_all(MYSQLI_ASSOC);
                                        ?>

                                        <?php foreach ($data as $row): ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="<?= htmlspecialchars($row["file_type"]) . "" .  htmlspecialchars(base64_encode($row["image"])) ?>" class="img-fluid w-100 rounded-top" style="height: 214px;" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                                        <?php

                                                        switch ($row["category_id"]) {
                                                            case 1:
                                                                echo "Vegetable";
                                                                break;
                                                            case 2:
                                                                echo "Fruit";
                                                                break;
                                                            case 3:
                                                                echo "Bread";
                                                                break;
                                                            case 4:
                                                                echo "Meat";
                                                                break;
                                                        }

                                                        ?>
                                                    </div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?= htmlspecialchars($row["product_name"]) ?></h4>
                                                        <p><?= htmlspecialchars($row["description"]) ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">$<?= htmlspecialchars($row["price"]) ?> / kg</p>
                                                            <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart(<?= htmlspecialchars($row['product_id']) ?>)"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <?php

                                        $vegatables = array_filter($data, function ($var) {
                                            return ($var['category_id'] == 1);
                                        });

                                        ?>
                                        <?php foreach ($vegatables as $row): ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="<?= htmlspecialchars($row["file_type"]) . "" .  htmlspecialchars(base64_encode($row["image"])) ?>" class="img-fluid w-100 rounded-top" style="height: 214px;" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Vegetable</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?= htmlspecialchars($row["product_name"]) ?></h4>
                                                        <p><?= htmlspecialchars($row["description"]) ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">$<?= htmlspecialchars($row["price"]) ?> / kg</p>
                                                            <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart(<?= htmlspecialchars($row['product_id']) ?>)"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <?php

                                        $fruits = array_filter($data, function ($var) {
                                            return ($var['category_id'] == 2);
                                        });

                                        ?>
                                        <?php foreach ($fruits as $row): ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="<?= htmlspecialchars($row["file_type"]) . "" .  htmlspecialchars(base64_encode($row["image"])) ?>" class="img-fluid w-100 rounded-top" style="height: 214px;" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?= htmlspecialchars($row["product_name"]) ?></h4>
                                                        <p><?= htmlspecialchars($row["description"]) ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">$<?= htmlspecialchars($row["price"]) ?> / kg</p>
                                                            <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart(<?= htmlspecialchars($row['product_id']) ?>)"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <?php

                                        $breads = array_filter($data, function ($var) {
                                            return ($var['category_id'] == 3);
                                        });

                                        ?>
                                        <?php foreach ($breads as $row): ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="<?= htmlspecialchars($row["file_type"]) . "" .  htmlspecialchars(base64_encode($row["image"])) ?>" class="img-fluid w-100 rounded-top" style="height: 214px;" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Breads</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?= htmlspecialchars($row["product_name"]) ?></h4>
                                                        <p><?= htmlspecialchars($row["description"]) ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">$<?= htmlspecialchars($row["price"]) ?> / kg</p>
                                                            <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart(<?= htmlspecialchars($row['product_id']) ?>)"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-5" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <?php

                                        $meats = array_filter($data, function ($var) {
                                            return ($var['category_id'] == 4);
                                        });

                                        ?>
                                        <?php foreach ($meats as $row): ?>
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="<?= htmlspecialchars($row["file_type"]) . "" .  htmlspecialchars(base64_encode($row["image"])) ?>" class="img-fluid w-100 rounded-top" style="height: 214px;" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Meats</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?= htmlspecialchars($row["product_name"]) ?></h4>
                                                        <p><?= htmlspecialchars($row["description"]) ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">$<?= htmlspecialchars($row["price"]) ?> / kg</p>
                                                            <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart(<?= htmlspecialchars($row['product_id']) ?>)"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('./pages/layouts/script.php') ?>
    <script>
        $(document).ready(function() {
            $('#fruitShop').on('submit', function(e) {
                e.preventDefault();

                const formData = $(this).serialize();
                console.log(formData)
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost:81/php-projects/fruitable/server/process.php',
                    data: formData,
                    success: function(response) {
                        console.log(response)
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });

        const addToCart = (productId) => {
            $.ajax({
                type: 'POST',
                url: '/fruitable/server/process.php',
                data: {
                    form_name: 'add_to_cart_form',
                    product_id: productId
                },
                success: function(response) {
                    const jsonResponse = JSON.parse(response);
                    if (jsonResponse.success === false) {

                        if (jsonResponse.redirect_url) {
                            window.location.href = jsonResponse.redirect_url;
                        }

                        if (jsonResponse.body) {
                            toastr['error'](jsonResponse.body)
                        }
                    } else {
                        toastr['success'](jsonResponse.body)
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    </script>