<?php
include_once("accountSQL.php");
include_once("emailSQL.php");

$errorMessage = $errorUsername = $errorFirstName = $errorLastName = $errorDateOfBirth = $errorEmail = $errorAddress = $errorPostcode = $errorPhone = $errorPassword = $errorConfirmPassword = "";

$allFields = TRUE;

if (isset($_POST['submit'])) {

    // security measures
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $firstName = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
    $postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($_POST['username'])) {

        $errorUsername = "Username is mandatory";

        $allFields = FALSE;
    } elseif (!$username) {
        $errorUsername = "Invalid username";
        $allFields = FALSE;
    }

    if (empty($_POST['firstname'])) {

        $errorFirstName = "First name is mandatory";

        $allFields = FALSE;
    } elseif (!$firstName) {
        $errorFirstname = "Invalid first name";
        $allFields = FALSE;
    }

    if (empty($_POST['lastname'])) {

        $errorLastName = "Last name is mandatory";

        $allFields = FALSE;
    } elseif (!$lastName) {
        $errorLastName = "Invalid last name";
        $allFields = FALSE;
    }

    if (empty($_POST['dateofbirth'])) {

        $errorDateOfBirth = "Date of birth is mandatory";

        $allFields = FALSE;
    }

    if (empty($_POST['phone'])) {

        $errorPhone = "Phone is mandatory";

        $allFields = FALSE;
    } elseif (!filter_var($phone, FILTER_VALIDATE_INT)) {
        $errorPhone = "Invalid phone number";
        $allFields = FALSE;
    }

    if (empty($_POST['email'])) {

        $errorEmail = "Email is mandatory";

        $allFields = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorEmail = "Invalid email";
        $allFields = FALSE;
    }

    if (empty($_POST['address'])) {

        $errorAddress = "Address is mandatory";

        $allFields = FALSE;
    } elseif (!$address) {
        $errorAddress = "Invalid address";
        $allFields = FALSE;
    }

    if (empty($_POST['postcode'])) {

        $errorPostcode = "Postcode is mandatory";

        $allFields = FALSE;
    } elseif (!$postcode) {
        $errorPostcode = "Invalid postcode";
        $allFields = FALSE;
    }

    if (strlen($_POST['password']) < 10) {

        $errorPassword = "Password needs to have a minimum of 10 characters";

        $allFields = FALSE;
    }

    if (empty($_POST['confirmpassword']) or $_POST['confirmpassword'] != $_POST['password']) {

        $errorConfirmPassword = "Confirm password must match password";

        $allFields = FALSE;
    }


    if ($allFields == TRUE) {


        $activationCode = GenerateRandomCode();
        $data = array(
            'username' => $username,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'dateofbirth' => $_POST['dateofbirth'],
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'postcode' => $postcode,
            'password' => $password,
            'activationcode' => $activationCode
        );

        //var_dump($data);

        //  echo UsernameExists($username);

        if (!UsernameExists($username)) {
            // creates user account
            $createUser = CreateAccount($data, Roles::USER);
                
            if ($createUser) {
                SendActivationEmail($email, $activationCode);
            }

            header('Location: index.php?createdAccount=' . $createUser);
            

        } else {
            $errorUsername = "Username already exists";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<body class="d-flex flex-column min-vh-100">

    <?php include("header.php"); ?>

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
                            <span class="text-danger"><?php echo $errorUsername; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" maxlength="60" placeholder="Enter your first name"
                                value=<?php if (isset($firstName)) {
                                            echo $firstName;
                                        }  ?>>
                            <span class="text-danger"><?php echo $errorFirstName; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" maxlength="60" placeholder="Enter your last name"
                                value=<?php if (isset($lastName)) {
                                            echo $lastName;
                                        }  ?>>
                            <span class="text-danger"><?php echo $errorLastName; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="dateofbirth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dateofbirth" name="dateofbirth"
                                placeholder="Enter your date of birth" value=<?php if (isset($_POST['dateofbirth'])) {
                                                                                    echo $_POST['dateofbirth'];
                                                                                }  ?>>
                            <span class="text-danger"><?php echo $errorDateOfBirth; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="60" placeholder="Enter your email"
                                value=<?php if (isset($email)) {
                                            echo $email;
                                        }  ?>>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                            <span class="text-danger"><?php echo $errorEmail; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Telephone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" maxlength="11" placeholder="Enter your telephone number"
                                value=<?php if (isset($phone)) {
                                            echo $phone;
                                        }  ?>>
                            <span class="text-danger"><?php echo $errorPhone; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" maxlength="60" placeholder="Enter your address"
                                value=<?php if (isset($address)) {
                                            echo $address;
                                        }  ?>>
                            <span class="text-danger"><?php echo $errorAddress; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" maxlength="10" placeholder="Enter your postcode"
                                value=<?php if (isset($postcode)) {
                                            echo $postcode;
                                        }  ?>>
                            <span class="text-danger"><?php echo $errorPostcode; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" maxlength="255" placeholder="Password">
                            <span class="text-danger"><?php echo $errorPassword; ?></span>
                        </div>
                        <div class="form-group mb-3 pb-3">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" maxlength="60"
                                placeholder="Confirm password">
                            <span class="text-danger"><?php echo $errorConfirmPassword; ?></span>
                        </div>
                        <!-- <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div> -->
                        <div>
                            <button type="submit" class="btn btn-primary w-100" name="submit" value="true">Sign Up</button>
                            <span class="text-danger"><?php echo $errorMessage; ?></span>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>

</html>