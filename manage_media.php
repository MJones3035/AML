<?php
include_once("user_sql.php");

function get_media_inventory() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = 'SELECT * FROM media';
    $result = $conn->query($sql);
    $media_inventory = [];
    while ($row = $result->fetch_assoc()) {
        $media_inventory[] = $row;
    }
    $conn->close();
    return $media_inventory;
}

function add_media($cover_img, $title, $author, $year, $description, $stock, $media_type_id, $favourite) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = 'INSERT INTO media (cover_img, title, author, published_year, description, stock, media_type_id, favourite) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssiis', $cover_img, $title, $author, $year, $description, $stock, $media_type_id, $favourite);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_media'])) {
    $cover_img = filter_input(INPUT_POST, 'cover_img', FILTER_SANITIZE_SPECIAL_CHARS);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT);
    $media_type_id = filter_input(INPUT_POST, 'media_type_id', FILTER_SANITIZE_NUMBER_INT);
    $favourite = filter_input(INPUT_POST, 'favourite', FILTER_SANITIZE_SPECIAL_CHARS);

    add_media($cover_img, $title, $author, $year, $description, $stock, $media_type_id, $favourite);
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
                        <th>Cover Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Media Type</th>
                        <th>Favourite</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($media_inventory as $media): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($media['media_id']); ?></td>
                            <td><?php echo htmlspecialchars($media['cover_img']); ?></td>
                            <td><?php echo htmlspecialchars($media['title']); ?></td>
                            <td><?php echo htmlspecialchars($media['author']); ?></td>
                            <td><?php echo htmlspecialchars($media['published_year']); ?></td>
                            <td><?php echo htmlspecialchars($media['description']); ?></td>
                            <td><?php echo htmlspecialchars($media['stock']); ?></td>
                            <td><?php echo htmlspecialchars($media['media_type_id']); ?></td>
                            <td><?php echo htmlspecialchars($media['favourite']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>