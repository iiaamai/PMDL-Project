// =========================
// Notification Types
// =========================
export const notificationType = {
  ACCOUNT_CHANGES: "ACCOUNT_CHANGES",
  MESSAGES: "MESSAGES",
  ACCOUNT_REQUEST: "ACCOUNT_REQUEST",
  DOCUMENTS: "DOCUMENTS",
  SYSTEM: "SYSTEM",
  JOB_ORDER: "JOB_ORDER",
};

// =========================
// Base Notification Class
// =========================
export class Notification {
  #id;
  #type;
  #title;
  #message;
  #timestamp;
  #isRead;

  constructor({
    id,
    type,
    title,
    message,
    timestamp = new Date(),
    isRead = false,
  }) {
    this.#id = id;
    this.#type = type;
    this.#title = title;
    this.#message = message;
    this.#timestamp = timestamp;
    this.#isRead = isRead;
  }

  // Getters
  get id() {
    return this.#id;
  }
  get type() {
    return this.#type;
  }
  get title() {
    return this.#title;
  }
  get message() {
    return this.#message;
  }
  get timestamp() {
    return this.#timestamp;
  }
  get isRead() {
    return this.#isRead;
  }

  // Methods
  markAsRead() {
    this.#isRead = true;
  }
}

// =========================
// Account Changes Notification
// =========================
export class AccountChangesNotification extends Notification {
  #updatedFields; // array of fields changed
  #updatedBy; // user ID or username

  constructor({
    id,
    type = notificationType.ACCOUNT_CHANGES,
    title,
    message,
    timestamp = new Date(),
    isRead = false,
    updatedFields,
    updatedBy,
  }) {
    super({
      id,
      type,
      title,
      message,
      timestamp,
      isRead,
    });
    this.#updatedFields = updatedFields;
    this.#updatedBy = updatedBy;
  }

  get updatedFields() {
    return this.#updatedFields;
  }
  get updatedBy() {
    return this.#updatedBy;
  }
}

// =========================
// Message Notification
// =========================
export class MessageNotification extends Notification {
  #fromUser;
  #conversationId;

  constructor({
    id,
    type = notificationType.MESSAGES,
    title,
    message,
    timestamp = new Date(),
    isRead = false,
    fromUser,
    conversationId,
  }) {
    super({
      id,
      type,
      title,
      message,
      timestamp,
      isRead,
    });
    this.#fromUser = fromUser;
    this.#conversationId = conversationId;
  }

  get fromUser() {
    return this.#fromUser;
  }
  get conversationId() {
    return this.#conversationId;
  }
}

// =========================
// Account Request Notification
// =========================
export class AccountRequestNotification extends Notification {
  #requestId;
  #status; // pending, approved, rejected

  constructor({
    id,
    type = notificationType.ACCOUNT_REQUEST,
    title,
    message,
    timestamp = new Date(),
    isRead = false,
    requestId,
    status,
  }) {
    super({
      id,
      type,
      title,
      message,
      timestamp,
      isRead,
    });
    this.#requestId = requestId;
    this.#status = status;
  }

  get requestId() {
    return this.#requestId;
  }
  get status() {
    return this.#status;
  }
}

// =========================
// Document Notification
// =========================
export class DocumentNotification extends Notification {
  #documentId;
  #action; // uploaded, approved, rejected, updated

  constructor({
    id,
    type = notificationType.DOCUMENTS,
    title,
    message,
    timestamp = new Date(),
    isRead = false,
    documentId,
    action,
  }) {
    super({
      id,
      type,
      title,
      message,
      timestamp,
      isRead,
    });
    this.#documentId = documentId;
    this.#action = action;
  }

  get documentId() {
    return this.#documentId;
  }
  get action() {
    return this.#action;
  }
}

// =========================
// System Notification
// =========================
export class SystemNotification extends Notification {
  #severity; // low, normal, high, critical

  constructor({
    id,
    type = notificationType.SYSTEM,
    title,
    message,
    timestamp = new Date(),
    isRead = false,
    severity,
  }) {
    super({
      id,
      type,
      title,
      message,
      timestamp,
      isRead,
    });
    this.#severity = severity;
  }

  get severity() {
    return this.#severity;
  }
}

// =========================
// Job Order Notification
// =========================
export class JobOrderNotification extends Notification {
  #jobId;
  #status; // assigned, completed, cancelled, updated

  constructor({
    id,
    type = notificationType.JOB_ORDER,
    title,
    message,
    timestamp = new Date(),
    isRead = false,
    jobId,
    status,
  }) {
    super({
      id,
      type,
      title,
      message,
      timestamp,
      isRead,
    });
    this.#jobId = jobId;
    this.#status = status;
  }

  get jobId() {
    return this.#jobId;
  }
  get status() {
    return this.#status;
  }
}
