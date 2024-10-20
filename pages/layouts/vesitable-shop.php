    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="mb-0">Fresh Organic Vegetables</h1>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                <?php

                $mydb = Database::getConnection();
                $result = mysqli_query($mydb, "SELECT * FROM product WHERE category_id = 1");
                $data = $result->fetch_all(MYSQLI_ASSOC);
                ?>
                <?php foreach ($data as $row): ?>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="<?= htmlspecialchars('data:' . $row["file_type"]) . ";base64," .  htmlspecialchars(base64_encode($row["image"])) ?>" class="img-fluid w-100 rounded-top" style="height: 242.91px;" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
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
                        <div class="p-4 rounded-bottom">
                            <h4><?= htmlspecialchars($row["product_name"]) ?></h4>
                            <p><?= htmlspecialchars($row["description"]) ?></p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">$<?= htmlspecialchars($row["price"]) ?> / kg</p>
                                <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart(<?= htmlspecialchars($row['product_id']) ?>)"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
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