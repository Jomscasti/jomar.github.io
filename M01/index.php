<?php
include('connect.php');

// Check if the insert button was clicked
if (isset($_POST['btnSubmitPost'])) {
  $postID = $_POST['postID'];
  $userID = $_POST['userID'];
  $content = $_POST['content'];
  $dateTime = $_POST['dateTime'];
  $privacy = $_POST['privacy'];

  // Insert query for a new post
  $insertQuery = "INSERT INTO posts(postID, userID, content, dateTime, privacy) VALUES ('$postID', '$userID', '$content', '$dateTime', '$privacy')";
  executeQuery($insertQuery);

    // Redirect to avoid form resubmission on refresh
    header('Location: index.php');
    exit();
}

$query = "SELECT * FROM posts";
$result = executeQuery($query);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parrhesia | A World of Freedom</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark retroNavbar fixed-top">
        <div class="container-fluid">
 <a class="navbar-brand retroBrand" href="#">PARRHESIA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="navLink active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="navLink" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="navLink" href="#post">Posts</a>
          </li>
          <li class="nav-item">
            <a class="navLink" href="#add">Add</a>
          </li>
          <li class="nav-item">
            <a class="navLink" href="#footer">Contact</a>
          </li>
        </ul>
      </div>
  </nav>

  <video autoplay muted loop class="backgroundVideo">
    <source src="assets/retro.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <div class="container">
    <div class="display3" id="about">
      Parrhesia
    </div>
    <p class="introText">
      A world where all can be free to express themselves without any hesitations.
          <img class="card w-100 rounded mt-2 content-center-align" src="https://t4.ftcdn.net/jpg/09/75/00/69/360_F_975006975_LV0aiigkcjOB0jbimmzZZxaXlVqvjTsI.jpg">
    </p>

        <hr class="my-4">

    <div class="row">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($post = mysqli_fetch_assoc($result)) {
          ?>

          <div class="col-12 col-md-6 col-lg-4" id="post">
            <div class="card my-3">
              <div class="card-body">
                <h5 class="cardTitle">Post ID: <?php echo $post['postID'] ?></h5>
                <h6 class="cardSubtitle text-body-secondary">User ID: <?php echo $post['userID'] ?></h6>
                <p class="cardText"><?php echo $post['content'] ?></p>
                <p class="cardText"><small>Date: <?php echo $post['dateTime'] ?></small></p>
                <p class="cardText"><small>Privacy: <?php echo $post['privacy'] ?></small></p>
              </div>
            </div>
          </div>

          <?php
        }
      } else {
        echo "<p>No posts available.</p>";
      }
      ?>
    </div>

  <form method="post" class="my-4" id="add">
    <h5 class="mb-3">Add a New Post</h5>
    <input type="number" name="postID" placeholder="Post ID" class="form-control mb-2" required step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
    <input type="number" name="userID" placeholder="User ID" class="form-control mb-2" required step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
    <textarea name="content" placeholder="Content" class="form-control mb-2" required></textarea>
    <input type="date" name="dateTime" class="form-control mb-2" required>  
      <select name="privacy" class="form-control mb-2" required>
          <option value="public">Public</option>
          <option value="private">Private</option>
      </select>
      <button type="submit" name="btnSubmitPost" class="btn btn-primary">Submit Post</button>
  </form>

     <?php include('assets/footer.php') ?>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
