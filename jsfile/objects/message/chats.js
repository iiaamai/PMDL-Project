class message {
  #id;
  #message;
  #timestamp;
  #isRead;

  constructor(id, message, timestamp, isRead) {
    this.#id = id;
    this.#message = message;
    this.#timestamp = timestamp;
    this.#isRead = isRead;
  }
}
