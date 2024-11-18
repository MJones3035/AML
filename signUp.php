<!DOCTYPE html>
<html lang="en">

<body class="d-flex flex-column min-vh-100">

    <?php include("header.php"); ?>

    <main class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form-container border p-4 rounded shadow">
                    <h2 class="text-center mb-4">Create Your Account</h2>
                    <form>
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter a username">
                        </div>
                        <div class="form-group mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter your first name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter your last name">
                        </div>
                        <div class="form-group mb-3">   
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="number" class="form-label">Number</label>
                            <input type="tel" class="form-control" id="number" placeholder="Enter your telephone number">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter your address">
                        </div>
                        <div class="form-group mb-3">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="postcode" placeholder="Enter your postcode">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm password">
                        </div>
                        <!-- <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div> -->
                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>

</html>
