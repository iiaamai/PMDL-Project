import {
  getChats,
  getChatMessages,
  getLatestMessage,
  formatTime,
  setChatName,
  chats,
  chatMembersList,
  isChatExist,
} from "../../objects/message/data.js";
import { users } from "../../objects/users.js";
import { chat, chatMembers } from "../../objects/message/objects.js";

export function renderMessagesList(loggedInUser, renderConversation) {
  const messagesListContainer = document.querySelector(".messages-list-js");

  messagesListContainer.innerHTML = "";
  console.log("chat list - Logged User: ", loggedInUser.firstName);
  const userChats = getChats(loggedInUser.id);

  if (userChats.length === 0) {
    messagesListContainer.innerHTML += `
      <div class="list-header">
        <h3>Messages</h3>
        <div class="search">
          <span>
            <img src="images/icons/search-icon.svg" alt="Search"/>
          </span>
          <input type="text" placeholder="Search..." />
          <div class="search-result">
            
          </div>
        </div>
      </div>
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
    <div class="list-header">
      <h3>Messages</h3>
      <div class="search">
        <span>
          <img src="images/icons/search-icon.svg" alt="Search"/>
        </span>
        <input type="text" placeholder="Search..." />
        <div class="search-result">
          
        </div>
      </div>
    </div>
    <div class="lists">
      ${renderChatList()}
    </div>
  `;
  openConversation();

  let timeout;
  const searchResult = document.querySelector(".search-result");
  const searchInput = document.querySelector(".search input");
  searchInput.addEventListener("keyup", (e) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      const searchTerm = e.target.value.toLowerCase().trim();

      if (!searchTerm) {
        searchResult.innerHTML = `<p>Type to search...</p>`;
        searchResult.classList.remove("search-result-popup");
        return;
      }

      const result = users
        .filter((user) =>
          `${user.firstName} ${user.lastName}`
            .toLowerCase()
            .includes(searchTerm)
        )
        .filter((user) => user.id !== loggedInUser.id);

      searchResult.innerHTML = renderSearchResults(result);
      searchResult.classList.add("search-result-popup");
      clickProfile();
    }, 300);
  });

  function renderSearchResults(searchUsers) {
    let html = "";
    if (searchUsers.length === 0) {
      return `<p>No results found.</p>`;
    }
    searchUsers.forEach((user) => {
      html += `
      <div class="profile profile-js" data-user-id="${user.id}">
        <img src="${user.profilePicture}" alt="User Profile" />
        <h4>${user.firstName + " " + user.lastName}</h4>
      </div>
      `;
    });
    return html;
  }

  function renderChatList() {
    let html = "";
    userChats.forEach((chat) => {
      const messages = getChatMessages(chat.id);
      let timestamp = "";
      let latestMessage = "New Chat.";

      if (messages && messages.length > 0) {
        const latestMsg = getLatestMessage(messages);
        timestamp = formatTime(latestMsg);
        if (loggedInUser.id === latestMsg.senderId) {
          latestMessage = "You: " + latestMsg.message;
        } else {
          latestMessage = latestMsg.message;
        }
      }
      html += `
        <div class="conversation conversation-js" data-chat-id="${chat.id}">
          <img src="images/icons/sample-profile.jpg" alt="" />
          <div class="details">
            <div>
              <h4 class="name">${setChatName(loggedInUser, chat)}</h4>
              <span class="time">
              ${timestamp}
              </span>
            </div>
            <p class="chat">
              ${latestMessage}
            </p>
          </div>
          <span class="notif">🔴</span>
        </div>
      `;
    });
    return html;
  }
  function clickProfile() {
    const profiles = document.querySelectorAll(".profile-js");
    profiles.forEach((profile) => {
      profile.addEventListener("click", (e) => {
        const userId = Number(profile.dataset.userId);
        if (isChatExist(loggedInUser.id, userId)) {
          searchResult.classList.remove("search-result-popup");
          searchInput.value = "";
          console.log("chat exist");
          return;
        }
        const newChat = new chat(
          chats.length + 1,
          "",
          loggedInUser.id,
          Date.now()
        );
        const newChatMembers1 = new chatMembers(
          chatMembersList.length + 1,
          newChat.id,
          userId
        );
        const newChatMembers2 = new chatMembers(
          chatMembersList.length + 2,
          newChat.id,
          loggedInUser.id
        );
        chats.push(newChat);
        chatMembersList.push(newChatMembers1);
        chatMembersList.push(newChatMembers2);
        searchResult.classList.remove("search-result-popup");
        renderMessagesList(loggedInUser, renderConversation);
      });
    });
  }
  function openConversation() {
    document.querySelectorAll(".conversation-js").forEach((convo) => {
      convo.addEventListener("click", () => {
        const chatId = Number(convo.dataset.chatId);
        console.log(chatId);
        renderConversation(loggedInUser, chatId);
      });
    });
  }
}
