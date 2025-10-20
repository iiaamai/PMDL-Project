
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
            <a href="#tracker" data-page="tracker" role="menuitem"
              >Application Tracker</a
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
              <div class="list-header">
                <h3>Messages</h3>
                <div class="search">
                  <span>
                    <img src="images/icons/search-icon.svg" alt="Search"/>
                  </span>
                  <input type="text" placeholder="Search..." />
                  <div class="search-result">
                    <div class="profile">
                      <img src="./images/icons/sample-profile.jpg" alt="User Profile" />
                      <h4>Juan Dela Cruz</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="messages-conversation messages-conversation-js">
              
            </div>
          </div>
          <script type = "module" src = "jsfile/admin-dashboard/messages.js"></script>
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

        <section id="tracker" class="page">
          <h2>Application Tracker</h2>
          <p>Track applications here.</p>
        </section>

        <section id="settings" class="page">
          <h2>Settings</h2>
          <p>Manage settings here.</p>
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
