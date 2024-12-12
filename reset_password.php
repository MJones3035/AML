<?php
include_once 'user_sql.php';
include_once 'email_sql.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $new_password = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_new_password = filter_input(INPUT_POST, 'confirm_new_password', FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate the input
    $errors = [];


    if (!empty($new_password) and strlen($new_password) < 10) {
        $errors[] = "Password is less than 10 characters.";
    }

    if ($confirm_new_password != $new_password) {
        $errors[] = "Confirm password is not the same as password.";
    }

    if (empty($errors)) {
        // Update user information in the database


        if (update_user_profile($_SESSION['user_id'], $username, $first_name, $last_name, $date_of_birth, $email, $address, $postcode, $phone_number)) {

            // Refresh user information
            $user = get_user($_SESSION['user_id']);
            $confirmation_message = "Profile has been updated successfully.";
            send_profile_updated_email($user['email']);
        } else {
            $errors[] = "Profile failed to be updated.";
        }


        $password_changed = false;

        // checks if new password has been added
        if (!empty($new_password) and !empty($confirm_new_password)) $password_changed = true;

        if ($password_changed) {
            if (update_user_password($_SESSION['user_id'], $new_password)) {
                $confirmation_message = "Password has been updated successfully.";
                send_password_updated_email($user['email']);
            } else {
                $errors[] = "Password failed to be updated.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<body class="d-flex flex-column min-vh-100">
    <div class="container pt-5 pb-5 d-flex justify-content-center">
        <div class="card custom-card">
            <div class="card-header">
                <h1>Account Information</h1>
            </div>
            <div class="card-body custom-card-body">
                <?php if (!empty($confirmation_message)): ?>
                    <div id="confirmation_message$confirmation_message" class="alert alert-success alert-dismissible fade show">
                        <?php echo $confirmation_message; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form method="post">
                    <div class="form-group">
                        <label for="username"><strong>Username:</strong></label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="first_name"><strong>First Name:</strong></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name"><strong>Last Name:</strong></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth"><strong>Date of Birth:</strong></label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="address"><strong>Address:</strong></label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="postcode"><strong>Postcode:</strong></label>
                        <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo htmlspecialchars($user['postcode']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_number"><strong>Phone Number:</strong></label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="new_password"><strong>New Password:</strong></label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_new_password"><strong>Confirm New Password:</strong></label>
                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
                    </div>
                    <div class="pt-4 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary justify">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#confirmation_message$confirmation_message').alert('close');
            }, 5000);
        });
    </script>

    <?php include("footer.php"); ?>
</body>

</html>