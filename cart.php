<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Website</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background: #eee;
        }
        
        /* Additional custom styles */
        .product-details {
            margin-right: 70px;
        }
        
        .text-grey {
            color: #a39f9f;
        }

        .qty i {
            font-size: 11px;
            cursor: pointer; /* Change cursor for better UX */
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <h1 class="text-center">Shopping Cart</h1>
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                    <div class="mr-1">
                        <img class="rounded" src="https://i.imgur.com/XiFJkhI.jpg" width="70" alt="Basic T-shirt">
                    </div>
                    <div class="d-flex flex-column align-items-center product-details">
                        <span class="font-weight-bold">Basic T-shirt</span>
                        <div class="d-flex flex-row product-desc">
                            <div class="size mr-1">
                                <span class="text-grey">Size:</span>
                                <span class="font-weight-bold">&nbsp;M</span>
                            </div>
                            <div class="color">
                                <span class="text-grey">Color:</span>
                                <span class="font-weight-bold">&nbsp;Grey</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center qty">
                        <i class="fa fa-minus text-danger" onclick="updateQuantity(this, -1)"></i>
                        <h5 class="text-grey mt-1 mr-1 ml-1 quantity">2</h5>
                        <i class="fa fa-plus text-success" onclick="updateQuantity(this, 1)"></i>
                    </div>
                    <div>
                        <h5 class="text-grey price" data-price="20.00">$20.00</h5>
                    </div>
                    <div class="d-flex align-items-center" onclick="removeItem(this)">
                        <i class="fa fa-trash mb-1 text-danger"></i>
                    </div>
                </div>
                <!-- Additional products can be added here -->
                
                <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded">
                    <button class="btn btn-warning btn-block btn-lg" type="button">Proceed to Pay</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap Bundle (includes Popper.js) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <script>
        function updateQuantity(element, change) {
            const productDiv = element.closest('.d-flex.flex-row');
            const quantityElement = productDiv.querySelector('.quantity');
            let currentQuantity = parseInt(quantityElement.innerText);
            currentQuantity += change;
            if (currentQuantity < 1) currentQuantity = 1; // Minimum quantity of 1
            quantityElement.innerText = currentQuantity;

            // Update total price display if needed
            const price = parseFloat(productDiv.querySelector('.price').dataset.price);
            const total = (currentQuantity * price).toFixed(2);
            productDiv.querySelector('.price').innerText = `$${total}`;
        }

        function removeItem(element) {
            const productDiv = element.closest('.d-flex.flex-row');
            productDiv.remove(); // Remove the product from the cart
            // You may want to update total price here if necessary
        }
    </script>
</body>
</html>
