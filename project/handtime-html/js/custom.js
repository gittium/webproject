// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();


/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}


// ฟังก์ชันเพื่อดึงสินค้าจาก localStorage
function getCart() {
    let cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
}

// ฟังก์ชันบันทึกตะกร้าสินค้าไปยัง localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// ฟังก์ชันเพิ่มสินค้าไปยังตะกร้า
function addToCart(product) {
    let cart = getCart();

    // ค้นหาว่าสินค้าชนิดนี้อยู่ในตะกร้าหรือไม่
    let existingProduct = cart.find(item => item.id === product.id);

    if (existingProduct) {
        // ถ้ามีอยู่แล้ว เพิ่มจำนวนสินค้า
        existingProduct.quantity += 1;
    } else {
        // ถ้ายังไม่มี ให้เพิ่มสินค้าใหม่
        cart.push({ ...product, quantity: 1 });
    }

    // บันทึกตะกร้าสินค้า
    saveCart(cart);
    alert("สินค้าได้ถูกเพิ่มลงในตะกร้าแล้ว!");
    updateCartCount();
}

// ฟังก์ชันเพื่ออัปเดตจำนวนสินค้าในตะกร้า
function updateCartCount() {
    let cart = getCart();
    let totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    document.getElementById('cart-count').textContent = totalItems;
}

// เพิ่ม event listener ให้กับปุ่ม "Add to Cart"
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const product = {
            id: this.getAttribute('data-id'),
            name: this.getAttribute('data-name'),
            price: parseFloat(this.getAttribute('data-price'))
        };
        addToCart(product);
    });
});

// อัปเดตจำนวนสินค้าเมื่อโหลดหน้า
window.onload = updateCartCount;

function updateCartCount() {
    let cart = getCart();
    let totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    document.getElementById('cart-count').textContent = totalItems;
}

// อัปเดตจำนวนสินค้าเมื่อโหลดหน้า
window.onload = updateCartCount;
