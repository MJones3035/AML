<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../manage_media.php';

class ManageMediaTest extends TestCase {
    private $db_conn;

    protected function setUp(): void {
        $this->db_conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $this->db_conn->query("SET foreign_key_checks = 0");
        $this->db_conn->query("TRUNCATE TABLE borrow");
        $this->db_conn->query("TRUNCATE TABLE media");
        $this->db_conn->query("SET foreign_key_checks = 1");
    }

    protected function tearDown(): void {
        $this->db_conn->close();
    }

    public function testAddMedia() {
        $cover_img = 'test_image.jpg';
        $title = 'Test Title';
        $author = 'Test Author';
        $year = 2023;
        $description = 'Test Description';
        $stock = 10;
        $media_type_id = 1;

        add_media($cover_img, $title, $author, $year, $description, $stock, $media_type_id);

        $result = $this->db_conn->query("SELECT * FROM media WHERE title = 'Test Title'");
        $this->assertEquals(1, $result->num_rows, 'Testing if the media item exists in the database');
    }


    public function testDeleteMedia() {
        $cover_img = 'test_image.jpg';
        $title = 'Test Title';
        $author = 'Test Author';
        $year = 2023;
        $description = 'Test Description';
        $stock = 10;
        $media_type_id = 1;

        add_media($cover_img, $title, $author, $year, $description, $stock, $media_type_id);

        $result = $this->db_conn->query("SELECT * FROM media WHERE title = 'Test Title'");
        $media = $result->fetch_assoc();

        delete_media($media['media_id']);

        $result = $this->db_conn->query("SELECT * FROM media WHERE title = 'Test Title'");
        $this->assertEquals(0, $result->num_rows, 'Testing if the media item no longer exists in the database');
    }
}