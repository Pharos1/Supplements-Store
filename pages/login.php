<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card card-custom p-5">
            <h2 class="fw-bold mb-4 text-center">Welcome Back</h2>
            <form action="actions/login_action.php" method="POST">
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Login</button>
            </form>
        </div>
    </div>
</div>