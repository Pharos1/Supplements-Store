<?php include '../src/config.php'; ?>
<?php require_once __DIR__ . '/../src/controllers/ProductController.php'?>

<form method="POST" action="add_product.php" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product name" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br>
    <input type="file" name="image" required><br>
    <button type="submit" name="submit">Add Product</button>
</form>

<?php
$PC = new ProductController();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    
    $PC->addProduct($name, $desc, $price, $image);
}
echo "Product added!";
?>
