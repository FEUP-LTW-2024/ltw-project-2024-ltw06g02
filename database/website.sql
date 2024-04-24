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
   buyerID INTEGER,
   sellerID INTEGER,
   productID INTEGER,
   messageText VARCHAR,
   messageDate DATETIME,
   FOREIGN KEY (buyerID) REFERENCES users(userID),
   FOREIGN KEY (sellerID) REFERENCES users(userID),
   FOREIGN KEY (productID) REFERENCES product(productID)
);

INSERT INTO productCategory (name) VALUES
('Electronics'),
('Clothing'),
('Books');