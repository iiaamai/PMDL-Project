<?php

session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
  // If not logged in, send back to login page
  header("Location: registerlog.php");
  exit();
}

$userEmail = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>APPLICATION FORM</title>
  <link rel="stylesheet" href="styles/user-dashboard/applicationsf.css" />
  <link rel="stylesheet" href="styles/user-dashboard/header.css" />
  <link rel="stylesheet" href="styles/global/global.css" />
</head>

<body class="ap01">
  <header class="userapp">
    <div class="appl">
      <a class="cc">PMDL</a>
      <a class="user10">Logged in: <?php echo htmlspecialchars($userEmail); ?></a>
    </div>
  </header>
  <button class="backhome"><a href="userdash.php">HOME</a></button>

  <div class="form-container">
    <h2 class="form-title">PMDL APPLICATION FORM</h2>

    <!-- Personal Information -->
    <form method="post" action="php/application.php">
      <div class="form-section">
        <div class="section-header">I. PERSONAL INFORMATION</div>
        <p class="note">
          Please ensure that the information you provide aligns with your
          submitted documents.
        </p>

        <div class="form-grid" id="Application_Form">
          <div>
            <label for="Lname">Last Name</label>
            <input type="text" name="Lname" id="Lname" placeholder="Last Name" required>
          </div>
          <div>
            <label for="Fname">First Name</label>
            <input type="text" name="Fname" id="Fname" placeholder="First Name" required>
          </div>
          <div>
            <label for="Mname">Middle Name</label>
            <input type="text" name="Mname" id="Mname" placeholder="Middle Name" required>
          </div>
          <div>
            <label for="Ename">Extension Name</label>
            <input type="text" name="Ename" id="Ename" placeholder="Extension Name" required>
          </div>
          <div>
            <label for="sex">Sex (Male/Female)</label>
            <input type="text" name="sex" id="sex" placeholder="..." required>
          </div>
          <div>
            <label for="cvstatus">Civil Status</label>
            <input type="text" name="cvstatus" id="cvstatus" placeholder="Civil Status" required>
          </div>
          <div>
            <label for="Dateb">Date of Birth (MM/DD/YYYY)</label>
            <input type="date" name="Dateb" id="Dateb" placeholder="Date of Birth" required>
          </div>
          <div>
            <label for="height">Height</label>
            <input type="text" name="height" id="height" placeholder="height" required>
          </div>
          <div>
            <label for="weight">Weight</label>
            <input type="text" name="weight" id="weight" placeholder="weight" required>
          </div>
          <div>
            <label for="nationality">Nationality</label>
            <input type="text" name="nationality" id="nationality" placeholder="Nationality" required>
          </div>
          <div>
            <label for="bPlace">Birth Place</label>
            <input type="text" name="bPlace" id="bPlace" placeholder="Birth Place" required>
          </div>
          <div>
            <label for="Religion">Religion</label>
            <input type="text" name="Religion" id="Religion" placeholder="Religion" required>
          </div>
        </div>

        <div class="form-grid">
          <div>
            <label for="pAdress">Present Address - Barangay</label>
            <input type="text" name="pAdress" id="pAdress" placeholder="Adress" required>
          </div>
          <div>
            <label for="city">City</label>
            <input type="text" name="city" id="city" placeholder="City" required>
          </div>
          <div>
            <label for="zip">Zip Code</label>
            <input type="text" name="zip" id="zip" placeholder="Zip Code" required>
          </div>
        </div>

        <div class="form-grid">
          <div>
            <label for="activeNum">Active Contact Number</label>
            <input type="text" name="activeNum" id="activeNum" placeholder="Active Number" pattern="[0-9]{1,11}" required>
          </div>
          <div>
            <label for="Aemail">Active Email Address</label>
            <input type="email" name="Aemail" id="Aemail" placeholder="Email Address" required>
          </div>
        </div>
      </div>

      <!-- Application Details -->
      <div class="form-section">
        <div class="section-header">Application Details</div>
        <div class="form-grid">
          <div>
            <label for="CountryDeploy">Country of Deployment</label>
            <input type="text" name="CountryDeploy" id="CountryDeploy" placeholder="Country" required>
          </div>
          <div>
            <label for="Jobtype">Job Type</label>
            <input type="text" name="Jobtype" id="Jobtype" placeholder="Job Type" required>
          </div>
        </div>
      </div>

      <!-- Submit -->
      <input type="submit" class="btn1" value="Continue to Document Submission" name="continue">
  </div>
  </form>

  <footer class="Afooter">
    <div class="A-footer">
      <h4>© 2025 PMDL Recruitment Agency. All rights reserved.</h4>
    </div>
  </footer>
</body>

</html>