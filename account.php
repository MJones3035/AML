<?php
include 'database.php';

session_start(); 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in.";
    exit;
}

// Get the current user's ID from the session
$user_id = $_SESSION['user_id'];

// query users information
$query = "SELECT * FROM user_details WHERE user_id = ?";
$stmt = $db_conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows == 0) {
    echo "User not found.";
    exit;
}

// Fetch the user's information
$user = $result->fetch_assoc();

// Close the statement and connection
$stmt->close();
$db_conn->close();
?>


<body>
    <?php include("userheader.php"); ?> 

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