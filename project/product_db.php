<?php  
    session_start();
    include('server.php');

    $errors = array();

    // ตรวจสอบว่าได้รับการเรียกใช้เมื่อกดปุ่ม 'Addmin_user'
    if (isset($_POST['Addmin_user'])) {
        // รับข้อมูลจากฟอร์มและทำความสะอาดข้อมูล
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $stock_quantity = mysqli_real_escape_string($conn, $_POST['stock']);

        // คำสั่ง SQL สำหรับเพิ่มสินค้าใหม่ในตาราง products
        $sql = "INSERT INTO products(product_id, product_name, category, price, stock_quantity) 
                VALUES ('$product_id', '$product_name', '$category', '$price', '$stock_quantity')";

        // ตรวจสอบว่าคำสั่ง SQL สำเร็จหรือไม่
        if (mysqli_query($conn, $sql)) {
            echo "New record successfully added";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // ปิดการเชื่อมต่อกับฐานข้อมูล
        mysqli_close($conn);
    }
?>
