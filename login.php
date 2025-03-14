<?php
session_start();
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
        <a id="HomeButton">Home</a>
        <a id="RegisterButton">Register</a>
        <a id="LoginButton">Login</a>
      </div>
    </header>
                    
    <!-- client Registration -->

    <div class="container" id="signUpClient" style="display: none;">
      <h1 class="form-title">Register As Client</h1>
      <form action="auth/register_client.php" method="post">
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input
            type="text"
            name="firstname"
            id="firstname"
            placeholder="firstname"
            required
          />
          <label for="firstname">firstname</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input
            type="text"
            name="Lastname"
            id="Lastname"
            placeholder="lastname"
            required
          />
          <label for="Lastname">lastname</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-phone"></i>
          <input
            type="text"
            name="Phone"
            id="Phone"
            placeholder="Phone no."
            required
          />
          <label for="Phone">Phone no.</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-envelope"></i>
          <input
            type="text"
            name="Email"
            id="Email"
            placeholder="email"
            required
          />
          <label for="Email">email</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-lock"></i>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="password"
            required
          />
          <label for="password">password</label>
        </div>
        <input type="submit" class="btn" value="sign Up" name="signUp" />
      </form>
      <p class="or">--------or--------</p>
      <div class="icons">
        <i class="fa-brands fa-google"></i>
        <i class="fa-brands fa-facebook"></i>
      </div>
      <div class="links">
        <p>Already have an Account ?</p>
        <button id="signInButtonAsClient">Sign In</button>
      </div>
    </div>

    <!-- company Registration -->
    <div class="container" id="signUpCompany" style="display: none;">
      <h1 class="form-title">Register As Coppany</h1>
      <form action="auth/register_company.php" method="post">
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input
            type="text"
            name="firstname"
            id="firstname"
            placeholder="firstname"
            required
          />
          <label for="firstname">firstname</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input
            type="text"
            name="Lastname"
            id="Lastname"
            placeholder="lastname"
            required
          />
          <label for="Lastname">lastname</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-phone"></i>
          <input
            type="text"
            name="Phone"
            id="Phone"
            placeholder="Phone no."
            required
          />
          <label for="Phone">Phone no.</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-location-crosshairs"></i>
          <input
            type="text"
            name="District"
            id="District"
            placeholder="District"
            required
          />
          <label for="District">District</label>
        </div>

        <div class="input-group">
          <i class="fa-solid fa-envelope"></i>
          <input
            type="text"
            name="Email"
            id="Email"
            placeholder="email"
            required
          />
          <label for="Email">email</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-lock"></i>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="password"
            required
          />
          <label for="password">password</label>
        </div>
        <input type="submit" class="btn" value="sign Up" name="signUp" />
      </form>
      <p class="or">--------or--------</p>
      <div class="icons">
        <i class="fa-brands fa-google"></i>
        <i class="fa-brands fa-facebook"></i>
      </div>
      <div class="links">
        <p>Already have an Account ?</p>
        <button id="signInButtonAsCompany">Sign In</button>
      </div>
    </div>

    <!-- for sign in past user which already has an account -->
    <div class="container" id="signIn">
      <h1 class="form-title">Sign In</h1>
      <form action="auth/login.php" method="post">
        <div class="input-group">
          <i class="fa-solid fa-envelope"></i>
          <input
            type="text"
            name="Email"
            id="Email"
            placeholder="email"
            required
          />
          <label for="Email">email</label>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-lock"></i>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="password"
            required
          />
          <label for="password">password</label>
        </div>
        <p class="recover">
          <a href="#">Recover Password</a>
        </p>
        <input type="submit" class="btn" value="Sign In" name="signIn" />
      </form>
      <p class="or">--------or--------</p>
      <div class="icons">
        <i class="fa-brands fa-google"></i>
        <i class="fa-brands fa-facebook"></i>
      </div>
      <div class="links">
        <p>Don't have an Account yet ?</p>
        <button id="signUpButton">Sign Up</button>
      </div>
    </div>

        <!-- to register as client or company -->
    <div class="container" id="ABC" style="display: none;">
      <h1>Welcome to EasyAppoint</h1>
      <h2>A service booking system</h2>
      <h3>Choose your user type to get started</h3>

      <div class="check">
        <button id="RegisterAsCompany">Register as a Company</button>
        <button id="RegisterAsClient">Register as a Client</button>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
