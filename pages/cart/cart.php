<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    define('__ROOT__', dirname(dirname(__FILE__)));
                    require('./classes/Database.php');

                    $data = array();

                    if (isset($_SESSION['user_id']) && isset($_SESSION['logged_in'])) {
                        $mydb = Database::getConnection();
                        $user_id = $_SESSION['user_id'];
                        $result = mysqli_query($mydb, "SELECT * FROM product WHERE product_id in (SELECT product_id FROM cart WHERE user_unique_id = '$user_id')");
                        $data = $result->fetch_all(MYSQLI_ASSOC);
                    }

                    ?>

                    <?php foreach ($data as $row): ?>
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="<?= htmlspecialchars('data:' . $row["file_type"]) . ";base64," .  htmlspecialchars(base64_encode($row["image"])) ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                                <input type="text" hidden value="<?= htmlspecialchars($row['product_id']) ?>" id="product_id">
                            </th>
                            <td>
                                <p class="mb-0 mt-4"><?= htmlspecialchars($row["product_name"]) ?></p>
                            </td>
                            <td class="product_price">
                                <p class="mb-0 mt-4"><?= htmlspecialchars($row["price"]) ?> $</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" id="quantity_input" value="0">
                                    <div class=" input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="product_total_price">
                                <p class="mb-0 mt-4">0.00 $</p>
                            </td>
                            <td>
                                <button class="btn btn-md rounded-circle bg-light border mt-4" onclick="removeFromCart(this)">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0" id="sub_total">0.00 $</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0 text-end">Shipping to Ukraine.</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4" id="total_price">$0.00</p>
                    </div>
                    <?php

                    if (isset($_SESSION["user_id"]) && isset($_SESSION["logged_in"])) {
                        echo "<button class='btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4' type='button' onclick='redirectToCheckoutPage()'>Proceed Checkout</button>";
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('./pages/layouts/script.php') ?>
<script>
    $(document).ready(function() {

        $(".quantity button").on("click", function() {
            var button = $(this);
            var oldValue = button.parent().parent().find("input").val();

            const current_row = $(this).closest('tr');
            const product_price = Number(current_row.find('.product_price').find('p').text().replace(" $", ""));
            const product_total_price_element = current_row.find('.product_total_price').find('p');
            const product_total_price = Number(product_total_price_element.text().replace(" $", ""));
            const sub_total_element = $("#sub_total");
            let sub_total_amount = Number(sub_total_element.text().replace("$", ""));

            if (button.hasClass("btn-plus")) {
                var newVal = parseFloat(oldValue) + 1;
                const product_price_with_quantity = product_total_price + product_price;
                product_total_price_element.text(product_price_with_quantity.toFixed(2) + " $");
                sub_total_amount = sub_total_amount + product_price;
            } else {
                if (oldValue > 0) {
                    newVal = parseFloat(oldValue) - 1;
                    const product_price_with_quantity = product_total_price - product_price;
                    product_total_price_element.text(product_price_with_quantity.toFixed(2) + " $");
                    sub_total_amount = sub_total_amount - product_price;
                } else {
                    newVal = 0;
                    sub_total_amount = "0.00";
                }

            }

            sub_total_element.text(sub_total_amount + " $");
            $("#total_price").text(sub_total_amount + " $");
            button.parent().parent().find("input").val(newVal);
        });
    });

    const removeFromCart = (removeFromCartElement) => {
        const currentRow = $(removeFromCartElement).parent().parent();
        const product_id = currentRow.find("#product_id");
        $.ajax({
            type: 'POST',
            url: '/fruitable/server/process.php',
            data: {
                form_name: 'remove_from_cart',
                product_id: product_id.val()
            },
            success: function(response) {
                const jsonResponse = JSON.parse(response);
                if (jsonResponse.success === false) {
                    if (jsonResponse.body) {
                        toastr['error'](jsonResponse.body)
                    }
                } else {
                    toastr['success'](jsonResponse.body)
                    currentRow.remove();
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    }

    const redirectToCheckoutPage = () => {
        const total_price = $("#total_price").text().replace("$", "");
        if (Number(total_price) === 0.00) {
            toastr['error']("Please set quantity before proceed to payment!");
        } else {
            window.location.href = "/fruitable/checkout.php";
        }
    }
</script>