CREATE TABLE users (
   userID INTEGER PRIMARY KEY,
   username VARCHAR unique,      -- unique username
   password VARCHAR,                  -- password stored in sha-1
   email VARCHAR,
   paymentMethodPassword VARCHAR  -- cartão (BPI, etc) ??                       -- real name
);

CREATE TABLE product (
   productID INTEGER PRIMARY KEY,
   name VARCHAR,
   description VARCHAR,
   price REAL,
   categoryID INTEGER,
   inventoryID INTEGER,
   images BLOB,  -- check out later
   FOREIGN KEY (inventoryID) REFERENCES inventory(inventoryID),
   FOREIGN KEY (categoryID) REFERENCES productCategory(categoryID)
);

CREATE TABLE productCategory (
   categoryID INTEGER PRIMARY KEY,
   name VARCHAR
);

CREATE TABLE inventory (
   inventoryID INTEGER PRIMARY KEY,
   seller_id INTEGER,
   FOREIGN KEY (seller_id) REFERENCES users(userID)
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