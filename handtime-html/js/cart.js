// ฟังก์ชันเพื่อดึงสินค้าจาก localStorage
function getCart() {
    let cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
}

// ฟังก์ชันบันทึกตะกร้าสินค้าไปยัง localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// ฟังก์ชันเพื่อลบสินค้าจากตะกร้า
function removeFromCart(productId) {
    let cart = getCart();
    cart = cart.filter(item => item.id !== productId);
    saveCart(cart);
    renderCart();  // อัปเดตตารางรายการสินค้า
}

// ฟังก์ชันแสดงรายการสินค้าในตะกร้า
function renderCart() {
    const cart = getCart();
    const cartTableBody = document.querySelector('#cart-table tbody');
    cartTableBody.innerHTML = '';  // ล้างเนื้อหาตารางก่อนแสดงผลใหม่

    let totalAmount = 0;

    cart.forEach(product => {
        const productRow = document.createElement('tr');

        // ชื่อสินค้า
        const nameCell = document.createElement('td');
        nameCell.textContent = product.name;

        // จำนวนสินค้า
        const quantityCell = document.createElement('td');
        quantityCell.textContent = product.quantity;

        // ราคาสินค้า
        const priceCell = document.createElement('td');
        priceCell.textContent = `$${product.price}`;

        // ราคารวมของสินค้านี้
        const totalCell = document.createElement('td');
        const productTotal = product.price * product.quantity;
        totalCell.textContent = `$${productTotal.toFixed(2)}`;

        // เพิ่มราคารวมเข้าสู่ยอดรวมทั้งหมด
        totalAmount += productTotal;

        // ปุ่มลบสินค้า
        const removeCell = document.createElement('td');
        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', () => removeFromCart(product.id));
        removeCell.appendChild(removeButton);

        // เพิ่มเซลล์ทั้งหมดลงในแถว
        productRow.appendChild(nameCell);
        productRow.appendChild(quantityCell);
        productRow.appendChild(priceCell);
        productRow.appendChild(totalCell);
        productRow.appendChild(removeCell);

        // เพิ่มแถวลงในตาราง
        cartTableBody.appendChild(productRow);
    });

    // อัปเดตราคารวม
    document.getElementById('total-amount').textContent = `$${totalAmount.toFixed(2)}`;
}

// ฟังก์ชันเคลียร์สินค้าทั้งหมดในตะกร้า
document.getElementById('clear-cart').addEventListener('click', function() {
    localStorage.removeItem('cart');
    renderCart();
});

// ฟังก์ชันสำหรับปุ่มชำระเงิน
document.getElementById('checkout-button').addEventListener('click', function() {
    const cart = getCart();
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }
    // สามารถเปลี่ยนไปยังหน้าชำระเงินที่ต้องการ
    window.location.href = 'checkout.html';  // เปลี่ยนไปยังหน้าชำระเงิน
});

// เรียกฟังก์ชันแสดงรายการสินค้าในตะกร้าเมื่อโหลดหน้า
window.onload = renderCart;
