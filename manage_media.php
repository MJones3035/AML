<?php
require_once("header.php");
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

function add_media($cover_img, $title, $author, $year, $description, $stock, $media_type_id) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = 'INSERT INTO media (cover_img, title, author, published_year, description, stock, media_type_id) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssis', $cover_img, $title, $author, $year, $description, $stock, $media_type_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}


function update_media($media_id, $cover_img, $title, $author, $year, $description, $stock, $media_type_id) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($cover_img) {
        $sql = 'UPDATE media SET cover_img=?, title=?, author=?, published_year=?, description=?, stock=?, media_type_id=? WHERE media_id=?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssis', $cover_img, $title, $author, $year, $description, $stock, $media_type_id, $media_id);
    } else {
        $sql = 'UPDATE media SET title=?, author=?, published_year=?, description=?, stock=?, media_type_id=? WHERE media_id=?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssisi', $title, $author, $year, $description, $stock, $media_type_id, $media_id);
    }
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

function delete_media($media_id) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = 'DELETE FROM media WHERE media_id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $media_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_media'])) {
        $cover_img = $_FILES['cover_img']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($cover_img);
        move_uploaded_file($_FILES['cover_img']['tmp_name'], $target_file);

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
        $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT);
        $media_type_id = filter_input(INPUT_POST, 'media_type_id', FILTER_SANITIZE_NUMBER_INT);

        add_media($target_file, $title, $author, $year, $description, $stock, $media_type_id);
        header('Location: manage_media.php');
        exit;
    } elseif (isset($_POST['update_media'])) {
        $media_id = filter_input(INPUT_POST, 'media_id', FILTER_SANITIZE_NUMBER_INT);
        $cover_img = $_FILES['cover_img']['name'];
        $target_file = null;

        if (!empty($cover_img)) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($cover_img);
            move_uploaded_file($_FILES['cover_img']['tmp_name'], $target_file);
        }

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
        $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT);
        $media_type_id = filter_input(INPUT_POST, 'media_type_id', FILTER_SANITIZE_NUMBER_INT);

        update_media($media_id, $target_file, $title, $author, $year, $description, $stock, $media_type_id);
        header('Location: manage_media.php');
        exit;
    } elseif (isset($_POST['delete_media'])) {
        $media_id = filter_input(INPUT_POST, 'media_id', FILTER_SANITIZE_NUMBER_INT);
        delete_media($media_id);
        header('Location: manage_media.php');
        exit;
    }
}

$media_inventory = get_media_inventory();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="d-flex flex-column ">
<div class="container pt-2">
    <div class="col-12">
        <h1 style="text-align: center;">Manage Media</h1>
        <table class="table table-striped mt-4">
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
                    <th>Actions</th>
                </tr>
                
            </thead>
            <tbody>
                <?php foreach ($media_inventory as $media): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($media['media_id']); ?></td>
                        <td>
                            <?php if (!empty($media['cover_img']) && file_exists("images/{$media['cover_img']}")): ?>
                                <img src="images/<?php echo htmlspecialchars($media['cover_img']); ?>" alt="Cover Image" height="100px">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($media['title']); ?></td>
                        <td><?php echo htmlspecialchars($media['author']); ?></td>
                        <td><?php echo htmlspecialchars($media['published_year']); ?></td>
                        <td><?php echo htmlspecialchars($media['description']); ?></td>
                        <td><?php echo htmlspecialchars($media['stock']); ?></td>
                        <td><?php echo htmlspecialchars($media['media_type_id']); ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal" data-id="<?php echo htmlspecialchars($media['media_id']); ?>" data-title="<?php echo htmlspecialchars($media['title']); ?>" data-author="<?php echo htmlspecialchars($media['author']); ?>" data-year="<?php echo htmlspecialchars($media['published_year']); ?>" data-description="<?php echo htmlspecialchars($media['description']); ?>" data-stock="<?php echo htmlspecialchars($media['stock']); ?>" data-media_type_id="<?php echo htmlspecialchars($media['media_type_id']); ?>">Update</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo htmlspecialchars($media['media_id']); ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <form method="POST" action="manage_media.php" enctype="multipart/form-data">
                        <td></td>
                        <td><input type="file" class="form-control" id="cover_img" name="cover_img"></td>
                        <td><input type="text" class="form-control" id="title" name="title" required></td>
                        <td><input type="text" class="form-control" id="author" name="author" required></td>
                        <td><input type="number" class="form-control" id="year" name="year" required></td>
                        <td><input type="text" class="form-control" id="description" name="description" required></td>
                        <td><input type="number" class="form-control" id="stock" name="stock" required></td>
                        <td><input type="number" class="form-control" id="media_type_id" name="media_type_id" required></td>
                        <td><button type="submit" class="btn btn-primary" name="add_media">Add Media</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="manage_media.php" enctype="multipart/form-data">
                    <input type="hidden" id="update_media_id" name="media_id">
                    <div class="form-group">
                        <label for="update_cover_img">Cover Image</label>
                        <input type="file" class="form-control" id="update_cover_img" name="cover_img">
                    </div>
                    <div class="form-group">
                        <label for="update_title">Title</label>
                        <input type="text" class="form-control" id="update_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="update_author">Author</label>
                        <input type="text" class="form-control" id="update_author" name="author" required>
                    </div>
                    <div class="form-group">
                        <label for="update_year">Year</label>
                        <input type="number" class="form-control" id="update_year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="update_description">Description</label>
                        <input type="text" class="form-control" id="update_description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="update_stock">Stock</label>
                        <input type="number" class="form-control" id="update_stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="update_media_type_id">Media Type</label>
                        <input type="number" class="form-control" id="update_media_type_id" name="media_type_id" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_media">Update Media</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this media item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#updateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var media_id = button.data('id');
        var title = button.data('title');
        var author = button.data('author');
        var year = button.data('year');
        var description = button.data('description');
        var stock = button.data('stock');
        var media_type_id = button.data('media_type_id');

        var modal = $(this);
        modal.find('#update_media_id').val(media_id);
        modal.find('#update_title').val(title);
        modal.find('#update_author').val(author);
        modal.find('#update_year').val(year);
        modal.find('#update_description').val(description);
        modal.find('#update_stock').val(stock);
        modal.find('#update_media_type_id').val(media_type_id);
    });
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var media_id = button.data('id');
        var modal = $(this);
        modal.find('#confirmDelete').data('id', media_id);
    });

    $('#confirmDelete').on('click', function () {
        var media_id = $(this).data('id');
        var form = $('<form method="POST" action="manage_media.php" style="display:none;">' +
            '<input type="hidden" name="media_id" value="' + media_id + '">' +
            '<input type="hidden" name="delete_media" value="1">' +
            '</form>');
        $('body').append(form);
        form.submit();
    });
</script>
</body>
</html>