CREATE TABLE users (
   userID INTEGER PRIMARY KEY,
   username VARCHAR unique,  
   password VARCHAR,              
   email VARCHAR,
   fullName VARCHAR,
   paymentMethodPassword VARCHAR,
   admim BOOLEAN,
   avatar VARCHAR
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
   images VARCHAR,  -- check out later
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

INSERT INTO productSize (name) VALUES
('S'),
('M'),
('L');

INSERT INTO productCondition (name) VALUES
('Semi-used'),
('Very used');
