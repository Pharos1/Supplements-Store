<h2 class="fw-bold mb-4">Your Shopping Cart</h2>

<?php if (empty($_SESSION['cart'])): ?>
    <div class="alert alert-info text-center p-5">
        <h4>Your cart is empty!</h4>
        <a href="index.php" class="btn btn-custom mt-3">Start Shopping</a>
    </div>
<?php else:
    $cart_ids = $_SESSION['cart'];
    // Convert array [1, 2, 2] into a string for SQL "1,2,2"
    $placeholders = str_repeat('?,', count($cart_ids) - 1) . '?';
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($cart_ids);
    $products = $stmt->fetchAll();

    $total = 0;
?>
    <div class="table-responsive card card-custom p-3">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $index => $productId):
                    // Find product details for this ID
                    $p = array_filter($products, function ($item) use ($productId) {
                        return $item['id'] == $productId;
                    });
                    $p = reset($p);
                    $total += $p['price'];
                ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
                        <td>$<?= number_format($p['price'], 2) ?></td>
                        <td><a href="actions/cart_action.php?remove=<?= $index ?>" class="btn btn-sm btn-outline-danger">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="fw-bold fs-4">Total</td>
                    <td class="fw-bold fs-4 text-primary">$<?= number_format($total, 2) ?></td>
                    <td><button class="btn btn-success w-100">Checkout</button></td>
                </tr>
            </tfoot>
        </table>
    </div>
<?php endif; ?>