<?php

class MediaFavouriteTest extends PHPUnit\Framework\TestCase
{
    public function testUpdateFavourite()
    {
        // Include the database connection script
        include_once 'database.php';

        // Simulate $_GET variables
        $_GET['id'] = 7;
        $_GET['favourite'] = 1;
        global $db_conn;
        $mockDb = $this->createMock(mysqli::class);
        $db_conn = $mockDb;

        // Expect the query to be executed with correct SQL
        $mockDb->expects($this->once())
            ->method('query')
            ->with($this->stringContains("UPDATE media SET favourite = 1 WHERE media_id = 7"))
            ->willReturn(true);

        // Suppress header() calls by using output buffering
        ob_start();
        include 'set_fav.php';
        $output = ob_get_clean();

        // Assert that the script executed without issues
        $this->assertEmpty($output, "The script should not produce output.");
    }
}
