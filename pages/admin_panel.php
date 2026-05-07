<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom p-5">
            <h2 class="fw-bold mb-4">Admin: Add New Product</h2>
            <form action="actions/add_product.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Omega 3 Fish Oil" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Price ($)</label>
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="29.99" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Product Image</label>
                    <input type="file" name="product_image" class="form-control" accept="image/*" required>
                    <small class="text-muted">JPG, PNG, or WebP preferred.</small>
                </div>

                <button type="submit" class="btn btn-custom w-100">Upload & Save Product</button>
            </form>
        </div>
    </div>
</div>