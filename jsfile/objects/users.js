class user {
  #id;
  #lastName;
  #firstName;
  #middleName;
  #birthDate;
  #email;
  #password;

  constructor(id, lastName, firstName, middleName, birthDate, email, password) {
    this.#id = id;
    this.#lastName = lastName;
    this.#firstName = firstName;
    this.#middleName = middleName;
    this.#birthDate = birthDate;
    this.#email = email;
    this.#password = password;
  }

  // Getters
  get id() {
    return this.#id;
  }
  get lastName() {
    return this.#lastName;
  }
  get firstName() {
    return this.#firstName;
  }
  get middleName() {
    return this.#middleName;
  }
  get birthDate() {
    return this.#birthDate;
  }
  get email() {
    return this.#email;
  }
  get password() {
    return this.#password;
  }

  // Setters
  set id(v) {
    this.#id = v;
  }
  set lastName(v) {
    this.#lastName = v;
  }
  set firstName(v) {
    this.#firstName = v;
  }
  set middleName(v) {
    this.#middleName = v;
  }
  set birthDate(v) {
    this.#birthDate = v;
  }
  set email(v) {
    this.#email = v;
  }
  set password(v) {
    this.#password = v;
  }
}

export const users = [
  new user(
    1,
    "Doe",
    "John",
    "A",
    "1990-01-01",
    "john.doe@example.com",
    "pass1"
  ),
  new user(
    2,
    "Smith",
    "Jane",
    "B",
    "1992-05-15",
    "jane.smith@example.com",
    "pass2"
  ),
  new user(
    3,
    "Brown",
    "Alice",
    "C",
    "1988-09-03",
    "alice.brown@example.com",
    "pass3"
  ),
  new user(
    4,
    "Wilson",
    "Bob",
    "D",
    "1995-12-20",
    "bob.wilson@example.com",
    "pass4"
  ),
  new user(
    5,
    "Martinez",
    "Carlos",
    "E",
    "1987-07-11",
    "carlos.martinez@example.com",
    "pass5"
  ),
  new user(
    6,
    "Lee",
    "Sophie",
    "F",
    "1993-03-22",
    "sophie.lee@example.com",
    "pass6"
  ),
  new user(
    7,
    "Patel",
    "Amit",
    "G",
    "1991-11-08",
    "amit.patel@example.com",
    "pass7"
  ),
  new user(
    8,
    "García",
    "Maria",
    "H",
    "1994-06-30",
    "maria.garcia@example.com",
    "pass8"
  ),
];

export function getUser(userId) {
  let returnUser = null;
  users.forEach((user) => {
    if (user.id === userId) {
      returnUser = user;
      console.log(returnUser);
    }
  });
  return returnUser;
}
