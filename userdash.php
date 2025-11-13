<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
  // If not logged in, send back to login page
  header("Location: registerlog.php");
  exit();
}

// Store user email for display
$userEmail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>USER DASHBOARD</title>
  <link rel="stylesheet" href="styles/user-dashboard/header.css" />
  <link rel="stylesheet" href="styles/user-dashboard/userdsh.css" />
  <link rel="stylesheet" href="styles/global/global.css" />

  <!-- icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <aside class="sidebar" aria-label="Sidebar">
    <div class="sidebar-header">PMDL</div>
    <!-- co -->
    <nav class="bar">
      <ul class="ss" role="menu">
        <li><a href="#" onclick="showPage('home')">Home</a></li>
        <li>
          <a href="#" onclick="showPage('jobsAvail')">Job Available</a>
        </li>
        <li>
          <a href="submission.html" onclick="showPage('apptrack')">Application Tracker</a>
        </li>
        <li>
          <a href="#" onclick="showPage('messages')">Messages</a>
        </li>
        <li>
          <a href="#" onclick="showPage('notifications')">Notifications</a>
        </li>
        <li>
          <a href="#" onclick="showPage('settings')">Settings</a>
        </li>
      </ul>
    </nav>

    <div class="log">
      <a href="php/logout.php" data-page="logout">Logout</a>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="user1"><i class="fa-solid fa-user" style="color: #000000;"></i>
        <?php echo htmlspecialchars($userEmail); ?>
      </div>
    </header>

    <div class="container">

      <section class="page" id="home">
        <div class="content-space">
          <div class="content">
            <h1 class="hb1">
              Welcome To PMDL international Manpower <br />Services INC. E-Servive
            </h1>
            <a class="hb2">Please select the service you need below</a>
          </div>
        </div>

        <div class="choice">
          <button onclick="location.href='https://onlineservices.dmw.gov.ph/OnlineServices/POEAOnline.aspx'">
            <h3>Balik Manggagawa</h3>
            <p>For returning workers who want to apply for overseas jobs again</p>
          </button>
          <button onclick="location.href='applicationf.php'">
            <h3>New Hire</h3>
            <p>For first-time applicants seeking overseas employment opportunities</p>
          </button>
        </div>

      </section>
      <!-- ------------------------JOB AVAIL----------------------- -->
      <section id="jobsAvail" class="page" style="display:none;">
        <div class="search-area">
          <input type="text" class="search-input" placeholder="Search jobs by title, skill or keyword">
          <select class="location-select">
            <option value="">All Locations</option>
            <option value="japan">Japan</option>
            <option value="taiwan">Taiwan</option>
            <option value="singapore">Singapore</option>
          </select>
          <button class="btn-search" onclick="searchJobs()">Search Jobs</button>
        </div>
        <div class="subJob">
          <div class="subJob1">
            <h3 class="titleJob">Featured Job Opportunities</h3>
            <h4>Discover the latest job openings with competitive salaries and benefits for Filipino <br>workers abroad
            </h4>
          </div>
        </div>

        <section class="jobsection">
          <div class="job-cards">
            <!-- Job Card 1 -->
            <div class="job-card">
              <h3>Registered Nurse</h3>
              <p>Saudi German Hospital</p>
              <p>📍 Saudi Arabia</p>
              <div class="job-details">
                <span>$2,000 - $2,500/month</span>
                <span>Full-time</span>
              </div>
              <p>🗓 Until Dec 30, 2023</p>
              <a href="#" class="btn">View Details</a>
            </div>

            <!-- Job Card 2 -->
            <div class="job-card">
              <h3>Construction Engineer</h3>
              <p>Dubai Construction Co.</p>
              <p>📍 UAE</p>
              <div class="job-details">
                <span>$3,000 - $4,000/month</span>
                <span>Contract</span>
              </div>
              <p>🗓 Until Jan 15, 2024</p>
              <a href="#" class="btn">View Details</a>
            </div>

            <div class="job-card">
              <h3>Construction Engineer</h3>
              <p>Dubai Construction Co.</p>
              <p>📍 UAE</p>
              <div class="job-details">
                <span>$3,000 - $4,000/month</span>
                <span>Contract</span>
              </div>
              <p>🗓 Until Jan 15, 2024</p>
              <a href="#" class="btn">View Details</a>
            </div>

          </div>
        </section>
      </section>
      <!-- -------------------------------MESSAGES----------------------------------- -->
      <section id="messages" class="page" style="display:none;">
        <div class="mess-container">
          <div class="mess-content1">
            <h3>Messages</h3>
            <input type="text" class="mess-search" placeholder="Search..." />
          </div>
          <div class="mess-content2">
            <h3>YOUR MESSAGES</h3>
          </div>
        </div>
      </section>
      <!-- -------------------------------NOTIFICATION----------------------------------- -->
      <section id="notifications" class="page" style="display:none;">
        <h2>Notifications</h2>
      </section>
      <!-- ------------------------------SETTINGS----------------------------------- -->
      <section id="settings" class="page" style="display:none;">
        <div class="settings-container">
          <div class="settings-select">
            <h4>SETTINGS</h4>
            <nav class="set-choices">
              <ul>
                <li><a href="#" onclick="showSettingsSection('account')">Account Settings</a></li>
                <li><a href="#" onclick="showSettingsSection('security')">Security</a></li>
                <li><a href="#" onclick="showSettingsSection('display')">Display</a></li>
              </ul>
            </nav>
          </div>

          <div class="settings-result">
            <div class="result-container">

              <!-- Account Section -->
              <section class="settings-section active" id="account">
                <h2>Profile</h2>
                <div class="form-set">

                  <div class="input-set">
                    <label class="set-sub">Username</label>
                    <input type="text" name="username" required />
                  </div>

                  <div class="input-set">
                    <label class="set-sub">Email</label>
                    <input type="email" name="email" required />
                  </div>

                </div>
              </section>

              <!-- Display Section -->
              <section class="settings-section" id="display">
                <h2>Appearance</h2>
                <label class="switch">
                  <input type="checkbox" id="darkModeToggle" />
                  <span class="slider"></span>
                </label>
                <span>Dark Mode</span>
              </section>

              <!-- Security Settings -->
              <section class="settings-section" id="security">
                <h2>Security Settings</h2>
                <div class="form-set">

                  <h3>Change Password</h3>
                  <div class="input-set">
                    <label class="set-sub">Current Password</label>
                    <input type="text" name="username" required />
                  </div>

                  <div class="input-set">
                    <label class="set-sub">New Password</label>
                    <input type="email" name="email" required />
                  </div>

                  <div class="input-set">
                    <label class="set-sub">Confirm New Password</label>
                    <input type="password" name="password" required />
                  </div>

                  <div>
                    <h2>Two-Factor Authentication</h2>
                    <label class="switch">
                      <input type="checkbox" id="darkModeToggle" />
                      <span class="slider"></span>
                    </label>
                    <span>Enable two-factor authentication</span>
                    <p class="confirm-desc">Adds an extra layer of security to your account by requiring more than just a password to sign in.</p>
                  </div>

                </div>

              </section>

            </div>
          </div>
        </div>
      </section>


    </div>
  </div>

  <script src="jsfile/user-dashboard/userdash.js"></script>

</body>

</html>