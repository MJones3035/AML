<?php
session_start();
//redo
//include_once "upload.php";

$error_message = $error_media_id = $error_name = $error_file = $error_type = "";

$all_fields = TRUE;

if (isset($_POST['submit'])) {

    // security measures
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $file = filter_input(INPUT_POST, 'file', FILTER_SANITIZE_SPECIAL_CHARS);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);

    //check for empty inputs
    if (empty($_POST['name'])) {

        $error_name = "name is mandatory";
        $all_fields = FALSE;

    } elseif (!$name) {
        $error_name = "Invalid name";
        $all_fields = FALSE;
    }

    if (empty($_POST['file'])) {

        $error_file = "File is mandatory";

        $all_fields = FALSE;
    } elseif (!$file) {
        $error_file = "Invalid URL";
        $all_fields = FALSE;
    }

    if (empty($_POST['type'])) {

        $error_type = "Type is mandatory";

        $all_fields = FALSE;
    } elseif (!$type) {
        $error_type = "Invalid type";
        $all_fields = FALSE;
    }
}

?>


<!--html-->


<!DOCTYPE html>
<html lang="en">

<body class="d-flex flex-column min-vh-100">

    <?php include("header.php"); ?>

    <!--form-->
    <main class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form-container border p-4 rounded shadow">
                    <h2 class="text-center mb-4">Upload Media</h2>
                    <form action="upload.php" method="post" enctype ="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Media Name</label>
                            <input type="text" class="form-control" id="name" name="name" maxlength="60"
                                placeholder="Enter media name" value=<?php if (isset($name)) {
                                                                            echo $name;
                                                                        } ?>>
                            <span class="text-danger"><?php echo $error_name; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file" maxlength="60" placeholder="Drop file here..."
                                value=<?php if (isset($file)) {
                                            echo $file;
                                        }  ?>>
                            <span class="text-danger"><?php echo $error_file; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="type" class="form-label">Media Type</label>
                            <br>
                            <input type="radio" name="type" id="radio_book" value="book" />
                            <label for="radio_book">Book</label>

                            <input type="radio" name="type" id="radio_movie" value="movie" />
                            <label for="radio_movie">Movie</label>

                            <input type="radio" name="type" id="radio_newspaper" value="newspaper" />
                            <label for="radio_newspaper">Newspaper</label>

                            <input type="radio" name="type" id="radio_file" value="file" />
                            <label for="radio_file">Generic File</label>
                            <span class="text-danger"><?php echo $error_type; ?></span>
                        </div>
                        <!--
                        <div class="form-group mb-3">
                            <label for="type" class="form-label">Media Type</label>
                            <input type="text" class="form-control" id="type" name="type" maxlength="60" placeholder="Book, film, etc."
                                value=<?php if (isset($type)) {
                                            echo $type;
                                        }  ?>>
                            <span class="text-danger"><?php echo $error_type; ?></span>
                        </div>-->
                        <div>
                            <button type="submit" class="btn btn-primary w-100" name="submit" value="true">Submit</button>
                            <span class="text-danger"><?php echo $error_message; ?></span>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>

</html>