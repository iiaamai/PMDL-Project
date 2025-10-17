const isConversationEmpty = false;

function scrollConversationToBottom() {
  const chat = document.querySelector(".conversation-messages");
  if (!chat) return;
  chat.scrollTop = chat.scrollHeight;
}

if (!isConversationEmpty) {
  function initScroll() {
    scrollConversationToBottom();
    window.addEventListener("load", scrollConversationToBottom);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initScroll);
  } else {
    initScroll();
  }
} else {
  document.querySelector(".messages-conversation-js").innerHTML = `
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
}
