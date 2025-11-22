import { renderNotificationList } from "./notifications/notifications-list.js";
renderNotificationList();
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
