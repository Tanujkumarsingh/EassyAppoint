<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'company') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyAppoint</title>

    <link rel="stylesheet" href="navbar.css" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
      integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <!-- Header  -->
    <header>
      <div class="navbar">
        <div class="navbar-logo">
          <img src="logo.png" alt="EasyAppoint" />
        </div>
        <a href="index.php">DashBoard</a>
        <a id="Post_Ad">Post Ad</a>
        <a href="view_ads.php">Ads</a>
        <a href="logout.php">Logout</a>
      </div>
    </header>

    <div class="container" id="PostAd" style = "display : none">
      <h1 class="form-title">Post Ad</h1>
      <form action="post_ad.php" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <i class="fa-solid fa-image"></i>
          <img
            id="preview"
            src=""
            alt="Preview Image"
            style="display: none; width: 150px"
          />
          <input type="file" id="imageInput" name="image" accept="image/*" required/>
          <label for="imageInput">Upload Image</label>
        </div>
        <div class="input-group">
            <i class="fa-solid fa-briefcase"></i>
          <input
            type="text"
            name="ServiceName"
            id="ServiceName"
            placeholder="Service Name"
            required
          />
          <label for="ServiceName">Service Name</label>
        </div>
        <div class="input-group">
            <i class="fa-solid fa-indian-rupee-sign"></i>
          <input
            type="text"
            name="Price"
            id="Price"
            placeholder="Price"
            required
          />
          <label for="Price">Price</label>
        </div>

        <div class="input-group">
            <i class="fa-solid fa-align-left"></i>
          <textarea
            name="Description"
            id="Description"
            placeholder="Description"
            rows="4"
            required
          ></textarea>
          <label for="Description">Description</label>
        </div>
        <button id="addButton">Add</button>
      </form>
    </div>

    <script src="company.js"></script>
  </body>
</html>

