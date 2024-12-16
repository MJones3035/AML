<?php

//redo
//include_once "upload.php";

$error_message = $error_media_id = "";
$error_name = "";

$all_fields = TRUE;

if (isset($_POST['submit'])) {

    // security measures
    $media_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

    //check for empty inputs
    if (empty($_POST['id'])) {

        $error_name = "ID is mandatory";
        $all_fields = FALSE;

    } elseif (!$name) {
        $error_name = "Invalid ID";
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
                    <h2 class="text-center mb-4">Delete Media</h2>
                    <form action="delete.php" method="post">
                        <div class="form-group mb-3">
                            <label for="id" class="form-label">Media ID</label>
                            <input type="text" class="form-control" id="id" name="delete_id_btn" maxlength="60"/>
                            <span class="text-danger"><?php //echo $error_name; ?></span>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-100" name="delete_id_btn" value="true">Delete Data</button>
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