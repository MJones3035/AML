<?php
include_once 'accountSQL.php';

session_start(); 

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    echo "You are not logged in.";
    exit;
}
else {
    $user = GetAccount($_SESSION['userID']);
}


?>


<body>
    <?php include("userHeader.php"); ?> 

    <main class="container pt-5 pb-5 d-flex flex-wrap flex-column align-content-center">
        <h1>Account Information</h1>
        <div class="d-flex flex-column flex-wrap align-content-center">
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['date_of_birth']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            <p><strong>Postcode:</strong> <?php echo htmlspecialchars($user['postcode']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        </div>
    </main>

    <?php include("footer.php"); ?> 
</body>
</html>