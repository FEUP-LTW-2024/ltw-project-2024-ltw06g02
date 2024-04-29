CREATE TABLE users (
   userID INTEGER PRIMARY KEY,
   username VARCHAR unique,  
   password VARCHAR,              
   email VARCHAR,
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

-- Insert dummy products
INSERT INTO product (name, description, price, categoryID, userID, images) VALUES
('Smartphone', 'A powerful smartphone with advanced features', 599.99, 1, 1, '../assets/placeholder.png'),
('Smartphone', 'A powerful smartphone with advanced features', 599.99, 1, 1, '../assets/placeholder.png'),
('Smartphone', 'A powerful smartphone with advanced features', 599.99, 1, 1, '../assets/placeholder.png'),
('Smartphone', 'A powerful smartphone with advanced features', 599.99, 1, 1, '../assets/placeholder.png'),
('T-shirt', 'A comfortable cotton T-shirt', 19.99, 2, 2, '../assets/placeholder.png'),
('Novel', 'A captivating novel by a renowned author', 9.99, 3, 3, '../assets/placeholder.png'),
('Novel', 'A captivating novel by a renowned author', 9.99, 3, 3, '../assets/placeholder.png'),
('Novel', 'A captivating novel by a renowned author', 9.99, 3, 3, '../assets/placeholder.png'),
('Novel', 'A captivating novel by a renowned author', 9.99, 3, 3, '../assets/placeholder.png'),
('Novel', 'A captivating novel by a renowned author', 9.99, 3, 3, '../assets/placeholder.png'),
('Novel', 'A captivating novel by a renowned author', 9.99, 3, 3, '../assets/placeholder.png');

-- Insert dummy transactions
INSERT INTO transactions (buyerID, sellerID, productID, transactionDate) VALUES
(1, 2, 1, '2024-04-01 08:00:00'),
(2, 3, 2, '2024-04-02 10:00:00'),
(3, 1, 3, '2024-04-03 12:00:00');

-- Insert dummy messages
INSERT INTO message (buyerID, sellerID, productID, messageText, messageDate) VALUES
(1, 2, 1, "Hi, I'm interested in buying your smartphone.", '2024-04-01 07:59:00'),
(2, 3, 2, "Is this T-shirt available in other colors?", '2024-04-02 09:59:00'),
(3, 1, 3, "Could you provide more details about the novel?", '2024-04-03 11:59:00');
