<?php include '../src/config.php'; ?>
<div class="container my-4">
    <div class="row">
        <?php 
            $result = $conn->query("SELECT * FROM products");
            while ($row = $result->fetch_assoc()):
        ?>
        <div class="col-md-3 mt-4">
            <div class="card">
                <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top crop-img" alt="<?php echo $row['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                    <p class="card-text"><strong><?php echo $row['price']; ?> BGN</strong></p>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>