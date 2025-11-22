import { notifications } from "../../objects/notifications/data.js";
import { notificationType } from "../../objects/notifications/Objects.js";
import { formatDateTime } from "../../utils/format.js";
export function renderNotificationList() {
  document.querySelector(".notifications-list-js").innerHTML = renderList();

  function renderList() {
    let html = "";
    notifications.forEach((notif) => {
      html += `
      <div class="notification-list-container ${isRead(
        notif.isRead
      )}" data-notification-id="${notif.id}">
        <img src="${selectIconType(
          notif.type
        )}" alt="" class="notification-icon">
        <div class="notification-details">
          <p class="notification-name">${notif.title}</p>
          <p class="notification-time-stamp">
          ${formatDateTime(notif.timestamp)}
          </p>
          <p class="notification-message">${notif.message}</p>
        </div>
        <img class = "notif-tag"src="./images/icons/dot-icon-red.png" alt="">
      </div>
    `;
    });
    return html;
  }
  function selectIconType(type) {
    switch (type) {
      case `${notificationType.ACCOUNT_CHANGES}`:
        return "images/icons/profile-update-icon.png";
      case `${notificationType.MESSAGES}`:
        return "images/icons/message-icon.png";
      case `${notificationType.ACCOUNT_REQUEST}`:
        return "images/icons/account-request-icon.png";
      case `${notificationType.DOCUMENTS}`:
        return "images/icons/docs-icon.png";
      case `${notificationType.SYSTEM}`:
        return "images/icons/System-maintenance-icon.png";
      case `${notificationType.JOB_ORDER}`:
        return "images/icons/job-order-icon.png";
    }
  }
  function isRead(bool) {
    if (bool) return "";
    return "notif-unread";
  }
}
