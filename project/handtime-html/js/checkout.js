// ฟังก์ชันเพื่อดึงสินค้าจาก localStorage
function getCart() {
    let cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
}

// ฟังก์ชันแสดงรายการสินค้าในหน้า Checkout
function renderCheckout() {
    const cart = getCart();
    const orderList = document.getElementById('order-list');
    const totalAmountElem = document.getElementById('total-amount');
    let totalAmount = 0;

    cart.forEach(product => {
        const listItem = document.createElement('li');
        listItem.textContent = `${product.name} - Quantity: ${product.quantity} - Price: $${product.price}`;
        orderList.appendChild(listItem);

        totalAmount += product.price * product.quantity;
    });

    totalAmountElem.textContent = `$${totalAmount.toFixed(2)}`;
}

window.onload = renderCheckout;
