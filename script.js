// Product data
let products = [ 
    { id: 1, name: "Headphones", price: 2000, image: "img/h1.jpg", category: "Electronics" },
    { id: 2, name: "Shoes", price: 3000, image: "img/s1.jpg", category: "Sports" },
    { id: 3, name: "Hoodie", price: 1500, image: "img/h2.jpg", category: "Clothes" }
];

// Load products dynamically
function loadProducts() {
    let container = document.getElementById("product-list");
    container.innerHTML = "";

    products.forEach(p => {
        container.innerHTML += `
            <div class="product">
                <img src="${p.image}">
                <h3>${p.name}</h3>
                <p>Price: Rs ${p.price}</p>
                <button onclick="addToCart(${p.id})">Add to Cart</button>
            </div>
        `;
    });
}

// Add to Cart (simple example)
function addToCart(id) {
    let product = products.find(p => p.id === id);
    alert(`${product.name} added to cart!`);
}

// Open AI Chatbot
function openChatbot() {
    document.getElementById("chatbot-box").style.display = "block";
}

// Close AI Chatbot (optional)
function closeChatbot() {
    document.getElementById("chatbot-box").style.display = "none";
}

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

// Optional: Close forms when clicking outside
window.onclick = function(event) {
    let loginForm = document.getElementById('login-form');
    let registerForm = document.getElementById('register-form');

    if (event.target === loginForm) closeLogin();
    if (event.target === registerForm) closeRegister();
}

// Run when page loads
window.onload = loadProducts;