import {
  getChats,
  getChatMessages,
  getLatestMessage,
  formatTime,
  setChatName,
} from "../../objects/message/data.js";

export function renderMessagesList(loggedInUser) {
  console.log(loggedInUser.firstName);
  const userChats = getChats(loggedInUser.id);
  const messagesListContainer = document.querySelector(".messages-list-js");

  if (userChats.length === 0) {
    messagesListContainer.innerHTML += `
      <div class="list empty-list">
        <div class = "chat-icon-error">
          <img src="images/icons/no-chat-list.svg" alt="">
        </div>
        No conversation(s) found.
      </div>
    `;
    return;
  }
  messagesListContainer.innerHTML += `
    <div class="lists">
      ${renderChatList()}
    </div>
  `;
  function renderChatList() {
    let html = "";
    userChats.forEach((chat) => {
      const messages = getChatMessages(chat.id);
      html += `
        <div class="conversation" data-chat-id="${chat.id}">
          <img src="images/icons/sample-profile.jpg" alt="" />
          <div class="details">
            <div>
              <h4 class="name">${setChatName(loggedInUser, userChats)}</h4>
              <span class="time">
              ${formatTime(getLatestMessage(messages))}
              </span>
            </div>
            <p class="chat">
              ${getLatestMessage(messages).message}
            </p>
          </div>
          <span class="notif">🔴</span>
        </div>
      `;
    });
    return html;
  }
}
