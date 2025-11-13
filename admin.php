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
  <title>ADMIN | PMDL</title>
  <link rel="stylesheet" href="styles/admin-dashboard/admin.css" />
  <link rel="stylesheet" href="styles/admin-dashboard/jobs.css" />
  <link rel="stylesheet" href="styles/admin-dashboard/joborder.css" />
  <link rel="stylesheet" href="styles/global/global.css" />
  <link rel="stylesheet" href="styles/admin-dashboard/ofw-view.css" />
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
  <link rel="stylesheet" href="styles/admin-dashboard/settings/system.css" />
  <link rel="stylesheet" href="styles/admin-dashboard/settings/access-required.css" />
  <link rel="stylesheet" href="styles/admin-dashboard/settings/advance.css" />

  <!-- icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <!-- sidebar -->
  <aside class="sidebr" aria-label="Sidebr">
    <div class="sidebr-header">PMDL Admin</div>
    <!-- co -->
    <nav class="anav">
      <ul class="Alist" role="menu">
        <li><a href="#home" data-page="home" role="menuitem">Home</a></li>
        <li>
          <a href="#messages" data-page="messages" role="menuitem">Messages</a>
        </li>
        <li>
          <a href="#jobs" data-page="jobs" role="menuitem">Jobs Orders</a>
        </li>
        <li>
          <a href="#notifications" data-page="notifications" role="menuitem">Notifications</a>
        </li>
        <li>
          <a href="#settings" data-page="settings" role="menuitem">Settings</a>
        </li>
      </ul>
    </nav>

    <div class="logout">
      <a href="php/logout.php" data-page="logout">Logout</a>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="user1"><i class="fa-solid fa-user" style="color: #000000;"></i>
        <?php echo htmlspecialchars($userEmail); ?>
      </div>
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
        <script src="jsfile/admin-dashboard/homechart.js"></script>

        <!-- -----------------------------------OFW TABLE------------------------------------ -->
        <section class="home-dash">
          <h2 class="home_title">OFW Dashboard</h2>

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
              <button class="filter-btn" data-filter="complete">Complete</button>
              <button class="filter-btn" data-filter="pending">Pending</button>
              <button class="filter-btn" data-filter="incomplete">Incomplete</button>
              <button class="filter-btn" data-filter="bm">Balik Manggagawa</button>

              <!--searchbar inside home-->
              <div class="searchh1">
                <input type="text" id="search" placeholder="Search OFWs..." />
              </div>
            </div>

            <table id="ofwTable" class="table">
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
                <?php include('php/admin/ofw_record_fetch.php'); ?>
              </tbody>
            </table>

            <!-- View Details Modal -->
            <div id="viewModal" class="custom-modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="modal-close">&times;</button>
                  </div>

                  <div class="second-head">
                    <h5 id="modalName">OFW Name</h5>
                    <button id="editProfileBtn" class="editProf">Edit Profile</button>
                  </div>

                  <div class="modal-body">
                    <div class="summary">
                      <div>
                        <p>Destination</p>
                        <h6 id="modalDestination">—</h6>
                      </div>
                      <div>
                        <p>Job Title</p>
                        <h6 id="modalPosition">—</h6>
                      </div>
                      <div>
                        <p>Status</p>
                        <h6 id="modalStatus">—</h6>
                      </div>
                    </div>

                    <div class="tabs">
                      <button class="tab-button active" data-tab="documents">Documents</button>
                      <button class="tab-button" data-tab="personal">Personal Info</button>
                      <button class="tab-button" data-tab="employment">Employment</button>
                    </div>

                    <div class="tab-content">
                      <div id="documents" class="tab-pane active">
                        <div id="documentsContent">
                          <p>Loading documents...</p>
                        </div>
                      </div>
                      <div id="personal" class="tab-pane">
                        <div id="personalContent">
                          <p>Loading personal information...</p>
                        </div>
                      </div>
                      <div id="employment" class="tab-pane">
                        <div id="employmentContent">
                          <p>Loading employment details...</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn-close-footer">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Edit Profile Modal -->
            <div id="editProfileModal" class="custom-modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5>Edit OFW Profile</h5>
                    <button type="button" class="modal-close">&times;</button>
                  </div>

                  <div class="modal-body">
                    <form id="editProfileForm">
                      <input type="hidden" id="editOfwId" name="ofw_id">

                      <!-- Worker Type Selection (Editable) -->
                      <div class="form-section">
                        <h6>Worker Type</h6>
                        <div class="worker-type-container">
                          <div class="worker-type-option">
                            <input type="radio" id="newHire" name="worker_type" value="new_hire">
                            <label for="newHire" class="worker-type-label">
                              <span class="worker-type-badge new-hire">New Hire</span>
                            </label>
                          </div>
                          <div class="worker-type-option">
                            <input type="radio" id="balikMangagawa" name="worker_type" value="balik_mangagawa">
                            <label for="balikMangagawa" class="worker-type-label">
                              <span class="worker-type-badge balik-mangagawa">Balik-Mangagawa</span>
                            </label>
                          </div>
                        </div>
                      </div>

                      <!-- Personal Information (Read-only) -->
                      <div class="form-section">
                        <h6>Personal Information</h6>
                        <div class="form-row">
                          <div class="form-group">
                            <label for="editLastName">Last Name</label>
                            <input type="text" id="editLastName" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="editFirstName">First Name</label>
                            <input type="text" id="editFirstName" class="form-control" readonly>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group">
                            <label for="editMiddleName">Middle Name</label>
                            <input type="text" id="editMiddleName" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="editExtensionName">Extension Name</label>
                            <input type="text" id="editExtensionName" class="form-control" readonly>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group">
                            <label for="editSex">Sex</label>
                            <input type="text" id="editSex" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="editCivilStatus">Civil Status</label>
                            <input type="text" id="editCivilStatus" class="form-control" readonly>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group">
                            <label for="editDateOfBirth">Date of Birth</label>
                            <input type="text" id="editDateOfBirth" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="editNationality">Nationality</label>
                            <input type="text" id="editNationality" class="form-control" readonly>
                          </div>
                        </div>
                      </div>

                      <!-- Employment Information -->
                      <div class="form-section">
                        <h6>Employment Information</h6>
                        <div class="form-group">
                          <label for="editDestination">Destination</label>
                          <input type="text" id="editDestination" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                          <label for="editJob">Job Title</label>
                          <input type="text" id="editJob" class="form-control" readonly>
                        </div>

                        <!-- Status (Editable) -->
                        <div class="form-group">
                          <label for="editStatus">Status</label>
                          <select id="editStatus" name="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="Complete">Complete</option>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">Incomplete</option>
                          </select>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn-close-footer">Cancel</button>
                    <button type="button" id="saveProfileBtn" class="btn-save">Save Changes</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <script src="jsfile/admin-dashboard/ofw-modal.js"></script>
        <script src="jsfile/admin-dashboard/home.js"></script>
      </section>

      <!-- ---------------------MESSAGE------------------------ -->
      <section id="messages" class="page">
        <div class="messages-container">
          <div class="messages-list messages-list-js"></div>
          <div class="messages-conversation messages-conversation-js"></div>
        </div>
        <script type="module" src="jsfile/UI-Classes/message-feature/messages.js"></script>
      </section>

      <!-- -----------------JOB ORDER------------------------ -->
      <section id="jobs" class="page">
        <h2>Jobs Orders</h2>
        <p>Manage job orders here.</p>
        <div class="container">
          <div class="flex justify-between mb-6">
            <button id="btnFilter" class="btn-secondary">Filter</button>
            <button id="btnAddJob" class="btn-primary">Add New Job Order</button>
          </div>

          <div class="flex space-x-2 mb-4">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="active">Active</button>
            <button class="filter-btn" data-filter="pending approval">Pending</button>
            <button class="filter-btn" data-filter="closed">Closed</button>
            <input type="text" id="searchInput" class="search-job" placeholder="Search job orders..." style="flex:1;" />
          </div>

          <!-- Your existing table -->
          <table id="jobTable" class="table">
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
              <!-- Data will be populated by JavaScript -->
            </tbody>
          </table>

          <!-- Job Details Modal -->
          <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalJobTitle">Job Title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="job-detail-item">
                        <div class="job-detail-label">Employer</div>
                        <div class="job-detail-value" id="modalEmployer"></div>
                      </div>
                      <div class="job-detail-item">
                        <div class="job-detail-label">Location</div>
                        <div class="job-detail-value" id="modalLocation"></div>
                      </div>
                      <div class="job-detail-item">
                        <div class="job-detail-label">Salary</div>
                        <div class="job-detail-value" id="modalSalary"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="job-detail-item">
                        <div class="job-detail-label">Vacancies</div>
                        <div class="job-detail-value" id="modalVacancies"></div>
                      </div>
                      <div class="job-detail-item">
                        <div class="job-detail-label">Application Deadline</div>
                        <div class="job-detail-value" id="modalDeadline"></div>
                      </div>
                      <div class="job-detail-item">
                        <div class="job-detail-label">Status</div>
                        <div class="job-detail-value">
                          <span class="badge bg-success">Active</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="job-detail-item">
                    <div class="job-detail-label">Job Description</div>
                    <div class="job-detail-value" id="modalDescription"></div>
                  </div>

                  <div class="job-detail-item">
                    <h6 class="job-detail-label">Contact Information</h6>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="contact-item">
                          <strong>Contact Person:</strong>
                          <div class="job-detail-value" id="modalContactPerson"></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="contact-item">
                          <strong>Email:</strong>
                          <div class="job-detail-value" id="modalContactEmail"></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="contact-item">
                          <strong>Phone:</strong>
                          <div class="job-detail-value" id="modalContactPhone"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <script src="jsfile/admin-dashboard/jobs.js"></script>
        </div>
      </section>

      <!-- JAVASCRIOPT FILE -->
      <script src="jsfile/admin-dashboard/jobOrder.js"></script>

      <section id="reports" class="page"></section>

      <section id="notifications" class="page">
        <h2>Notifications</h2>
        <p>Your notifications appear here.</p>
      </section>

      <section id="settings" class="page">
        <div class="settings-container">
          <div class="settings-side-bar" style="grid-area: side-bar">
            <h1>Settings</h1>
            <button class="side-bar-item" data-item-id="settings-account">Account</button>
            <button class="side-bar-item" data-item-id="settings-security">Security</button>
            <button class="side-bar-item" data-item-id="settings-notifications">Notifications</button>
            <button class="side-bar-item" data-item-id="settings-system">System</button>
            <button class="side-bar-item   side-bar-item-active" data-item-id="settings-database">Database</button>
            <button class="side-bar-item" data-item-id="settings-advance">Advance</button>
          </div>

          <div class="settings-content-area" style="grid-area: content-area">
            <div id="settings-account" class="content-active  content-hide">
              <div class="content-header">
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
                <button id="account-save-changes" class="save-changes"><img src="images/icons/save-changes-icon.svg" alt="">Save Changes</button>
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
                    <input type="password" id="currentPassword" name="currentPassword" />
                    <img src="images/icons/visible-off-icon.png" class="security-toggle-password" id="toggleConfirmPassword">
                  </div>

                  <label for="newPassword">New Password</label>
                  <div class="security-input-container">
                    <input type="password" id="newPassword" name="newPassword" />
                    <img src="images/icons/visible-off-icon.png" class="security-toggle-password" id="toggleConfirmPassword">
                  </div>

                  <label for="confirmPassword">Confirm Password</label>
                  <div class="security-input-container">
                    <input type="password" id="confirmPassword" name="confirmPassword" />
                    <img src="images/icons/visible-off-icon.png" class="security-toggle-password" id="toggleConfirmPassword">
                  </div>
                </form>
                <div class="two-fa-section">
                  <h2>Two-Factor Authentication</h2>
                  <div>
                    <input type="checkbox" name="2FA" id="toggleTwoFA">
                    <Label>Enable two-factor authentication</Label>
                  </div>
                  <p>Adds an extra layer of security to your account by requiring more than just password to sign in.</p>
                </div>
              </div>

              <div class="content-footer">
                <button id="security-save-changes" class="save-changes"><img src="images/icons/save-changes-icon.svg" alt="">Save Changes</button>
              </div>
            </div>
            <div id="settings-notifications" class="content-active content-hide">
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
                    <input type="checkbox" name="email-notification" id="toggle-email-notification" checked>
                  </div>
                </div>
                <div class="notifications-items">
                  <div class="notification-item-label">
                    <h3>Browser Notifications</h3>
                    <p>Show browser notifications for system alerts</p>
                  </div>
                  <div class="notification-item-toggle">
                    <input type="checkbox" name="browser-notification" id="toggle-browser-notification" checked>
                  </div>
                </div>
                <div class="notifications-items">
                  <div class="notification-item-label">
                    <h3>Acount Updates</h3>
                    <p>Get notified when OFWs update their account information</p>
                  </div>
                  <div class="notification-item-toggle">
                    <input type="checkbox" name="account-update-notification" id="toggle-account-update-notification" checked>
                  </div>
                </div>
                <div class="notifications-items">
                  <div class="notification-item-label">
                    <h3>Document Submissions</h3>
                    <p>Get notified when new documents are submitted</p>
                  </div>
                  <div class="notification-item-toggle">
                    <input type="checkbox" name="document-submissions-notification" id="document-submissions-notification" checked>
                  </div>
                </div>
                <div class="notifications-items">
                  <div class="notification-item-label">
                    <h3>New Messages</h3>
                    <p>Get notified when new documents are submitted</p>
                  </div>
                  <div class="notification-item-toggle">
                    <input type="checkbox" name="new-message-notifications" id="toggle-new-message-notifications" checked>
                  </div>
                </div>
                <div class="notifications-items">
                  <div class="notification-item-label">
                    <h3>System Maintenance</h3>
                    <p>Get notified scheduled system maintenance</p>
                  </div>
                  <div class="notification-item-toggle">
                    <input type="checkbox" name="system-maintenance-notifications" id="toggle-system-maintenance-notifications" checked>
                  </div>
                </div>
              </div>

              <div class="content-footer">
                <button id="notification-save-changes" class="save-changes"><img src="images/icons/save-changes-icon.svg" alt="">Save Changes</button>
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
                      <p class="system-information-label">
                        System Version
                      </p>
                      <p>
                        PMDL v2.4.0
                      </p>
                    </div>
                    <div style="grid-area: system-information-2">
                      <p class="system-information-label">
                        Last Update
                      </p>
                      <p>December 10, 2023</p>
                    </div>
                    <div style="grid-area: system-information-3">
                      <p class="system-information-label">
                        Server Status
                      </p>
                      <p class="system-information-status">
                        Online
                      </p>
                    </div>

                    <div style="grid-area: system-information-4">
                      <p class="system-information-label">
                        Database status
                      </p>
                      <p class="system-information-status">
                        Connected
                      </p>
                    </div>
                  </div>
                </div>
                <div class="system-maintenance">
                  <h2>System Maintenance</h2>
                  <div class="system-maintenance-content">
                    <button class="system-maintenance-item">
                      <img src="./images/icons/updates-icon.png">
                      Check for Updates
                    </button>
                    <button class="system-maintenance-item">
                      <img src="./images/icons/databse-icon.png">
                      Optimize Database
                    </button>
                    <button class="system-maintenance-item">
                      <img src="./images/icons/security-icon.png">
                      Security Scan
                    </button>
                  </div>
                </div>
                <div class="system-maintenance">
                  <h2>System Performance</h2>
                  <div class="system-performance-content">
                    <div class="system-performance-item">
                      <div class="label">
                        <label>CPU Usage</label>
                        <p class="usage">32%</p>
                      </div>
                      <div class="percentage-bar">
                        <div class="fill" style="width: 32%;
                          background-color: #16a34a;"></div>
                      </div>
                    </div>
                    <div class="system-performance-item">
                      <div class="label">
                        <label>Memory Usage</label>
                        <p class="usage">68%</p>
                      </div>
                      <div class="percentage-bar">
                        <div class="fill" style="width: 68%;
                          background-color: #eab308;"></div>
                      </div>
                    </div>
                    <div class="system-performance-item">
                      <div class="label">
                        <label>Disk Usage</label>
                        <p class="usage">45%</p>
                      </div>
                      <div class="percentage-bar">
                        <div class="fill" style="width: 45%;
                          background-color: #3b82f6;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-footer">
                <button id="system-save-changes" class="save-changes"><img src="images/icons/save-changes-icon.svg" alt="">Save Changes</button>
              </div>
            </div>
            <div id="settings-database" class="content-active">
              <div class="settings-access-required">
                <div>
                  <img src="./images/icons/security-alert-icon.png" alt="">
                  <h4>Administrator Access Required</h4>
                  <p>These setting is required elevated permissions.</p>
                  <button>
                    <img src="./images/icons/security-lock-icon.png" alt="">
                    Authenticate
                  </button>
                </div>
              </div>
            </div>
            <div id="settings-advance" class="content-active content-hide">
              <div class="settings-advance-content">
                <div class="settings-advance-items">
                  <img src="images/icons/docs-icon.png" alt="">
                  <div>
                    <h4>Document Status Changed</h4>
                    <time>Dec 13, 04:10pm</time>
                    <p>Lois A. Mabalot visa application has been approved</p>
                  </div>
                </div>
                <div class="settings-advance-items">
                  <img src="images/icons/job-order-icon.png" alt="">
                  <div>
                    <h4>New Job Order Posted</h4>
                    <time>Dec 12, 02:30pm</time>
                    <p>Lois A. Mabalot added a new job order for Registered Nurses in Saudi</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script type="module" src="jsfile/admin-dashboard/settings.js"></script>
      </section>

    </main>
  </div>

  <script>
    // navigation sidebar system
    document.addEventListener("DOMContentLoaded", function() {
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
        link.addEventListener("click", function(e) {
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>