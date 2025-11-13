<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LOG IN | PMDL</title>

  <link rel="stylesheet" href="styles/registerlog.css" />
  <link rel="stylesheet" href="styles/global/global.css" />
  <link rel="stylesheet" href="styles/global/footer.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <div class="left">
      <i class="fas fa-user-graduate"></i>
      <span class="logo-text">PMDL</span>
    </div>

    <nav class="center navbar">
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="jobs.html">Jobs</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="abtus.html">About Us</a></li>
      </ul>
    </nav>

    <div class="right">
      <a href="registerlog.php" class="btn2 login">Log In</a>
    </div>
  </header>

  <div class="container" id="register" style="display:none;">
    <h1 class="form-title">Register</h1>
    <form method="post" action="php/regilog.php">
      <div class="input-group">
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" placeholder="Last Name" required>
      </div>
      <div class="input-group">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" placeholder="First Name" required>
      </div>
      <div class="input-group">
        <label for="mname">Middle Name</label>
        <input type="text" name="mname" id="mname" placeholder="Middle Name" required>
      </div>
      <div class="input-group">
        <label for="bday">Birthday (MM/DD/YYYY)</label>
        <input type="date" name="bday" id="bday" placeholder="Birthday" required>
      </div>
      <div class="input-group">
        <label for="emal">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
      </div>
      <input type="submit" class="btn1" value="Register" name="register">
    </form>
    <div class="links">
      <p>Already Have Account ?</p>
      <button id="LoginButton">Log In</button>
    </div>
  </div>

  <div class="container" id="login">
    <h1 class="form-title">Log In</h1>
    <form method="post" action="php/regilog.php">
      <div class="input-group">
        <label for="emal">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
      </div>
      <p class="recover" id="ForgotButton">
        <a href="#">Forgot the Password?</a>
      </p>
      <input type="submit" class="btn1" value="Log In" name="login">
    </form>
    <div class="links">
      <p>Don't have account yet?</p>
      <button id="RegisterButton">Register</button>
    </div>
  </div>
  <!-- forgot pass -->
  <div class="container" id="forgot-password">
    <h1 class="form-title">Reset the Password</h1>
    <form method="post" action="php/send-reset-password.php">
      <div class="input-group">
        <label for="emal">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>

        <button class="btn1">Send</button>
      </div>
    </form>
  </div>

  <!-- ----------------------POP UP----------------------- -->
  <div id="errorPopup" class="popup">
    <div class="popup-content">
      <h3>Invalid Credentials</h3>
      <p>The email or password you entered is incorrect. Please try again.</p>
      <button id="closeBtn">OK</button>
    </div>
  </div>

  <footer class="footer">
    <div class="footer-container">
      <!-- Column 1 -->
      <div class="footer-col">
        <h3>PMDL</h3>
        <p>
          Your trusted partner in finding overseas employment opportunities
          for Filipino workers.
        </p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

      <!-- Column 2 -->
      <div class="footer-col">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Job Listings</a></li>
          <li><a href="#">Our Services</a></li>
          <li><a href="#">About Us</a></li>
        </ul>
      </div>

      <!-- Column 3 -->
      <div class="footer-col">
        <h4>For Job Seekers</h4>
        <ul>
          <li><a href="#">Create Account</a></li>
          <li><a href="#">Login</a></li>
          <li><a href="#">Browse Jobs</a></li>
          <li><a href="#">Application Guide</a></li>
        </ul>
      </div>

      <!-- Column 4 -->
      <div class="footer-col">
        <h4>Contact Us</h4>
        <p><i class="fas fa-phone"></i> +63 (2) 8123 4567</p>
        <p><i class="fas fa-envelope"></i> info@pmdl.com</p>
        <p>
          <i class="fas fa-map-marker-alt"></i> 123 Recruitment Plaza, Makati
          City, Philippines
        </p>
      </div>
    </div>

    <div class="lastfooter">
      <h4>© 2025 PMDL Recruitment Agency. All rights reserved.</h4>
    </div>
  </footer>

  <script src="jsfile/regislog.js"></script>

</body>

</html>