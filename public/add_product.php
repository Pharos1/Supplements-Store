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
    $PC->addProduct($_POST['name'], $_POST['description'], $_POST['price'], $_FILES['image']['name']);
}
echo "Product added!";

//TODO: Missing description parameter for wrapper function addProduct

// if (isset($_POST['submit'])) {
//     $name = $_POST['name'];
//     $desc = $_POST['description'];
//     $price = $_POST['price'];

//     $image = $_FILES['image']['name'];
//     $target = "uploads/" . basename($image);
//     move_uploaded_file($_FILES['image']['tmp_name'], $target);

//     $sql = "INSERT INTO products (name, description, price, image)
//             VALUES ('$name', '$desc', '$price', '$image')";
//     $conn->query($sql);
//     echo "Product added!";
// }
?>
