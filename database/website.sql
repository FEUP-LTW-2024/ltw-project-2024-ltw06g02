CREATE TABLE users (
   userID INTEGER PRIMARY KEY,
   username VARCHAR unique,  
   password VARCHAR,              
   email VARCHAR,
   fullName VARCHAR,
   admin BOOLEAN,
   avatar VARCHAR,
   followers INTEGER,
   preferencesID INTEGER,
   FOREIGN KEY (preferencesID) REFERENCES preferences(preferencesID)
);

CREATE TABLE follow (
   followID INTEGER PRIMARY KEY,
   userID INTEGER,
   requesterID INTEGER,
   FOREIGN KEY (userID) REFERENCES users(userID),
   FOREIGN KEY (requesterID) REFERENCES users(userID)
);

CREATE TABLE product (
   productID INTEGER PRIMARY KEY,
   name VARCHAR,
   description VARCHAR,
   price REAL,
   categoryID INTEGER,
   sizeID INTEGER,
   conditionID INTEGER,
   userID INTEGER,
   brand VARCHAR,
   model VARCHAR,
   images VARCHAR,
   likes INTEGER,
   promotion REAL,
   FOREIGN KEY (userID) REFERENCES users(userID),
   FOREIGN KEY (categoryID) REFERENCES productCategory(categoryID),
   FOREIGN KEY (sizeID) REFERENCES productSize(sizeID),
   FOREIGN KEY (conditionID) REFERENCES productCondition(conditionID)
);

CREATE TABLE favorites (
   favoriteID INTEGER PRIMARY KEY,
   userID INTEGER,
   productID INTEGER,
   FOREIGN KEY (userID) REFERENCES users(userID),
   FOREIGN KEY (productID) REFERENCES product(productID)
);

CREATE TABLE cart (
   cartID INTEGER PRIMARY KEY,
   userID INTEGER,
   productID INTEGER,
   FOREIGN KEY (userID) REFERENCES users(userID),
   FOREIGN KEY (productID) REFERENCES product(productID)
);

CREATE TABLE productCategory (
   categoryID INTEGER PRIMARY KEY,
   name VARCHAR
);

CREATE TABLE productSize (
   sizeID INTEGER PRIMARY KEY,
   name VARCHAR
);

CREATE TABLE productCondition (
   conditionID INTEGER PRIMARY KEY,
   name VARCHAR
);

CREATE TABLE preferences (
   preferencesID INTEGER PRIMARY KEY,
   userID INTEGER,
   sizeID INTEGER,
   categoryID INTEGER,
   conditionID INTEGER,
   FOREIGN KEY (userID) REFERENCES users(userID),
   FOREIGN KEY (sizeID) REFERENCES productSize(sizeID),
   FOREIGN KEY (categoryID) REFERENCES categoryID(categoryID),
   FOREIGN KEY (conditionID) REFERENCES conditionID(conditionID)
);

CREATE TABLE message (
   messageID INTEGER PRIMARY KEY,
   chatID INTEGER,
   messageText VARCHAR,
   messageDate DATETIME,
   FOREIGN KEY (chatID) REFERENCES chat(chatID)
);

CREATE TABLE chat (
   chatID INTEGER PRIMARY KEY,
   receiverID INTEGER,
   senderID INTEGER,
   productID INTEGER,
   lastAction VARCHAR,
   FOREIGN KEY (receiverID) REFERENCES users(userID),
   FOREIGN KEY (senderID) REFERENCES users(userID),
   FOREIGN KEY (productID) REFERENCES product(productID)
);

CREATE TABLE purchase (
   purchaseID INTEGER PRIMARY KEY,
   userID INTEGER,
   productName VARCHAR,
   productPrice REAL,
   notificationText VARCHAR,
   notificationDate DATETIME,
   FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE TABLE sale (
   saleID INTEGER PRIMARY KEY,
   userID INTEGER,
   productName VARCHAR,
   productPrice REAL,
   notificationText VARCHAR,
   notificationDate DATETIME,
   FOREIGN KEY (userID) REFERENCES users(userID)
);

INSERT INTO productCategory (name) VALUES
('Electronics'),
('Clothing'),
('Sports'),
('Decoration'),
('Books');

INSERT INTO productSize (name) VALUES
('S'),
('M'),
('L');

INSERT INTO productCondition (name) VALUES
('Semi-used'),
('Very used'),
('New');

INSERT INTO users (username, password, email, fullName, admin, avatar, followers) VALUES
('john-doe', '$2y$10$NpKhYrKobB3.oUsCO9kMRuRzjbCY65GJ2OTQCaXJi9oYcyWZAOXAK', 'johndoe@gmail.com', 'John Doe', true, '../assets/users/user.jpg', 0);

INSERT INTO product (name, description, price, categoryID, conditionID, userID, images, likes) VALUES
('Homo Deus', 'A great book about the future', '14.99', 5, 3, 1, '../assets/products/homo-deus.webp', 0);