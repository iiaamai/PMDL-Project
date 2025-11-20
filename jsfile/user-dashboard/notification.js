document.querySelector(".notifications-container-js").innerHTML = `
${renderNotificationHeader()}
${renderNotificationList()}
${renderNotificationContent()}

`;

function renderNotificationHeader() {
  return `
    <div class="notifications-header">
      <h4>Notification Center</h3>
      <div class="notifications-info"><p>You have 4 unread notifications</p></div>
      <div class="notifications-filter">
        <button>All</button>
        <button>Unread</button>
        <button>Account Changes</button>
        <button>Messages</button>
        <button>Account Request</button>
        <button>Documents</button>
        <button>System</button>
      </div>
    </div>
  `;
}
function renderNotificationList() {
  return `
    <div class="notifications-list">
      <div class="notification-list-container">
        <img src="images/icons/profile-update-icon.png" alt="" class="notification-icon">
        <div class="notification-details">
          <p class="notification-name">Profile Updated</p>
          <p class="notification-time-stamp">Dec 15, 10:30 AM</p>
          <p class="notification-message">Marial Santos updated her contact informatasdadas dasd sdioas dadasda sdasd asdn</p>
        </div>
      </div>
      <div class="notification-list-container">
        <img src="images/icons/message-icon.png" alt="" class="notification-icon">
        <div class="notification-details">
          <p class="notification-name">New Message</p>
          <p class="notification-time-stamp">Dec 14, 03:45 PM</p>
          <p class="notification-message">Juan Dela Cruz sent you a message about his PDOS schedule</p>
        </div>
      </div>
      <div class="notification-list-container">
        <img src="images/icons/account-request-icon.png" alt="" class="notification-icon">
        <div class="notification-details">
          <p class="notification-name">New Account Request</p>
          <p class="notification-time-stamp">Dec 14, 09:20 AM</p>
          <p class="notification-message">Elena Reyes requested to create an account</p>
        </div>
      </div>
      <div class="notification-list-container">
        <img src="images/icons/docs-icon.png" alt="" class="notification-icon">
        <div class="notification-details">
          <p class="notification-name">Document Status Changed</p>
          <p class="notification-time-stamp">Dec 13, 04:10 PM</p>
          <p class="notification-message">Pedro Lim's visa application has been approved</p>
        </div>
      </div>
      <div class="notification-list-container">
        <img src="images/icons/System-maintenance-icon.png" alt="" class="notification-icon">
        <div class="notification-details">
          <p class="notification-name">System Maintenance</p>
          <p class="notification-time-stamp">Dec 13, 11:00 AM</p>
          <p class="notification-message">Scheduled system maintenance on December 20, 2023 from 10:00 PM to 2:00 AM</p>
        </div>
      </div>
      <div class="notification-list-container">
        <img src="images/icons/job-order-icon.png" alt="" class="notification-icon">
        <div class="notification-details">
          <p class="notification-name">New Job Order Posted</p>
          <p class="notification-time-stamp">Dec 13, 11:00 AM</p>
          <p class="notification-message">Scheduled system maintenance on December 20, 2023 from 10:00 PM to 2:00 AM</p>
        </div>
      </div>
    </div>
  `;
}
function renderNotificationContent() {
  return `
    <div class="notifications-content">
      <div class="notification-content-header">
        <div class="notification-content-name">
          <h4>Profile Update</h4>
          <p class = "notification-content-timestamp">
            Dec 15, 10:30 AM
          </p>
        </div>
        <div class="notification-content-actions">
          <button><img src="images/icons/check-icon.png" alt=""></button>
          <button><img src="images/icons/bin-icon.png" alt=""></button>
        </div>
      </div>
      <div class="notification-content-body">
        <div class="notification-user-info">
          <img src="images/icons/sample-profile.jpg" alt="">
          <div class="details">
            <p class="user-name">Marial Santos</p>
            <p class="user-action">User Action</p>
          </div>
        </div>
        <div class="notification-context">
          <p>Juan Dela Cruz sent you a message about his PDOS schedule</p>
          <div class="notification-context-details-job-order">
            <h4>Job Order Details</h4>
            <div>
              <h6>Job Order ID:</h6>
              <p>JO-2023-001</p>
            </div>
            <div>
              <h6>Position:</h6>
              <p>Registered Nurse</p>
            </div>
            <div>
              <h6>Employer:</h6>
              <p>Al Faisal Hospital</p>
            </div>
            <div>
              <h6>Location:</h6>
              <p>Saudi Arabia</p>
            </div>
            <div>
              <h6>Vacancies:</h6>
              <p>25</p>
            </div>
            <button>
              <img src="images/icons/job-order-white-icon.png" alt="">View Job Order
            </button>
          </div>
        </div>
      </div>
    </div>
  `;
}
