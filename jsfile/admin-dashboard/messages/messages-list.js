export function renderMessagesList() {
  const messagesListContainer = document.querySelector(".messages-list-js");
  const isMessagesListEmpty = true;

  if (isMessagesListEmpty) {
    messagesListContainer.innerHTML = `
      <div class="list-header">
          <h3>Messages</h3>
          <div class="search">
            <span>
              <img src="images/icons/search-icon.svg" alt="Search"/>
            </span>
            <input type="text" placeholder="Search..." />
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
  messagesListContainer.innerHTML = `
    <div class="list-header">
      <h3>Messages</h3>
      <div class="search">
        <span>
          <img src="images/icons/search-icon.svg" alt="Search"/>
        </span>
        <input type="text" placeholder="Search..." />
      </div>
    </div>
    <div class="lists">
      <div class="conversation convo-notif">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Maria Santos</h4>
            <span class="time">10:23 AM</span>
          </div>
          <p class="chat">I submitted my medical certificate erd</p>
        </div>
        <span class="notif notif-active">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Juan Dela Cruz</h4>
            <span class="time">Yesterday</span>
          </div>
          <p class="chat">When will my PDOS be scheduled</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Ana Reyes</h4>
            <span class="time">Dec 12</span>
          </div>
          <p class="chat">Thank you for helping with my OEC cat</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Pedro Lim</h4>
            <span class="time">Dec 10</span>
          </div>
          <p class="chat">My Flight is confirmed for January 15th</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Pedro Lim</h4>
            <span class="time">Dec 10</span>
          </div>
          <p class="chat">My Flight is confirmed for January 15th</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Pedro Lim</h4>
            <span class="time">Dec 10</span>
          </div>
          <p class="chat">My Flight is confirmed for January 15th</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Pedro Lim</h4>
            <span class="time">Dec 10</span>
          </div>
          <p class="chat">My Flight is confirmed for January 15th</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Pedro Lim</h4>
            <span class="time">Dec 10</span>
          </div>
          <p class="chat">My Flight is confirmed for January 15th</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Pedro Lim</h4>
            <span class="time">Dec 10</span>
          </div>
          <p class="chat">My Flight is confirmed for January 15th</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Pedro Lim</h4>
            <span class="time">Dec 10</span>
          </div>
          <p class="chat">My Flight is confirmed for January 15th</p>
        </div>
        <span class="notif">🔴</span>
      </div>
      <div class="conversation">
        <img src="images/icons/sample-profile.jpg" alt="" />
        <div class="details">
          <div>
            <h4 class="name">Pedro Lim</h4>
            <span class="time">Dec 10</span>
          </div>
          <p class="chat">My Flight is confirmed for January 15th</p>
        </div>
        <span class="notif">🔴</span>
      </div>
    </div>
  `;
}
