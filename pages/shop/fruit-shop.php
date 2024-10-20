    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4 mt-2">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            <?php
                                            define('__ROOT__', dirname(dirname(__FILE__)));
                                            require('./classes/Database.php');

                                            $mydb = Database::getConnection();
                                            $result = mysqli_query($mydb, "SELECT * FROM category");
                                            $data = $result->fetch_all(MYSQLI_ASSOC);
                                            ?>
                                            <?php foreach ($data as $row): ?>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><?= htmlspecialchars($row['category_name']) ?></a>
                                                    </div>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                        <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                <?php
                                $products_query = mysqli_query($mydb, "SELECT * FROM product");
                                $products = $products_query->fetch_all(MYSQLI_ASSOC);
                                ?>
                                <?php foreach ($products as $row): ?>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= htmlspecialchars('data:' . $row["file_type"]) . ";base64," .  htmlspecialchars(base64_encode($row["image"])) ?>" class="img-fluid w-100 rounded-top" style="height: 242.91px;" alt="">
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
                                                <h4><?= htmlspecialchars($row['product_name']) ?></h4>
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
            </div>
        </div>
    </div>

    <script>
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