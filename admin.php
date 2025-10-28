
<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: registerlog.php"); // back to login if not logged in
    exit();
}

$userEmail = $_SESSION['admin_email'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN</title>
    <link rel="stylesheet" href="styles/admin-dashboard/admin.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/joborder.css" />
    <link rel="stylesheet" href="styles/global/global.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/jobOrder.css" />
    <!-- Messages Section CSS -->
    <link rel="stylesheet" href="styles/admin-dashboard/messages/messages-list.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/messages/messages-conversation.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/messages/messages-conversation-error.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/messages/messages-list-error.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/messages/messages-conversation-new.css" />
    <!-- Settings Section CSS -->
    <link rel="stylesheet" href="styles/admin-dashboard/settings.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/settings/content-areas.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/settings/account.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/settings/security.css" />
    <link rel="stylesheet" href="styles/admin-dashboard/settings/notifications.css" />
    
  </head>

  <body>
    <aside class="sidebr" aria-label="Sidebr">
      <div class="sidebr-header">PMDL Admin</div>
<!-- co -->
      <nav class="anav">
        <ul class="Alist" role="menu">
          <li><a href="#home" data-page="home" role="menuitem">Home</a></li>
          <li>
            <a href="#messages" data-page="messages" role="menuitem"
              >Messages</a
            >
          </li>
          <li>
            <a href="#jobs" data-page="jobs" role="menuitem">Jobs Orders</a>
          </li>
          <li>
            <a href="#notifications" data-page="notifications" role="menuitem"
              >Notifications</a
            >
          </li>
          <li>
            <a href="#settings" data-page="settings" role="menuitem"
              >Settings</a
            >
          </li>
        </ul>
      </nav>

      <div class="logout">
        <a href="php/logout.php" data-page="logout">Logout</a>
      </div>
    </aside>

    <div class="main">
      <header class="topbar">
        <div class="user1"><?php echo htmlspecialchars($userEmail); ?></div>
      </header>

      <main class="content" id="content">
        <!-- Pages -->
        <section id="home" class="page">
           
          <div class="container">
            <h2>Country Distribution</h2>
            <div class="charts-row">
              <div id="piechart"></div>
              <div id="piechart1"></div>
            </div>
          </div>
          
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script src = "jsfile/admin-dashboard/homechart.js">
            
          </script>

          <h2>OFW Dashboard</h2>
          <p>Welcome to the Admin dashboard. This is the Home page.</p>

          <select class="filter01">
            <option value="">All OFWs</option>
            <option value="Balik Mangagawa">Balik Mangagawa</option>
            <option value="New Hire">New Hire</option>
          </select>
          <button class="btnA1">Upload Requirements</button>

          <div class="info1">
            <h4>OFW Records</h4>
            <a>List of OFW's and their documents status</a>
          </div>

          <div class="cnA">
            <div class="filters">
              <button class="filter-btn active" data-filter="all">All</button>
              <button class="filter-btn" data-filter="complete">
                Complete
              </button>
              <button class="filter-btn" data-filter="pending">Pending</button>
              <button class="filter-btn" data-filter="incomplete">
                Incomplete
              </button>
              <button class="filter-btn" data-filter="bm">
                Balik Manggagawa
              </button>
            </div>

            <!--searchbar inside home-->
            <div class="searchh1">
              <input type="text" id="search" placeholder="Search OFWs..." />
            </div>

            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Destination</th>
                  <th>Job Title</th>
                  <th>Status</th>
                  <th>Last Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="recordTable">
                <tr data-status="complete bm">
                  <td>Maria Santos <span class="bm-tag">BM</span></td>
                  <td>Dubai, UAE</td>
                  <td>Domestic Helper</td>
                  <td class="status complete">Documents Complete</td>
                  <td>2023-12-15</td>
                  <td class="action"><a href="#">View Details</a></td>
                </tr>
                <tr data-status="incomplete bm">
                  <td>Ana Reyes <span class="bm-tag">BM</span></td>
                  <td>Hong Kong</td>
                  <td>Nurse</td>
                  <td class="status incomplete">Documents Incomplete</td>
                  <td>2023-12-05</td>
                  <td class="action"><a href="#">View Details</a></td>
                </tr>
                <tr data-status="pending">
                  <td>Juan Cruz</td>
                  <td>Qatar</td>
                  <td>Engineer</td>
                  <td class="status pending">Pending</td>
                  <td>2023-12-01</td>
                  <td class="action"><a href="#">View Details</a></td>
                </tr>
              </tbody>
            </table>
          </div>

          <script src = "jsfile/admin-dashboard/home.js"></script>

        </section>

        <section id="messages" class="page">
          <div class="messages-container">
            <div class="messages-list messages-list-js">
              
            </div>
            <div class="messages-conversation messages-conversation-js">
              
            </div>
          </div>
          <script type = "module" src = "jsfile/UI-Classes/message-feature/messages.js"></script>
        </section>

        <section id="jobs" class="page">
          <h2>Jobs Orders</h2>
          <p>Manage job orders here.</p>
          <div class="container">
          <div class="flex justify-between mb-6">
            <button id="btnFilter" class="btn btn-secondary">Filter</button>
            <button id="btnAddJob" class="btn btn-primary">Add New Job Order</button>
          </div>

          <div class="flex space-x-2 mb-4">
            <button class="btn btn-secondary filter-btn active" data-filter="all">All</button>
            <button class="btn btn-secondary filter-btn" data-filter="active">Active</button>
            <button class="btn btn-secondary filter-btn" data-filter="pending approval">Pending</button>
            <button class="btn btn-secondary filter-btn" data-filter="closed">Closed</button>
            <input type="text" id="searchInput" placeholder="Search job orders..." style="flex:1;"/>
          </div>

          <table id="jobTable">
            <thead>
              <tr>
                <th>Job Order ID</th>
                <th>Position</th>
                <th>Employer</th>
                <th>Location</th>
                <th>Vacancies</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Job rows inserted here -->
            </tbody>
          </table>

          <!-- Job Details Modal -->
          <div id="modalOverlay" class="modal-overlay">
            <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
              <div class="modal-header">
                <h2 id="modalTitle">Job Details</h2>
                <button id="modalClose" class="modal-close" aria-label="Close modal">&times;</button>
              </div>
              <div id="modalContent">
                <!-- Job details inserted here -->
              </div>
            </div>
          </div>

          <!-- Add/Edit Job Modal -->
          <div id="modalAddEditOverlay" class="modal-overlay">
            <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalAddEditTitle">
              <div class="modal-header">
                <h2 id="modalAddEditTitle">Add New Job Order</h2>
                <button id="modalAddEditClose" class="modal-close" aria-label="Close modal">&times;</button>
              </div>
              <form id="jobForm">
                <div class="form-group">
                  <label for="positionInput">Position Title*</label>
                  <input type="text" id="positionInput" name="position" required />
                </div>
                <div class="form-group">
                  <label for="employerInput">Employer/Company*</label>
                  <input type="text" id="employerInput" name="employer" required />
                </div>
                <div class="form-group">
                  <label for="countryInput">Country*</label>
                  <input type="text" id="countryInput" name="country" required />
                </div>
                <div class="form-group">
                  <label for="salaryInput">Salary Range*</label>
                  <input type="text" id="salaryInput" name="salary" required placeholder="e.g. $1,200 - $1,500" />
                </div>
                <div class="form-group">
                  <label for="vacanciesInput">Number of Vacancies*</label>
                  <input type="number" id="vacanciesInput" name="vacancies" min="1" required />
                </div>
                <div class="form-group">
                  <label for="deadlineInput">Application Deadline*</label>
                  <input type="date" id="deadlineInput" name="deadline" required />
                </div>
                <div class="form-group">
                  <label for="statusInput">Status*</label>
                  <select id="statusInput" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Pending Approval">Pending Approval</option>
                    <option value="Closed">Closed</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="descriptionInput">Job Description*</label>
                  <textarea id="descriptionInput" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                  <label for="contactPersonInput">Contact Person*</label>
                  <input type="text" id="contactPersonInput" name="contactPerson" required />
                </div>
                <div class="form-group">
                  <label for="contactEmailInput">Contact Email*</label>
                  <input type="email" id="contactEmailInput" name="contactEmail" required />
                </div>
                <div class="form-group">
                  <label for="contactPhoneInput">Contact Phone*</label>
                  <input type="text" id="contactPhoneInput" name="contactPhone" required />
                </div>
                <div style="text-align: right;">
                  <button type="button" id="cancelAddEdit" class="btn btn-secondary">Cancel</button>
                  <button type="submit" class="btn btn-primary" id="submitJobBtn">Create Job Order</button>
                </div>
              </form>
            </div>
          </div>
          <!-- JAVASCRIOPT FILE -->
          <script src = "jsfile/admin-dashboard/jobOrder.js"> </script>

        </section>

        <section id="reports" class="page"></section>

        <section id="notifications" class="page">
          <h2>Notifications</h2>
          <p>Your notifications appear here.</p>
        </section>

        <section id="settings" class="page">
          <div class = "settings-container">
            <div class = "settings-side-bar" style = "grid-area: side-bar">
              <h1>Settings</h1>
              <button class="side-bar-item" data-item-id="settings-account">Account</button>
              <button class="side-bar-item" data-item-id="settings-security">Security</button>
              <button class="side-bar-item side-bar-item-active" data-item-id="settings-notifications">Notifications</button>
              <button class="side-bar-item" data-item-id="settings-system">System</button>
              <button class="side-bar-item" data-item-id="settings-database">Database</button>
              <button class="side-bar-item" data-item-id="settings-advance">Advance</button>
            </div>

            <div class = "settings-content-area" style = "grid-area: content-area">
              <div  id = "settings-account" class = "content-active  content-hide">
                <div class = "content-header">
                  <h1>Account Settings</h1>
                </div>
                <div class="content-body">
                  <form class="account-form">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" />

                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" />

                    <label for="role">Role</label>
                    <select id="role" name="role">
                      <option value="">Select a role</option>
                      <option value="admin">Administrator</option>
                      <option value="manager">Manager</option>
                      <option value="staff">Staff</option>
                      <option value="intern">Intern</option>
                    </select>

                    <label for="department">Department</label>
                    <select id="department" name="department">
                      <option value="">Select a department</option>
                      <option value="hr">Human Resources</option>
                      <option value="it">IT</option>
                      <option value="finance">Finance</option>
                      <option value="marketing">Marketing</option>
                      <option value="operations">Operations</option>
                    </select>
                  </form>

                </div>

                <div class="content-footer">
                  <button class = "account-save-changes"><img src="images/icons/save-changes-icon.svg" alt="">Save Changes</button>
                </div>
              </div>
              <div id = "settings-security" class = "content-active content-hide">
                <div class = "content-header">
                  <h1>Security Settings</h1>
                </div>
                <div class="content-body">
                  <form class="security-form">
                    <label for="currentPassword">Current Password</label>
                    <div class= "security-input-container">
                      <input type="password" id="currentPassword" name="currentPassword" />
                      <img src="images/icons/visible-off-icon.png" class="security-toggle-password" id="toggleConfirmPassword">
                    </div>

                    <label for="newPassword">New Password</label>
                    <div class= "security-input-container">
                      <input type="password" id="newPassword" name="newPassword" />
                      <img src="images/icons/visible-off-icon.png" class="security-toggle-password" id="toggleConfirmPassword">
                    </div>

                    <label for="confirmPassword">Confirm Password</label>
                    <div class= "security-input-container">
                      <input type="password" id="confirmPassword" name="confirmPassword" />
                      <img src="images/icons/visible-off-icon.png" class="security-toggle-password" id="toggleConfirmPassword">
                    </div>
                  </form>
                  <div class = "two-fa-section">
                    <h2>Two-Factor Authentication</h2>
                    <div>
                      <input type="checkbox" name ="2FA" id = "toggleTwoFA">
                      <Label>Enable two-factor authentication</Label>
                    </div>
                    <p>Adds an extra layer of security to your account by requiring more than just password to sign in.</p>
                  </div>
                </div>

                <div class="content-footer">
                  <button class = "security-save-changes"><img src="images/icons/save-changes-icon.svg" alt="">Save Changes</button>
                </div>
              </div>
              <div id = "settings-notifications" class = "content-active">
                <div class = "content-header">
                  <h1>Notification Settings</h1>
                </div>
                <div class="content-body">
                  <div class = "notifications-items">
                    <div class = "notification-item-label">
                      <h3>Email Notifications</h3>
                      <p>Receive email notifications for important updates</p>
                    </div>
                    <div class = "notification-item-toggle">
                      <input type="checkbox" name ="email-notification" id = "toggle-email-notification" checked>
                    </div>
                  </div>
                  <div class = "notifications-items">
                    <div class = "notification-item-label">
                      <h3>Browser Notifications</h3>
                      <p>Show browser notifications for system alerts</p>
                    </div>
                    <div class = "notification-item-toggle">
                      <input type="checkbox" name ="browser-notification" id = "toggle-browser-notification" checked>
                    </div>
                  </div>
                  <div class = "notifications-items">
                    <div class = "notification-item-label">
                      <h3>Acount Updates</h3>
                      <p>Get notified when OFWs update their account information</p>
                    </div>
                    <div class = "notification-item-toggle">
                      <input type="checkbox" name ="account-update-notification" id = "toggle-account-update-notification" checked>
                    </div>
                  </div>
                  <div class = "notifications-items">
                    <div class = "notification-item-label">
                      <h3>Document Submissions</h3>
                      <p>Get notified when new documents are submitted</p>
                    </div>
                    <div class = "notification-item-toggle">
                      <input type="checkbox" name ="document-submissions-notification" id = "document-submissions-notification" checked>
                    </div>
                  </div>
                  <div class = "notifications-items">
                    <div class = "notification-item-label">
                      <h3>New Messages</h3>
                      <p>Get notified when new documents are submitted</p>
                    </div>
                    <div class = "notification-item-toggle">
                      <input type="checkbox" name ="new-message-notifications" id = "toggle-new-message-notifications" checked>
                    </div>
                  </div>
                  <div class = "notifications-items">
                    <div class = "notification-item-label">
                      <h3>System Maintenance</h3>
                      <p>Get notified scheduled system maintenance</p>
                    </div>
                    <div class = "notification-item-toggle">
                      <input type="checkbox" name ="system-maintenance-notifications" id = "toggle-system-maintenance-notifications" checked>
                    </div>
                  </div>  
                </div>

                <div class="content-footer">
                  <button class = "notification-save-changes"><img src="images/icons/save-changes-icon.svg" alt="">Save Changes</button>
                </div>
              </div>
              <div id = "settings-system" class = "content-active content-hide">
                System
              </div>
              <div id = "settings-database" class = "content-active content-hide">
                Database
              </div>
              <div id = "settings-advance" class = "content-active content-hide">
                Advance
              </div>
            </div>
          </div>
          <script type = "module" src = "jsfile/admin-dashboard/settings.js"></script>
        </section>
      </main>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const navLinks = document.querySelectorAll(".Alist a");
        const pages = document.querySelectorAll(".page");

        function activate(pageId) {
          // hide all pages
          pages.forEach((p) => p.classList.remove("active"));
          // show page if exists
          const target = document.getElementById(pageId);
          if (target) target.classList.add("active");

          // set active class on nav links
          navLinks.forEach((link) => {
            link.classList.toggle("active", link.dataset.page === pageId);
          });
        }

        // click
        navLinks.forEach((link) => {
          link.addEventListener("click", function (e) {
            e.preventDefault(); // prevent default anchor navigation
            const page = this.dataset.page || "home";
            // push hash so the back button works
            location.hash = page;
            activate(page);
          });
        });

        // handle back/forward via hashchange
        window.addEventListener("hashchange", () => {
          const hash = location.hash.replace("#", "") || "home";
          activate(hash);
        });

        // initial
        const initial = location.hash.replace("#", "") || "home";
        activate(initial);
      });
    </script>
  </body>
</html>
