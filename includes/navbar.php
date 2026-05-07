<?php
// Count items in cart
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<nav class="navbar navbar-expand-lg navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand" href="index.php">222 SUPPS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about_route.php">About Us</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="cart_route.php">
                        Cart <span class="badge bg-danger"><?= $cart_count ?></span>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link text-warning" href="admin_route.php">Admin Panel</a></li>
                    <li class="nav-item ms-lg-3"><span class="nav-link text-white">Hi, <?= htmlspecialchars($_SESSION['username']) ?></span></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm ms-2" href="actions/logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3"><a class="nav-link" href="login_route.php">Sign In</a></li>
                    <li class="nav-item"><a class="btn btn-custom ms-2" href="signup_route.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>