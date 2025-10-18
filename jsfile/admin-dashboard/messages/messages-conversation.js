export function renderMessagesConversation() {
  const chatContainer = document.querySelector(".messages-conversation-js");
  const isConversationEmpty = true;

  if (isConversationEmpty) {
    chatContainer.innerHTML = `
    <div class="conversation-container-error">
      <div class="conversation-image-container-error">
        <img class = "conversation-image-error" src="images/icons/message-icon.svg" alt="" />
      </div>
      <div class="conversation-message-error">
        <h3>Your Messages</h3>
        <p>Select a conversation to start messaging</p>
      </div>
    </div>
    `;
    return;
  }

  function initScroll() {
    scrollConversationToBottom();
    window.addEventListener("load", scrollConversationToBottom);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initScroll);
  } else {
    initScroll();
  }

  function scrollConversationToBottom() {
    const chat = document.querySelector(".conversation-messages");
    if (!chat) return;
    chat.scrollTop = chat.scrollHeight;
  }

  chatContainer.innerHTML = `
    <div class="conversation-container">
      <div class="conversation-name">
        <img src="images/icons/sample-profile.jpg" alt="" class="chat-profile">
        <div class="chat-details">
          <h3 class="chat-name">Maria Santos</h3>
          <p class="chat-status">Online</p>
        </div>
      </div>

      <div class="conversation-chat">
        <div class="conversation-messages">
          <div class="chat-reply">
            <div class = "conversatrion-message">
              <p>
                Hello Admin, I have submitted my medical certificate. When can I expect my OEC to be processed?
              </p>
              <p class="time-stamp">9:30 AM<span class="isRead">&#10003&#10003</span></p>
            </div>
          </div>
          <div class="chat-sent">
            <div class = "conversatrion-message">
              <p>
                Thank you for the update, Maria. We will process your OEC within 3-5 business days.
              </p>
                <p class="time-stamp">9:35 AM<span class="isRead">&#10003</span></p>
            </div>
          </div>
          <div class="chat-reply">
            <div class = "conversatrion-message">
              <p>
                Hello Admin, I have submitted my medical certificate. When can I expect my OEC to be processed?
              </p>
              <p class="time-stamp">9:30 AM<span class="isRead">&#10003&#10003</span></p>
            </div>
          </div>
          <div class="chat-sent">
            <div class = "conversatrion-message">
              <p>
                Thank you for the update, Maria. We will process your OEC within 3-5 business days.
              </p>
                <p class="time-stamp">9:35 AM<span class="isRead">&#10003</span></p>
            </div>
          </div>
          <div class="chat-reply">
            <div class = "conversatrion-message">
              <p>
                Hello Admin, I have submitted my medical certificate. When can I expect my OEC to be processed?
              </p>
              <p class="time-stamp">9:30 AM<span class="isRead">&#10003&#10003</span></p>
            </div>
          </div>
          <div class="chat-sent">
            <div class = "conversatrion-message">
              <p>
                Thank you for the update, Maria. We will process your OEC within 3-5 business days.
              </p>
                <p class="time-stamp">9:35 AM<span class="isRead">&#10003</span></p>
            </div>
          </div>
          <div class="chat-reply">
            <div class = "conversatrion-message">
              <p>
                Hello Admin, I have submitted my medical certificate. When can I expect my OEC to be processed?
              </p>
              <p class="time-stamp">9:30 AM<span class="isRead">&#10003&#10003</span></p>
            </div>
          </div>
          <div class="chat-sent">
            <div class = "conversatrion-message">
              <p>
                Thank you for the update, Maria. We will process your OEC within 3-5 business days.
              </p>
                <p class="time-stamp">9:35 AM<span class="isRead">&#10003</span></p>
            </div>
          </div>
        </div>
      </div>

      <div class="conversation-type-message">
        <span class="attach">
          <img class="message-type-icon" src="images/icons/attach-file-icon.svg">
        </span>
        <input type="text" class="message-type" placeholder="Type here...">
        <span class="send">
          <img class="message-type-icon" src="images/icons/send-icon.svg">
        </span>
      </div>
    </div>
    `;
}
