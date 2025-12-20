// Product data
let products = [
    { id: 1, name: "🎧 Headphones", price: 2000, image: "img/h1.jpg", category: "Electronics" },
    { id: 2, name: "👟 Shoes", price: 3000, image: "img/s1.jpg", category: "Sports" },
    { id: 3, name: "👕 Hoodie", price: 1500, image: "img/h2.jpg", category: "Clothes" },
    { id: 4, name: "⌚ Smartwatch", price: 5000, image: "img/sm1.jpg", category: "Electronics" },
    { id: 5, name: "📱 Mobile Phone", price: 15000, image: "img/m1.jpg", category: "Electronics" },
    { id: 6, name: "👜 Handbag", price: 2500, image: "img/bag1.jpg", category: "Clothes" },
    { id: 7, name: "🎮 Game Controller", price: 3500, image: "img/gc1.jpg", category: "Electronics" },
    { id: 8, name: "🕶 Sunglasses", price: 1200, image: "img/sg1.jpg", category: "Clothes" },
    { id: 9, name: "🏀 Basketball", price: 1800, image: "img/bb1.jpg", category: "Sports" },
    { id: 10, name: "💻 Laptop", price: 55000, image: "img/laptop1.jpg", category: "Electronics" }
];

// Load products dynamically from database
function loadProducts() {
    fetch('get_products.php')
        .then(response => response.json())
        .then(products => {
            let container = document.getElementById("product-list");
            container.innerHTML = "";

            products.forEach(p => {
                container.innerHTML += `
                    <div class="product">
                        <img src="${p.image}" alt="${p.name}">
                        <h3>${p.name}</h3>
                        <p>Price: Rs ${p.price}</p>
                        <p>Stock: ${p.stock}</p>
                        <button onclick="addToCart(${p.id})" ${p.stock === 0 ? 'disabled' : ''}>
                            ${p.stock === 0 ? 'Out of Stock' : 'Add to Cart'}
                        </button>
                    </div>
                `;
            });

            // Save products globally for cart logic
            window.products = products;
        });
}

// Add to Cart (simple example)
let cart = [];

function addToCart(id) {
    let product = products.find(p => p.id === id);
    if (!product) return;

    // Count how many of this product are already in cart
    let inCart = cart.filter(item => item.id === id).length;

    // Check if stock is available
    if (product.stock <= 0) {
        alert(`❌ Sorry! "${product.name}" is out of stock.`);
        return;
    }

    // Check if adding more than available stock
    if (inCart >= product.stock) {
        alert(`⚠️ You can only add ${product.stock} of "${product.name}" to your cart.`);
        return;
    }

    // Add to cart
    cart.push(product);
    updateCart();
}

function goCheckout() {
    // Save cart to server using AJAX
    fetch("save_cart.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(cart)
    })
    .then(res => res.text())
    .then(data => {
        // After saving session, open checkout page
        window.location.href = "checkout.php";
    });
}


function updateCart() {
    let cartList = document.getElementById("cart-items");
    let cartTotal = document.getElementById("cart-total");

    cartList.innerHTML = "";
    let total = 0;

    cart.forEach((item, index) => {
        total += item.price;
        cartList.innerHTML += `<li>${item.name} - Rs ${item.price} <button onclick="removeFromCart(${index})">x</button></li>`;
    });

    cartTotal.textContent = total;
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
}

// Open AI Chatbot
function openChatbot() {
    document.getElementById("chatbot-box").style.display = "block";
}

// Close AI Chatbot (optional)
function closeChatbot() {
    document.getElementById("chatbot-box").style.display = "none";
}
// Click outside to close chatbot
document.addEventListener('click', function(event) {
    const chatbotBox = document.getElementById('chatbot-box');
    const openChatButton = document.getElementById('open-chat-button');
    
    // If chatbot is visible AND click is outside both chatbot box AND open button
    if (chatbotBox.style.display === 'block' && 
        !chatbotBox.contains(event.target) && 
        event.target !== openChatButton) {
        closeChatbot();
    }
});
/*
// Show/hide login/register forms
function showLogin() {
    document.getElementById('login-form').style.display = 'block';
    document.getElementById('register-form').style.display = 'none'; // hide register
}

function closeLogin() {
    document.getElementById('login-form').style.display = 'none';
}

function showRegister() {
    document.getElementById('register-form').style.display = 'block';
    document.getElementById('login-form').style.display = 'none'; // hide login
}

function closeRegister() {
    document.getElementById('register-form').style.display = 'none';
}
*/
// Optional: Close forms when clicking outside
window.onclick = function(event) {
    let loginForm = document.getElementById('login-form');
    let registerForm = document.getElementById('register-form');

    if (event.target === loginForm) closeLogin();
    if (event.target === registerForm) closeRegister();
}

// Run when page loads
window.onload = loadProducts;