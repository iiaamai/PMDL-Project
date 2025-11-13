<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/connect.php";

$sql = "SELECT * FROM register
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
  die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
  die("token has expired");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PMDL | RESET PASSWORD</title>
  <link rel="stylesheet" href="/styles/home.css" />
  <link rel="stylesheet" href="/styles/global/header.css" />
  <link rel="stylesheet" href="/styles/global/footer.css" />
  <link rel="stylesheet" href="/styles/global/global.css" />
  <link rel="stylesheet" href="/styles/registerlog.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <header class="header">
    <div class="left">
      <i class="fas fa-user-graduate"></i>
      <span class="logo-text">PMDL</span>
    </div>
  </header>

  <!-- reset -->


  <div class="container">
    <h1 class="form-title">Reset Password</h1>
    <form method="post" action="process-reset-password.php">

      <div class="input-group">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">New password</label>
        <input type="password" id="password" name="password">

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation" name="password_confirmation">

        <button class="btn1">Send</button>
      </div>
    </form>
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
          <li><a href="home.php">Home</a></li>
          <li><a href="jobs.html">Job Listings</a></li>
          <li><a href="services.html">Our Services</a></li>
          <li><a href="abtus.html">About Us</a></li>
        </ul>
      </div>

      <!-- Column 3 -->
      <div class="footer-col">
        <h4>For Job Seekers</h4>
        <ul>
          <li><a href="registerlog.php">Create Account</a></li>
          <li><a href="registerlog.php">Login</a></li>
          <li><a href="jobs.html">Browse Jobs</a></li>
          <li><a href="services.html">Application Guide</a></li>
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

</body>

</html>