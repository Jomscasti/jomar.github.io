<?php
include('connect.php');

$postID = $_GET['postID'];

if (isset($_POST['btnUpdatePost'])) {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $privacy = $_POST['privacy'];

    $updateQuery = "UPDATE posts SET content = '$content', privacy = '$privacy' WHERE postID = '$postID'";
    executeQuery($updateQuery);

    header('Location: index.php');
}

$query = "SELECT * FROM posts WHERE postID = '$postID'";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <video autoplay muted loop class="backgroundVideo">
        <source src="assets/retro.mp4" type="video/mp4">
    </video>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-4">
                    <h2 class="display3">Edit Post</h2>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($post = mysqli_fetch_assoc($result)) {
                            ?>

                            <form method="post" class="mt-4">
                                <textarea class="form-control mb-3" name="content" placeholder="Write your content here..." required><?php echo $post['content'] ?></textarea>
                                <select name="privacy" class="form-control mb-3" required>
                                    <option value="public" <?php echo $post['privacy'] == 'public' ? 'selected' : ''; ?>>Public</option>
                                    <option value="private" <?php echo $post['privacy'] == 'private' ? 'selected' : ''; ?>>Private</option>
                                </select>
                                <button class="btn" type="submit" name="btnUpdatePost">
                                    Save
                                </button>
                            </form>

                            <?php
                        }
                    }
                    ?>
                </div>
                        <?php include('assets/footer.php'); ?>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
