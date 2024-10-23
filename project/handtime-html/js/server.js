const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());

// การตั้งค่าการเชื่อมต่อ MySQL
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '12345678',
    database: 'projectweb'
});


// เชื่อมต่อกับฐานข้อมูล
db.connect((err) => {
    if (err) {
        console.error('error connecting: ' + err.stack);
        return;
    }
    console.log('connected to database');
});

// API สำหรับเพิ่มสินค้าในตะกร้า
app.post('/add-to-cart', (req, res) => {
    const { name, quantity, price } = req.body;

    const query = 'INSERT INTO cart_items (name, quantity, price) VALUES (?, ?, ?)';
    db.query(query, [name, quantity, price], (err, result) => {
        if (err) {
            return res.status(500).send(err);
        }
        res.send('Item added to cart');
    });
});

// เปิดเซิร์ฟเวอร์
app.listen(3000, () => {
    console.log('Server running on port 3000');
});

// ฟังก์ชันสำหรับเพิ่มรายการสินค้าในตะกร้าไปยังฐานข้อมูล
function addToCart(item) {
    fetch('/add-to-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(item)
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // แสดงข้อความตอบกลับจากเซิร์ฟเวอร์
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// เมื่อมีการเพิ่มสินค้าให้เรียกใช้ฟังก์ชันนี้
document.querySelector("#cart-table").addEventListener("click", (e) => {
    const itemId = parseInt(e.target.dataset.id);
    if (e.target.classList.contains("add-to-cart")) {
        const item = cartItems.find(item => item.id === itemId);
        addToCart(item);  // เรียกใช้ฟังก์ชันเพื่อส่งข้อมูลไปยัง Backend
    }
});
