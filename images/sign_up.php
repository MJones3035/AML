<?php
include_once("user_sql.php");
include_once("email_sql.php");

$error_message = $error_username = $error_first_name = $error_last_name = $error_date_of_birth = $error_email = $error_address
 = $error_postcode = $error_phone = $error_password = $error_confirm_password = "";

$all_fields = TRUE;

if (isset($_POST['submit'])) {

    // security measures
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
    $postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($_POST['username'])) {

        $error_username = "Username is mandatory";

        $all_fields = FALSE;
    } elseif (!$username) {
        $error_username = "Invalid username";
        $all_fields = FALSE;
    }

    if (empty($_POST['first_name'])) {

        $error_first_name = "First name is mandatory";

        $all_fields = FALSE;
    } elseif (!$first_name) {
        $error_first_name = "Invalid first name";
        $all_fields = FALSE;
    }

    if (empty($_POST['last_name'])) {

        $error_last_name = "Last name is mandatory";

        $all_fields = FALSE;
    } elseif (!$last_name) {
        $error_last_name = "Invalid last name";
        $all_fields = FALSE;
    }

    if (empty($_POST['date_of_birth'])) {

        $error_date_of_birth = "Date of birth is mandatory";

        $all_fields = FALSE;
    }

    if (empty($_POST['phone'])) {

        $error_phone = "Phone is mandatory";

        $all_fields = FALSE;
    } elseif (!filter_var($phone, FILTER_VALIDATE_INT)) {
        $error_phone = "Invalid phone number";
        $all_fields = FALSE;
    }

    if (empty($_POST['email'])) {

        $error_email = "Email is mandatory";

        $all_fields = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Invalid email";
        $all_fields = FALSE;
    }

    if (empty($_POST['address'])) {

        $error_address = "Address is mandatory";

        $all_fields = FALSE;
    } elseif (!$address) {
        $error_address = "Invalid address";
        $all_fields = FALSE;
    }

    if (empty($_POST['postcode'])) {

        $error_postcode = "Postcode is mandatory";

        $all_fields = FALSE;
    } elseif (!$postcode) {
        $error_postcode = "Invalid postcode";
        $all_fields = FALSE;
    }

    if (strlen($_POST['password']) < 10) {

        $error_password = "Password needs to have a minimum of 10 characters";

        $all_fields = FALSE;
    }

    if (empty($_POST['confirm_password']) or $_POST['confirm_password'] != $_POST['password']) {

        $error_confirm_password = "Confirm password must match password";

        $all_fields = FALSE;
    }


    if ($all_fields == TRUE) {


        $activation_code = generate_random_code();
        $data = array(
            'username' => $username,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'date_of_birth' => $_POST['date_of_birth'],
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'postcode' => $postcode,
            'password' => $password,
            'activation_code' => $activation_code
        );

        //var_dump($data);

        //  echo UsernameExists($username);

        if (!does_username_exist($username)) {
            // creates user account
            $createUser = create_user($data, Roles::USER);
                
            if ($createUser) {
                send_activation_email($email, $activation_code);
            }

            header('Location: index.php?created_account=' . $createUser);
            

        } else {
            $error_username = "Username already exists";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Advanced Media Library</title>
</head>
<body>
	
	<!-- header & navigation -->
	<section id="header">
		<img src="images/logo.png" width="60px" height="50px">

		<div>
			<ul id="nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="login.php">Login</a></li>
                <li><a href="sign_up.php" class="active">Register</a></li>
			</ul>
		</div>
	</section>

	<section id="page-header">
		<h2>Advanced Media Library</h2>
		<p>Have a precious time with famous books</p>
	</section>

    <main class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form-container border p-4 rounded shadow">
                    <h2 class="text-center mb-4">Create Your Account</h2>
                    <form method="post">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" maxlength="60"
                                placeholder="Enter a username" value=<?php if (isset($username)) {
                                                                            echo $username;
                                                                        } ?>>
                            <span class="text-danger"><?php echo $error_username; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" maxlength="60" placeholder="Enter your first name"
                                value=<?php if (isset($first_name)) {
                                            echo $first_name;
                                        }  ?>>
                            <span class="text-danger"><?php echo $error_first_name; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" maxlength="60" placeholder="Enter your last name"
                                value=<?php if (isset($last_name)) {
                                            echo $last_name;
                                        }  ?>>
                            <span class="text-danger"><?php echo $error_last_name; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                placeholder="Enter your date of birth" value=<?php if (isset($_POST['date_of_birth'])) {
                                                                                    echo $_POST['date_of_birth'];
                                                                                }  ?>>
                            <span class="text-danger"><?php echo $error_date_of_birth; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="60" placeholder="Enter your email"
                                value=<?php if (isset($email)) {
                                            echo $email;
                                        }  ?>>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                            <span class="text-danger"><?php echo $error_email; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Telephone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" maxlength="11" placeholder="Enter your telephone number"
                                value=<?php if (isset($phone)) {
                                            echo $phone;
                                        }  ?>>
                            <span class="text-danger"><?php echo $error_phone; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" maxlength="60" placeholder="Enter your address"
                                value=<?php if (isset($address)) {
                                            echo $address;
                                        }  ?>>
                            <span class="text-danger"><?php echo $error_address; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" maxlength="10" placeholder="Enter your postcode"
                                value=<?php if (isset($postcode)) {
                                            echo $postcode;
                                        }  ?>>
                            <span class="text-danger"><?php echo $error_postcode; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" maxlength="255" placeholder="Password">
                            <span class="text-danger"><?php echo $error_password; ?></span>
                        </div>
                        <div class="form-group mb-3 pb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" maxlength="60"
                                placeholder="Confirm password">
                            <span class="text-danger"><?php echo $error_confirm_password; ?></span>
                        </div>
                        <!-- <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div> -->
                        <div>
                            <button type="submit" class="btn btn-primary w-100" name="submit" value="true">Sign Up</button>
                            <span class="text-danger"><?php echo $error_message; ?></span>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>

</html>