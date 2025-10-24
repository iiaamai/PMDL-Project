import { chat, message, chatMembers } from "./objects.js";
import { users, getUser } from "../users.js";

export class ChatManager {
  constructor() {
    this.chats = JSON.parse(localStorage.getItem("chats")) || [
      {
        id: 1,
        chatName: "",
        createdBy: users[0].id,
        createdAt: Date.now() - 1000 * 60 * 60 * 24,
      },
      {
        id: 2,
        chatName: "",
        createdBy: users[2].id,
        createdAt: Date.now() - 1000 * 60 * 60 * 12,
      },
      {
        id: 3,
        chatName: "",
        createdBy: users[4].id,
        createdAt: Date.now() - 1000 * 60 * 60 * 6,
      },
      {
        id: 4,
        chatName: "",
        createdBy: users[6].id,
        createdAt: Date.now() - 1000 * 60 * 60 * 2,
      },
    ];

    this.chatMessages = JSON.parse(localStorage.getItem("chatMessages")) || [
      {
        id: 1,
        chatId: 1,
        senderId: users[0].id,
        message: "Hey Jane, are you free for lunch tomorrow?",
        timestamp: Date.now() - 1000 * 60 * 60 * 23,
        isRead: true,
      },
      {
        id: 2,
        chatId: 1,
        senderId: users[1].id,
        message:
          "Hi John — yes, midday works for me. Where do you want to meet?",
        timestamp: Date.now() - 1000 * 60 * 60 * 22,
        isRead: true,
      },
      {
        id: 3,
        chatId: 1,
        senderId: users[0].id,
        message: "How about the cafe near the park at 12:30?",
        timestamp: Date.now() - 1000 * 60 * 60 * 21,
        isRead: false,
      },
      {
        id: 4,
        chatId: 1,
        senderId: users[1].id,
        message: "Perfect — see you then!",
        timestamp: Date.now() - 1000 * 60 * 60 * 20,
        isRead: false,
      },
      {
        id: 5,
        chatId: 2,
        senderId: users[2].id,
        message: "Hey Bob, did you finish the report?",
        timestamp: Date.now() - 1000 * 60 * 60 * 11,
        isRead: true,
      },
      {
        id: 6,
        chatId: 2,
        senderId: users[3].id,
        message: "Almost done; I'll send it by tonight.",
        timestamp: Date.now() - 1000 * 60 * 60 * 10,
        isRead: false,
      },
      {
        id: 7,
        chatId: 3,
        senderId: users[4].id,
        message: "Sophie, can you review the design mockups?",
        timestamp: Date.now() - 1000 * 60 * 60 * 5,
        isRead: false,
      },
      {
        id: 8,
        chatId: 3,
        senderId: users[5].id,
        message: "On it — I'll give feedback in an hour.",
        timestamp: Date.now() - 1000 * 60 * 60 * 4.5,
        isRead: false,
      },
      {
        id: 9,
        chatId: 4,
        senderId: users[6].id,
        message: "Maria, are you joining the call at 3pm?",
        timestamp: Date.now() - 1000 * 60 * 60 * 1.5,
        isRead: false,
      },
      {
        id: 10,
        chatId: 4,
        senderId: users[7].id,
        message: "Yes — I'll be there in 5 minutes.",
        timestamp: Date.now() - 1000 * 60 * 60 * 1,
        isRead: false,
      },
    ];

    this.chatMembers = JSON.parse(localStorage.getItem("chatMembersList")) || [
      { chatId: 1, userId: users[0].id },
      { chatId: 1, userId: users[1].id },
      { chatId: 2, userId: users[2].id },
      { chatId: 2, userId: users[3].id },
      { chatId: 3, userId: users[4].id },
      { chatId: 3, userId: users[5].id },
      { chatId: 4, userId: users[6].id },
      { chatId: 4, userId: users[7].id },
    ];
  }

  // ======= Utility methods =======

  save() {
    localStorage.setItem("chats", JSON.stringify(this.chats));
    localStorage.setItem("chatMessages", JSON.stringify(this.chatMessages));
    localStorage.setItem("chatMembersList", JSON.stringify(this.chatMembers));
  }

  clear() {
    localStorage.removeItem("chats");
    localStorage.removeItem("chatMessages");
    localStorage.removeItem("chatMembersList");
  }

  // ======= CRUD operations =======

  createChat(createdBy) {
    const newChat = {
      id: this.chats.length + 1,
      chatName: "",
      createdBy,
      createdAt: Date.now(),
    };
    this.chats.push(newChat);
    return newChat;
  }

  createChatMembers(chatId, userId) {
    const newChatMember = { chatId, userId };
    this.chatMembers.push(newChatMember);
    console.log("chat member:", newChatMember);
    return newChatMember;
  }

  createMessage(chatId, senderId, message) {
    const newMessage = {
      id: this.chatMessages.length + 1,
      chatId,
      senderId,
      message,
      timestamp: Date.now(),
      isRead: false,
    };
    this.chatMessages.push(newMessage);
    return newMessage;
  }

  // ======= Getters =======

  getChat(chatId) {
    return this.chats.find((c) => c.id === chatId);
  }

  getChats(userId) {
    const result = [];
    this.chatMembers.forEach((member) => {
      if (member.userId === userId) {
        const chat = this.getChat(member.chatId);
        if (chat) result.push(chat);
      }
    });
    return result;
  }

  getChatMembers(chatId) {
    return this.chatMembers.filter((m) => m.chatId === chatId);
  }

  getChatMessages(chatId) {
    return this.chatMessages.filter((m) => m.chatId === chatId);
  }

  isChatExist(userA, userB) {
    return this.chats.some((chat) => {
      const members = this.getChatMembers(chat.id);
      const memberIds = members.map((m) => m.userId);
      return memberIds.includes(userA) && memberIds.includes(userB);
    });
  }

  // ======= Helpers =======

  getLatestMessage(messages) {
    if (!messages || messages.length === 0) return "New Chat.";
    return messages.reduce((latest, msg) =>
      msg.timestamp > latest.timestamp ? msg : latest
    );
  }

  formatTime(message) {
    if (!message || !message.timestamp) return "";
    const date = new Date(message.timestamp);
    return date.toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
      hour12: true,
    });
  }

  setChatName(loggedInUser, chat) {
    const members = this.getChatMembers(chat.id);
    const otherMember = members.find((m) => m.userId !== loggedInUser.id);
    if (!otherMember) return "Unknown Chat";
    const memberUser = users.find((u) => u.id === otherMember.userId);
    return `${memberUser.firstName} ${memberUser.lastName}`;
  }

  getConversationWith(chat, loggedInUser) {
    const members = this.getChatMembers(chat.id);
    const other = members.find((m) => m.userId !== loggedInUser.id);
    if (!other) return null;
    return users.find((u) => u.id === other.userId);
  }
}

export const chatManager = new ChatManager();
