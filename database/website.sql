CREATE TABLE users (
   userID INTEGER PRIMARY KEY,
   username VARCHAR unique,  
   password VARCHAR,              
   email VARCHAR,
   fullName VARCHAR,
   paymentMethodPassword VARCHAR,
   avatar VARCHAR
);

CREATE TABLE product (
   productID INTEGER PRIMARY KEY,
   name VARCHAR,
   description VARCHAR,
   price REAL,
   categoryID INTEGER,
   userID INTEGER,
   images VARCHAR,  -- check out later
   FOREIGN KEY (userID) REFERENCES users(userID),
   FOREIGN KEY (categoryID) REFERENCES productCategory(categoryID)
);

CREATE TABLE productCategory (
   categoryID INTEGER PRIMARY KEY,
   name VARCHAR
);

CREATE TABLE transactions (
   transactionID INTEGER PRIMARY KEY,
   buyerID INTEGER,
   sellerID INTEGER,
   productID INTEGER,
   transactionDate DATETIME,
   FOREIGN KEY (buyerID) REFERENCES users(userID),
   FOREIGN KEY (sellerID) REFERENCES users(userID),
   FOREIGN KEY (productID) REFERENCES product(productID)
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

INSERT INTO productCategory (name) VALUES
('Electronics'),
('Clothing'),
('Books');

INSERT INTO chat (receiverID, senderID, productID, lastAction) VALUES
(1, 2, 1, 'última mensagem'),
(1, 3, 1, 'teste amigo');