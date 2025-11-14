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

    <!-- Messages Section CSS -->
    <link
      rel="stylesheet"
      href="styles/user-dashboard/messages/messages-list.css"
    />
    <link
      rel="stylesheet"
      href="styles/user-dashboard/messages/messages-conversation.css"
    />
    <link
      rel="stylesheet"
      href="styles/user-dashboard/messages/messages-conversation-error.css"
    />
    <link
      rel="stylesheet"
      href="styles/user-dashboard/messages/messages-list-error.css"
    />
    <link
      rel="stylesheet"
      href="styles/user-dashboard/messages/messages-conversation-new.css"
    />
    <!-- Settings Section CSS -->
    <link rel="stylesheet" href="styles/user-dashboard/settings.css" />
    <link
      rel="stylesheet"
      href="styles/user-dashboard/settings/content-areas.css"
    />
    <link rel="stylesheet" href="styles/user-dashboard/settings/account.css" />
    <link rel="stylesheet" href="styles/user-dashboard/settings/security.css" />
    <link
      rel="stylesheet"
      href="styles/user-dashboard/settings/notifications.css"
    />
    <link rel="stylesheet" href="styles/user-dashboard/settings/system.css" />
    <link
      rel="stylesheet"
      href="styles/user-dashboard/settings/access-required.css"
    />
    <link rel="stylesheet" href="styles/user-dashboard/settings/advance.css" />
    <!-- icon -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
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
            <a href="submission.html" onclick="showPage('apptrack')"
              >Application Tracker</a
            >
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
        <div class="user1">
          <i class="fa-solid fa-user" style="color: #000000"></i>
          <?php echo htmlspecialchars($userEmail); ?>
        </div>
      </header>

      <div class="container">
        <section class="page" id="home">
          <div class="content-space">
            <div class="content">
              <h1 class="hb1">
                Welcome To PMDL international Manpower <br />Services INC.
                E-Servive
              </h1>
              <a class="hb2">Please select the service you need below</a>
            </div>
          </div>

          <div class="choice">
            <button
              onclick="location.href='https://onlineservices.dmw.gov.ph/OnlineServices/POEAOnline.aspx'"
            >
              <h3>Balik Manggagawa</h3>
              <p>
                For returning workers who want to apply for overseas jobs again
              </p>
            </button>
            <button onclick="location.href='applicationf.php'">
              <h3>New Hire</h3>
              <p>
                For first-time applicants seeking overseas employment
                opportunities
              </p>
            </button>
          </div>
        </section>
        <!-- ------------------------JOB AVAIL----------------------- -->
        <section id="jobsAvail" class="page" style="display: none">
          <div class="search-area">
            <input
              type="text"
              class="search-input"
              placeholder="Search jobs by title, skill or keyword"
            />
            <select class="location-select">
              <option value="">All Locations</option>
              <option value="japan">Japan</option>
              <option value="taiwan">Taiwan</option>
              <option value="singapore">Singapore</option>
            </select>
            <button class="btn-search" onclick="searchJobs()">
              Search Jobs
            </button>
          </div>
          <div class="subJob">
            <div class="subJob1">
              <h3 class="titleJob">Featured Job Opportunities</h3>
              <h4>
                Discover the latest job openings with competitive salaries and
                benefits for Filipino <br />workers abroad
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
        <section id="messages" class="page" style="display: none">
          <div class="messages-container">
            <div class="messages-list messages-list-js"></div>
            <div class="messages-conversation messages-conversation-js"></div>
          </div>
          <script
            type="module"
            src="jsfile/UI-Classes/message-feature/messages.js"
          ></script>
        </section>
        <!-- -------------------------------NOTIFICATION----------------------------------- -->
        <section id="notifications" class="page" style="display: none">
          <h2>Notifications</h2>
        </section>
        <!-- ------------------------------SETTINGS----------------------------------- -->
        <section id="settings" class="page" style="display: none">
          <div class="settings-container">
            <div class="settings-side-bar" style="grid-area: side-bar">
              <h1>Settings</h1>
              <button class="side-bar-item" data-item-id="settings-account">
                Account
              </button>
              <button class="side-bar-item" data-item-id="settings-security">
                Security
              </button>
              <button
                class="side-bar-item"
                data-item-id="settings-notifications"
              >
                Notifications
              </button>
              <button class="side-bar-item" data-item-id="settings-system">
                System
              </button>
            </div>

            <div class="settings-content-area" style="grid-area: content-area">
              <div id="settings-account" class="content-active content-hide">
                <div class="content-header">
                  <h1>Account Settings</h1>
                </div>
                <div class="content-body">
                  <form class="account-form">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" />

                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" />
                  </form>
                </div>

                <div class="content-footer">
                  <button id="account-save-changes" class="save-changes">
                    <img src="images/icons/save-changes-icon.svg" alt="" />Save
                    Changes
                  </button>
                </div>
              </div>
              <div id="settings-security" class="content-active content-hide">
                <div class="content-header">
                  <h1>Security Settings</h1>
                </div>
                <div class="content-body">
                  <form class="security-form">
                    <label for="currentPassword">Current Password</label>
                    <div class="security-input-container">
                      <input
                        type="password"
                        id="currentPassword"
                        name="currentPassword"
                      />
                      <img
                        src="images/icons/visible-off-icon.png"
                        class="security-toggle-password"
                        id="toggleConfirmPassword"
                      />
                    </div>

                    <label for="newPassword">New Password</label>
                    <div class="security-input-container">
                      <input
                        type="password"
                        id="newPassword"
                        name="newPassword"
                      />
                      <img
                        src="images/icons/visible-off-icon.png"
                        class="security-toggle-password"
                        id="toggleConfirmPassword"
                      />
                    </div>

                    <label for="confirmPassword">Confirm Password</label>
                    <div class="security-input-container">
                      <input
                        type="password"
                        id="confirmPassword"
                        name="confirmPassword"
                      />
                      <img
                        src="images/icons/visible-off-icon.png"
                        class="security-toggle-password"
                        id="toggleConfirmPassword"
                      />
                    </div>
                  </form>
                  <div class="two-fa-section">
                    <h2>Two-Factor Authentication</h2>
                    <div>
                      <input type="checkbox" name="2FA" id="toggleTwoFA" />
                      <label>Enable two-factor authentication</label>
                    </div>
                    <p>
                      Adds an extra layer of security to your account by
                      requiring more than just password to sign in.
                    </p>
                  </div>
                </div>

                <div class="content-footer">
                  <button id="security-save-changes" class="save-changes">
                    <img src="images/icons/save-changes-icon.svg" alt="" />Save
                    Changes
                  </button>
                </div>
              </div>
              <div
                id="settings-notifications"
                class="content-active content-hide"
              >
                <div class="content-header">
                  <h1>Notification Settings</h1>
                </div>
                <div class="content-body">
                  <div class="notifications-items">
                    <div class="notification-item-label">
                      <h3>Email Notifications</h3>
                      <p>Receive email notifications for important updates</p>
                    </div>
                    <div class="notification-item-toggle">
                      <input
                        type="checkbox"
                        name="email-notification"
                        id="toggle-email-notification"
                        checked
                      />
                    </div>
                  </div>
                  <div class="notifications-items">
                    <div class="notification-item-label">
                      <h3>Browser Notifications</h3>
                      <p>Show browser notifications for system alerts</p>
                    </div>
                    <div class="notification-item-toggle">
                      <input
                        type="checkbox"
                        name="browser-notification"
                        id="toggle-browser-notification"
                        checked
                      />
                    </div>
                  </div>
                  <div class="notifications-items">
                    <div class="notification-item-label">
                      <h3>Acount Updates</h3>
                      <p>
                        Get notified when OFWs update their account information
                      </p>
                    </div>
                    <div class="notification-item-toggle">
                      <input
                        type="checkbox"
                        name="account-update-notification"
                        id="toggle-account-update-notification"
                        checked
                      />
                    </div>
                  </div>
                  <div class="notifications-items">
                    <div class="notification-item-label">
                      <h3>Document Submissions</h3>
                      <p>Get notified when new documents are submitted</p>
                    </div>
                    <div class="notification-item-toggle">
                      <input
                        type="checkbox"
                        name="document-submissions-notification"
                        id="document-submissions-notification"
                        checked
                      />
                    </div>
                  </div>
                  <div class="notifications-items">
                    <div class="notification-item-label">
                      <h3>New Messages</h3>
                      <p>Get notified when new documents are submitted</p>
                    </div>
                    <div class="notification-item-toggle">
                      <input
                        type="checkbox"
                        name="new-message-notifications"
                        id="toggle-new-message-notifications"
                        checked
                      />
                    </div>
                  </div>
                  <div class="notifications-items">
                    <div class="notification-item-label">
                      <h3>System Maintenance</h3>
                      <p>Get notified scheduled system maintenance</p>
                    </div>
                    <div class="notification-item-toggle">
                      <input
                        type="checkbox"
                        name="system-maintenance-notifications"
                        id="toggle-system-maintenance-notifications"
                        checked
                      />
                    </div>
                  </div>
                </div>

                <div class="content-footer">
                  <button id="notification-save-changes" class="save-changes">
                    <img src="images/icons/save-changes-icon.svg" alt="" />Save
                    Changes
                  </button>
                </div>
              </div>
              <div id="settings-system" class="content-active content-hide">
                <div class="content-header">
                  <h1>System Settings</h1>
                </div>

                <div class="content-body">
                  <div class="system-information">
                    <h2>System Information</h2>
                    <div class="system-information-content">
                      <div style="grid-area: system-information-1">
                        <p class="system-information-label">System Version</p>
                        <p>PMDL v2.4.0</p>
                      </div>
                      <div style="grid-area: system-information-2">
                        <p class="system-information-label">Last Update</p>
                        <p>December 10, 2023</p>
                      </div>
                      <div style="grid-area: system-information-3">
                        <p class="system-information-label">Server Status</p>
                        <p class="system-information-status">Online</p>
                      </div>

                      <div style="grid-area: system-information-4">
                        <p class="system-information-label">Database status</p>
                        <p class="system-information-status">Connected</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="content-footer">
                  <button id="system-save-changes" class="save-changes">
                    <img src="images/icons/save-changes-icon.svg" alt="" />Save
                    Changes
                  </button>
                </div>
              </div>
            </div>
          </div>
          <script
            type="module"
            src="jsfile/admin-dashboard/settings.js"
          ></script>
        </section>
      </div>
    </div>

    <script src="jsfile/user-dashboard/userdash.js"></script>
  </body>
</html>
