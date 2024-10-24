<?php
include 'config.php'; // ไฟล์สำหรับเชื่อมต่อฐานข้อมูล

// รับค่า category_id จาก URL
if (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) {
    $category_id = intval($_GET['category_id']);
    // ดึงสินค้าตามหมวดหมู่
    $stmt = $conn->prepare("SELECT product_id, name, description, price, image FROM products WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
} else {
    // ดึงสินค้าทั้งหมด
    $stmt = $conn->prepare("SELECT product_id, name, description, price, image FROM products");
}

$stmt->execute();
$result = $stmt->get_result();

// ดึงชื่อหมวดหมู่ (ถ้ามี)
$category_name = '';
if (isset($category_id) && $category_id > 0) {
    $stmt_cat = $conn->prepare("SELECT category_name FROM categories WHERE category_id = ?");
    $stmt_cat->bind_param("i", $category_id);
    $stmt_cat->execute();
    $result_cat = $stmt_cat->get_result();
    if ($row_cat = $result_cat->fetch_assoc()) {
        $category_name = $row_cat['category_name'];
    }
    $stmt_cat->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Baker - Bakery Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid top-bar bg-dark text-light px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Career</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Terms</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Privacy</a></li>
                </ol>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn-lg-square text-primary pe-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">Baker</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link">หน้าหลัก</a>
            <a href="about.php" class="nav-item nav-link">เกี่ยวกับเรา</a>
            <a href="service.php" class="nav-item nav-link">บริการ</a>
            <a href="product.php" class="nav-item nav-link">สินค้าทั้งหมด</a>
            <div class="nav-item dropdown"> 
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">ประเภทขนม</a>
                <div class="dropdown-menu m-0">
                    <a href="product.php?category_id=1" class="dropdown-item">คุ้กกี้</a>
                    <a href="product.php?category_id=2" class="dropdown-item">เค้ก</a>
                    <a href="product.php?category_id=3" class="dropdown-item">บราวนี่</a>
                    <a href="product.php?category_id=4" class="dropdown-item">มาการอง</a>
                </div>
            </div>
            <a href="contact.php" class="nav-item nav-link">ติดต่อเรา</a>
        </div>
                <div class="basket-container">
                    <h3>Your Basket</h3>
                    <div id="basket-items">
                       <!-- Items will be dynamically added here -->
                    </div>
                    <div class="basket-total">
                       <strong>Total: $<span id="total-price">0.00</span></strong>
                    </div>
                    <button id="checkout-btn" class="btn">Checkout</button>
                 </div>
            </div>
            <div class=" d-none d-lg-flex">
                <div class="flex-shrink-0 btn-lg-square border border-light rounded-circle">
                    <i class="fa fa-phone text-primary"></i>
                </div>
                <div class="ps-3">
                    <small class="text-primary mb-0">Call Us</small>
                    <p class="text-light fs-5 mb-0">+012 345 6789</p>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Products</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Product Start -->
    <div class="container-xxl bg-light my-6 py-6 pt-0">
        <div class="container">
            <!-- ส่วนหัวของหน้าเพจ -->
            <div class="text-center mx-auto mb-5">
                <p class="text-primary text-uppercase mb-2">// สินค้าของเรา</p>
                <h1 class="display-6 mb-4">
                    <?php
                    if (!empty($category_name)) {
                        echo "สินค้าหมวดหมู่: " . htmlspecialchars($category_name);
                    } else {
                        echo "สินค้าทั้งหมด";
                    }
                    ?>
                </h1>
            </div>
            <!-- เมนูหมวดหมู่ -->
            <div class="category-menu text-center my-4">
                <a href="product.php?category_id=1" class="btn btn-primary mx-2">Cookies</a>
                <a href="product.php?category_id=2" class="btn btn-primary mx-2">Cakes</a>
                <a href="product.php?category_id=3" class="btn btn-primary mx-2">Brownies</a>
                <a href="product.php?category_id=4" class="btn btn-primary mx-2">Macarons</a>
                <a href="product.php" class="btn btn-secondary mx-2">สินค้าทั้งหมด</a>
            </div>
            <!-- แสดงสินค้าตามหมวดหมู่หรือทั้งหมด -->
            <div class="row g-4">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($product = $result->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                                <div class="text-center p-4">
                                    <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">
                                        $<?php echo number_format($product['price'], 2); ?>
                                    </div>
                                    <h3 class="mb-3"><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <span><?php echo htmlspecialchars($product['description']); ?></span>
                                </div>
                                <div class="position-relative mt-auto">
                                    <img class="img-fluid" src="uploaded_img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    <div class="product-overlay">
                                        <a class="btn btn-lg-square btn-outline-light rounded-circle" href="#" onclick="addToBasket('<?php echo addslashes($product['name']); ?>', <?php echo $product['price']; ?>)">
                                            <i class="fas fa-plus text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>ไม่พบสินค้าในหมวดหมู่นี้</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Product End -->
    <?php
    $stmt->close();
    $conn->close();
    ?>
     


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Office Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Photo Gallery</h4>
                    <div class="row g-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="img/product-1.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="img/product-2.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="img/product-3.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="img/product-2.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="img/product-3.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light rounded p-1" src="img/product-1.jpg" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                    <br>Distributed By: <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        let basket = [];
        let totalPrice = 0;
        
        function addToBasket(productName, productPrice) {
            basket.push({ name: productName, price: productPrice });
            updateBasket();
        }
        
        function updateBasket() {
            const basketItems = document.getElementById('basket-items');
            basketItems.innerHTML = ''; // Clear current items
            totalPrice = 0; // Reset total price
        
            basket.forEach((item, index) => {
                totalPrice += item.price;
                basketItems.innerHTML += `<div class="basket-item">
                    <span>${item.name}</span>
                    <span>$${item.price.toFixed(2)}</span>
                    <button onclick="removeFromBasket(${index})">Remove</button>
                </div>`;
            });
        
            document.getElementById('total-price').textContent = totalPrice.toFixed(2);
        }
        
        function removeFromBasket(index) {
            basket.splice(index, 1); // Remove item from basket
            updateBasket(); // Update the basket display
        }
        </script>
        
</body>

</html>