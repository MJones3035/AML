<?php

class BorrowTest extends PHPUnit\Framework\TestCase
{
    private $db_conn;
    private $testUserId = 31; 
    private $testMediaId = 7; 

    // Setup the database connection before running tests
    protected function setUp(): void
    {
        // Database connection
        $this->db_conn = new mysqli('localhost', 'root', '', 'aml'); // Replace with your database credentials
        if ($this->db_conn->connect_error) {
            die("Database connection failed: " . $this->db_conn->connect_error);
        }

        // Set up a session for the test
        $_SESSION['user_id'] = $this->testUserId;
    }

    public function testBorrowInsertion(): void
    {
        $_POST['id'] = $this->testMediaId;
        $media_id = $_POST['id'];
        $user = $_SESSION['user_id'];
        $query = "INSERT INTO `borrow` (`media_id`, `user_id`, `borrowed_date`, `due_date`) 
                  VALUES ($media_id, $user, NOW(), NOW() + INTERVAL 14 DAY);";
        $result = $this->db_conn->query($query);

        $this->assertTrue($result, "Failed to insert borrow record into the database");

        // Verify the record in the database
        $checkQuery = "SELECT * FROM borrow WHERE media_id = $media_id AND user_id = $user";
        $resultCheck = $this->db_conn->query($checkQuery);
        $this->assertEquals(1, $resultCheck->num_rows, "Borrow record not found in the database");
    }
}
