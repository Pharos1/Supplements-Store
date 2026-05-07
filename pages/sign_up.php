<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-custom p-5">
            <h2 class="fw-bold mb-4 text-center">Create an Account</h2>
            <form action="actions/register.php" method="POST">
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Email address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Register</button>
            </form>
        </div>
    </div>
</div>