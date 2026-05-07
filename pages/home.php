<?php
// Fetch all products from the database
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="text-center mb-5">
    <h1 class="fw-bold text-dark">Fuel Your Potential</h1>
    <p class="text-muted">Premium supplements for serious athletes.</p>
</div>

<div class="row g-4">
    <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="card card-custom h-100">
                <!-- If the image starts with http, use it directly; otherwise, it's a local file -->
                <img src="<?= (strpos($product['image'], 'http') === 0) ? $product['image'] : $product['image'] ?>"
                    class="card-img-top"
                    style="height: 250px; object-fit: cover;"
                    alt="<?= htmlspecialchars($product['name']) ?>">
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title fw-bold mb-3"><?= htmlspecialchars($product['name']) ?></h5>
                    <p class="card-text text-muted mb-4"><?= htmlspecialchars($product['description']) ?></p>

                    <!-- Bottom row of the card -->
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="price-tag">$<?= number_format($product['price'], 2) ?></span>
                        <form action="actions/cart_action.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" class="btn btn-custom">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>