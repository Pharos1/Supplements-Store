<div class="text-center mb-5">
    <h1 class="fw-bold text-dark">Fuel Your Potential</h1>
    <p class="text-muted">Premium supplements for serious athletes.</p>
</div>

<div class="row g-3 mb-4 justify-content-between align-items-center">
    <div class="col-sm-6 col-md-4">
        <input type="text" id="productSearch" class="form-control text-dark px-3 rounded-pill" placeholder="Search supplements...">
    </div>
    <div class="col-sm-6 col-md-3">
        <select id="productSort" class="form-select text-dark rounded-pill">
            <option value="default">Sort By: Featured</option>
            <option value="price_low_high">Price: Low to High</option>
            <option value="price_high_low">Price: High to Low</option>
            <option value="name_asc">Alphabetical (A-Z)</option>
        </select>
    </div>
</div>

<div class="d-flex justify-content-center mb-5">
    <div class="category-scroll-container">
        <button type="button" class="btn btn-category active" data-category="all">All Products</button>
        <button type="button" class="btn btn-category" data-category="protein">Protein</button>
        <button type="button" class="btn btn-category" data-category="creatine">Creatine</button>
        <button type="button" class="btn btn-category" data-category="bcaa">BCAAs</button>
        <button type="button" class="btn btn-category" data-category="preworkout">Pre-Workout</button>
        <button type="button" class="btn btn-category" data-category="vitamins">Vitamins</button>
        <button type="button" class="btn btn-category" data-category="anabol">Legal Testo-boosters</button>
    </div>
</div>

<div class="row g-4" id="productsContainer">
    </div>
     
<script>
document.addEventListener("DOMContentLoaded", function () {
    const productsContainer = document.getElementById("productsContainer");
    const searchInput = document.getElementById("productSearch");
    const sortSelect = document.getElementById("productSort");
    const filterButtons = document.querySelectorAll(".btn-category");

    let currentCategory = "all";

    // Main Function to Fetch and Render items
    function fetchProducts() {
        const searchQuery = encodeURIComponent(searchInput.value);
        const sortQuery = sortSelect.value;
        
        // Build Endpoint URL string dynamically
        const url = `api/get_products.php?search=${searchQuery}&sort=${sortQuery}&category=${currentCategory}`;

        fetch(url)
            .then(response => response.json())
            .then(products => {
                renderProducts(products);
            })
            .catch(error => {
                console.error("Error loading items:", error);
                productsContainer.innerHTML = `<div class="col-12 text-center text-danger">Failed to load supplements.</div>`;
            });
    }

    // Render HTML Cards dynamically
    function renderProducts(products) {
        if (products.length === 0) {
            productsContainer.innerHTML = `<div class="col-12 text-center text-muted my-5"><h5>No supplements match your selection.</h5></div>`;
            return;
        }

        let html = '';
        products.forEach(product => {
            // Reusable formatting operations mirroring your native code block definitions
            const formattedPrice = parseFloat(product.price).toFixed(2);
            const escapeName = escapeHtml(product.name);
            const escapeDesc = escapeHtml(product.description);
            const imgSrc = product.image; 

            html += `
                <div class="col-md-4">
                    <div class="card card-custom h-100">
                        <img src="${imgSrc}"
                            class="card-img-top"
                            style="height: 250px; object-fit: contain;"
                            alt="${escapeName}">
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title fw-bold mb-3">${escapeName}</h5>
                            <p class="card-text text-muted mb-4">${escapeDesc}</p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="price-tag">&euro;${formattedPrice}</span>
                                <form action="actions/cart_action.php" method="POST">
                                    <input type="hidden" name="product_id" value="${product.id}">
                                    <button type="submit" class="btn btn-custom">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        productsContainer.innerHTML = html;
    }

    // Simple JS HTML Escaper to replace PHP's htmlspecialchars
    function escapeHtml(string) {
        return String(string).replace(/[&<>"']/g, function (s) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[s];
        });
    }

    // Event Listeners for Filters, Input and Selection Fields
    
    // 1. Live Typing Filter (Debounced event cycle for performance)
    let typingTimer;
    searchInput.addEventListener("input", () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchProducts, 300); 
    });

    // 2. Select Sorting Switch
    sortSelect.addEventListener("change", fetchProducts);

    // 3. Category Select Tabs
    filterButtons.forEach(button => {
        button.addEventListener("click", function() {
            filterButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            
            currentCategory = this.getAttribute("data-category");
            fetchProducts();
        });
    });

    // Run query on load
    fetchProducts();
});
</script>
