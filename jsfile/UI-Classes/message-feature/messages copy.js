import { MessagesList } from "./messages-list.js";
import { MessagesConversation } from "./messages-conversation.js";
import { loggedInUser2 } from "../../objects/loggedInUser.js";

const messagesList = new MessagesList();
const messagesConversation = new MessagesConversation();

const renderList = messagesList.render.bind(messagesList);
const renderConversation =
  messagesConversation.render.bind(messagesConversation);

renderList(loggedInUser2, renderConversation);
renderConversation(loggedInUser2, renderList);
