<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>E-Commerce Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>🛒 AI Powered E-Commerce Store</h1>
</header>

<!-- Login / Register Buttons or Welcome -->
<div class="auth-buttons">
<?php if (!isset($_SESSION['user'])): ?>
    <button onclick="showLogin()">Login</button>
    <button onclick="showRegister()">Register</button>
<?php else: ?>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</p>
    <form action="logout.php" method="post" style="display:inline;">
        <button type="submit">Logout</button>
    </form>
<?php endif; ?>
</div>

<!-- Login Form -->
<div id="login-form" style="display:none;">
    <form action="login.php" method="post">
        <h3>Login</h3>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
        <button type="button" onclick="closeLogin()">Close</button>
    </form>
</div>

<!-- Register Form -->
<div id="register-form" style="display:none;">
    <form action="register.php" method="post">
        <h3>Register</h3>
        <input type="text" name="name" placeholder="Enter Name" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Register</button>
        <button type="button" onclick="closeRegister()">Close</button>
    </form>
</div>

<!-- Cart Section -->
<div id="cart" class="cart">
    <h3>🛒 Cart</h3>
    <ul id="cart-items"></ul>
    <p>Total: Rs <span id="cart-total">0</span></p>
</div>

<!-- Checkout button -->
 <button onclick="goCheckout()" class="checkout-btn"🛍️>Proceed to Checkout</button>

<!-- Product Container -->
<div class="product-container" id="product-list"></div>

<!-- AI Chatbot Button -->
<button class="chatbot-btn" id="open-chat-button" onclick="openChatbot()">🤖 Chat with AI</button>

<!-- AI Chatbot Box -->
<div id="chatbot-box" class="chatbot-box">
    <h3>AI Assistant</h3>
    <div id="chat-area"></div>
    <input type="text" id="userInput" placeholder="Ask something..." onkeypress="sendMessage(event)">
</div>

<!-- JS Scripts -->
<script src="script.js"></script>
<script src="ai_chatbot.js"></script>
<script src="ai_recommend.js"></script>

<script>
// Show/hide login/register forms
function showLogin() {
    let loginForm = document.getElementById('login-form');
    if (loginForm) loginForm.style.display = 'block';
}
function closeLogin() {
    let loginForm = document.getElementById('login-form');
    if (loginForm) loginForm.style.display = 'none';
}
function showRegister() {
    let registerForm = document.getElementById('register-form');
    if (registerForm) registerForm.style.display = 'block';
}
function closeRegister() {
    let registerForm = document.getElementById('register-form');
    if (registerForm) registerForm.style.display = 'none';
}
</script>

</body>
</html>