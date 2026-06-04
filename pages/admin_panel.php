<?php
// Ensure this page executes via your secure route system layout structure 
// (assuming $pdo is already loaded by index.php/layout.php)

// 1. STATS QUERIES
// Total revenue across the platform
$revenueStmt = $pdo->query("SELECT SUM(total_price) AS total FROM orders");
$totalRevenue = $revenueStmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0.00;

// Total individual units sold
$unitsStmt = $pdo->query("SELECT SUM(quantity) AS total_units FROM order_items");
$totalUnits = $unitsStmt->fetch(PDO::FETCH_ASSOC)['total_units'] ?? 0;

// Top performing item calculated dynamically
$popularStmt = $pdo->query("
    SELECT p.name, SUM(oi.quantity) as total_sold 
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    GROUP BY oi.product_id
    ORDER BY total_sold DESC
    LIMIT 1
");
$popularProduct = $popularStmt->fetch(PDO::FETCH_ASSOC);
$topItemName = $popularProduct ? $popularProduct['name'] . " (" . $popularProduct['total_sold'] . " units)" : "No sales recorded";

// Revenue split categorized automatically
$categoryBreakdown = $pdo->query("
    SELECT p.category, SUM(oi.quantity * oi.price_at_purchase) AS revenue
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    GROUP BY p.category
    ORDER BY revenue DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-4">
    <h1 class="fw-bold text-dark mb-4 text-center">Management Control Center</h1>

    <ul class="nav nav-tabs justify-content-center mb-5" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold px-4" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats-panel" type="button" role="tab">Store Analytics</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold px-4" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-panel" type="button" role="tab">User Directory</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold px-4" id="add-tab" data-bs-toggle="tab" data-bs-target="#add-panel" type="button" role="tab">Add Product</button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabsContent">
        
        <div class="tab-pane fade show active" id="stats-panel" role="tabpanel">
            <div class="row g-4 text-center mb-5">
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm border-0 bg-light h-100">
                        <h6 class="text-muted text-uppercase fw-bold small">Gross Revenue</h6>
                        <h2 class="fw-bold text-success mt-2">&euro;<?= number_format($totalRevenue, 2) ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm border-0 bg-light h-100">
                        <h6 class="text-muted text-uppercase fw-bold small">Supplements Dispatched</h6>
                        <h2 class="fw-bold text-dark mt-2"><?= $totalUnits ?> items</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm border-0 bg-light h-100">
                        <h6 class="text-muted text-uppercase fw-bold small">Top Performer</h6>
                        <h2 class="fw-bold text-primary mt-2 fs-4" style="word-wrap: break-word;"><?= htmlspecialchars($topItemName) ?></h2>
                    </div>
                </div>
            </div>

            <div class="card card-custom p-4 shadow-sm">
                <h4 class="fw-bold mb-3 text-dark">Revenue Contributions by Category</h4>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Category Type</th>
                                <th class="text-end">Total Revenue Generated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($categoryBreakdown)): ?>
                                <tr><td colspan="2" class="text-muted text-center">No orders tracked yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($categoryBreakdown as $row): ?>
                                    <tr>
                                        <td class="text-capitalize fw-bold text-secondary"><?= htmlspecialchars($row['category']) ?></td>
                                        <td class="text-end fw-bold text-dark">&euro;<?= number_format($row['revenue'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="users-panel" role="tabpanel">
            <div class="card card-custom p-4 shadow-sm mb-4">
                <h4 class="fw-bold mb-3 text-dark">Find and Manage System Accounts</h4>
                <div class="row g-3">
                    <div class="col-md-9">
                        <input type="text" id="userSearchInput" class="form-control text-dark" placeholder="Search accounts by name or email strings...">
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="searchUserBtn" class="btn btn-dark w-100">Search Records</button>
                    </div>
                </div>
            </div>

            <div class="row g-3" id="usersListContainer">
                </div>
        </div>

        <div class="tab-pane fade" id="add-panel" role="tabpanel">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-custom p-5 shadow-sm">
                        <h2 class="fw-bold mb-4 text-dark text-center">Admin: Add New Product</h2>
                        <form action="actions/add_product.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Product Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Omega 3 Fish Oil" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Price (&euro;)</label>
                                    <input type="number" step="0.01" name="price" class="form-control" placeholder="29.99" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Supplement Category Type</label>
                                    <select name="category" class="form-select text-dark" required>
                                        <option value="protein">Protein</option>
                                        <option value="creatine">Creatine</option>
                                        <option value="bcaa">BCAAs</option>
                                        <option value="preworkout">Pre-Workout</option>
                                        <option value="vitamins">Vitamins</option>
                                        <option value="anabol">Anabol</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Explain the ingredients and usage profiles..." required></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Product Image</label>
                                <input type="file" name="product_image" class="form-control" accept="image/*" required>
                                <small class="text-muted">JPG, PNG, or WebP preferred.</small>
                            </div>

                            <button type="submit" class="btn btn-custom w-100 py-2 fw-bold">Upload & Save Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("userSearchInput");
    const searchBtn = document.getElementById("searchUserBtn");
    const container = document.getElementById("usersListContainer");

    function loadUsers() {
        const value = encodeURIComponent(searchInput.value);
        fetch(`api/get_users.php?search=${value}`)
            .then(res => res.json())
            .then(users => {
                if (users.length === 0) {
                    container.innerHTML = '<div class="col-12 text-center text-muted py-4">No matching accounts found.</div>';
                    return;
                }
                let html = '';
                users.forEach(user => {
                    const isAdminBadge = parseInt(user.is_admin) === 1 
                        ? '<span class="badge bg-danger ms-2">Admin</span>' 
                        : '<span class="badge bg-secondary ms-2">Customer</span>';
                    
                    html += `
                        <div class="col-md-6 col-lg-4">
                            <div class="card p-3 border shadow-sm h-100 d-flex flex-row align-items-center">
                                <img src="img/user.png" class="rounded-circle me-3" style="width:60px; height:60px; object-fit:cover;" alt="User Profile Image">
                                <div class="flex-grow-1 min-w-0">
                                    <h6 class="mb-0 fw-bold text-truncate">${escapeJsHtml(user.name)} ${isAdminBadge}</h6>
                                    <small class="text-muted text-truncate d-block mb-2">${escapeJsHtml(user.email)}</small>
                                    <form action="actions/delete_user.php" method="POST" onsubmit="return confirm('Are you sure you want to completely erase this user account?');">
                                        <input type="hidden" name="email" value="${escapeJsHtml(user.email)}">
                                        <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2 small">Delete Account</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            });
    }

    function escapeJsHtml(str) {
        return String(str).replace(/[&<>"']/g, m => ({'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'})[m]);
    }

    searchBtn.addEventListener("click", loadUsers);
    searchInput.addEventListener("keyup", (e) => { if(e.key === "Enter") loadUsers(); });
    
    // Auto-load all accounts instantly on initial mounting
    loadUsers();
});
</script>
