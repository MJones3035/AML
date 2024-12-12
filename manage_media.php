<?php
include_once("user_sql.php");


function get_media_inventory() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = 'SELECT * FROM media_details';
    $result = $conn->query($sql);
    $media_inventory = [];
    while ($row = $result->fetch_assoc()) {
        $media_inventory[] = $row;
    }
    $conn->close();
    return $media_inventory;
}

function add_media($title, $author, $year, $genre, $type) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = 'INSERT INTO media_details (title, author, year, genre, type) VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssiss', $title, $author, $year, $genre, $type);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_media'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
    $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_SPECIAL_CHARS);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);

    add_media($title, $author, $year, $genre, $type);
    header('Location: manage_media.php');
    exit;
}

$media_inventory = get_media_inventory();

?>




<!DOCTYPE html>
<html lang="en">
<?php require_once("header.php"); ?>
<body class="d-flex flex-column ">
    <div class="container pt-2">
        <div class="col-12">
            <h1 style="text-align: center;">Manage Media</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Media ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Genre</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($media_inventory as $media): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($media['media_id']); ?></td>
                            <td><?php echo htmlspecialchars($media['title']); ?></td>
                            <td><?php echo htmlspecialchars($media['author']); ?></td>
                            <td><?php echo htmlspecialchars($media['year']); ?></td>
                            <td><?php echo htmlspecialchars($media['genre']); ?></td>
                            <td><?php echo htmlspecialchars($media['type']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <form method="post">
                    <tr>
                            <td></td>
                            <td><input type="text" class="form-control" name="title" placeholder="Title" required></td>
                            <td><input type="text" class="form-control" name="author" placeholder="Author" required></td>
                            <td><input type="number" class="form-control" name="year" placeholder="Year" required></td>
                            <td><input type="text" class="form-control" name="genre" placeholder="Genre" required></td>
                            <td>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="Book">Book</option>
                                    <option value="Game">Game</option>
                                    <option value="Movie">Movie</option>
                                    <option value="Music">Music</option>
                                </select>
                            </td>
                            <td><button type="submit" name="add_media" class="btn btn-primary">Add Media</button></td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>