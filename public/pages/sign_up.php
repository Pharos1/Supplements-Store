<div class="card w-25 m-auto">
	<form class="text-start p-5">
		<!-- Email input -->
		<div data-mdb-input-init class="form-outline mb-4">
			<label class="form-label" for="email">Email address</label>
			<input type="email" id="email" class="form-control" placeholder="Enter email" />
		</div>

		<!-- Password input -->
		<div data-mdb-input-init class="form-outline mb-4">
			<label class="form-label" for="password">Password</label>
			<input type="password" id="password" class="form-control" placeholder="Enter password" />
		</div>
		<!-- Confirm Password -->
		<div data-mdb-input-init class="form-outline mb-4">
			<label class="form-label" for="password">Confirm Password</label>
			<input type="password" id="password" class="form-control" placeholder="Confirm password" />
		</div>

		<!-- 2 column grid layout for inline styling -->
		<div class="row mb-4">
			<div class="col d-flex justify-content-center">
				<!-- Checkbox -->
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="remember_me" checked />
					<label class="form-check-label" for="remember_me"> Remember me </label>
				</div>
			</div>
		</div>

		<!-- Submit button -->
		<div class="text-center">
			<button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign up</button>
		</div>
		<!-- Register buttons -->
		<div class="text-center">
			<p>Already a member? <a href="sign_in.php">Log in</a></p>
			<p>Other sign up methods:</p>
			<button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
				<i class="fab fa-facebook-f"></i>
			</button>

			<button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
				<i class="fab fa-google"></i>
			</button>

			<button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
				<i class="fab fa-twitter"></i>
			</button>

			<button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
				<i class="fab fa-github"></i>
			</button>
		</div>
	</form>
</div>