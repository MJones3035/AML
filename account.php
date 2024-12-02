<?php
include_once 'accountSQL.php';
//include_once 'session.php';
include("userHeader.php");

//session_start(); 

// Check if the user is logged in
// if (!isset($_SESSION['userID'])) {
//     echo "You are not logged in.";
//     exit;
// }
// else {
//     $user = GetAccount($_SESSION['userID']);
// }

$user = GetAccount($_SESSION['userID']);

$confirmationMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $date_of_birth = filter_input(INPUT_POST, 'date_of_birth', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
    $postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_SPECIAL_CHARS);
    $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate the input
    $errors = [];
    if (empty($first_name)) $errors[] = "First name is required.";
    if (empty($last_name)) $errors[] = "Last name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($address)) $errors[] = "Address is required.";
    if (empty($postcode)) $errors[] = "Postcode is required.";
    if (empty($phone_number)) $errors[] = "Phone number is required.";

    if (empty($errors)) {
        // Update user information in the database
        UpdateAccount($_SESSION['userID'], $first_name, $last_name, $date_of_birth, $email, $address, $postcode, $phone_number);

        // Refresh user information
        $user = GetAccount($_SESSION['userID']);
        $confirmationMessage = "Profile has been updated successfully.";
    }
}

?>


<body>
    <div class="container pt-5 pb-5 d-flex justify-content-center">
        <div class="card custom-card">
            <div class="card-header">
                <h1>Account Information</h1>
            </div>
            <div class="card-body custom-card-body">
                <?php if (!empty($confirmationMessage)): ?>
                    <div id="confirmationMessage" class="alert alert-success alert-dismissible fade show">
                        <?php echo $confirmationMessage; ?>
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
                $('#confirmationMessage').alert('close');
            }, 5000);
        });
    </script>
    
    <?php include("footer.php"); ?> 
</body>
</html>