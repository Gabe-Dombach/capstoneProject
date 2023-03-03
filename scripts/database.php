<?php


// Create connection
function connect(){
$servername = "localhost";
$username = "root";
$password = "cset2023";
$dbname = "joshuasgenerals";
    return new mysqli($servername, $username, $password, $dbname);

}



$sql = 
    "CREATE TABLE IF NOT EXISTS users (
        ID BIGINT AUTO_INCREMENT UNIQUE PRIMARY KEY,
        email VARCHAR(50) UNIQUE NOT NULL,
        fname VARCHAR(50),lname VARCHAR(50),
        pswrd VARCHAR(200),accntType CHAR(3));
    CREATE TABLE IF NOT EXISTS cards (
        ID BIGINT,
        crdNum VARCHAR(19),
        srtyCode VARCHAR(4),
        expDate DATE,
        FOREIGN KEY (ID) REFERENCES users(id)
    );
    CREATE TABLE IF NOT EXISTS inventory(
        ID BIGINT PRIMARY KEY AUTO_INCREMENT,
        sellerID BIGINT,
        department VARCHAR(10),
        title VARCHAR(50),
        description VARCHAR(250),
        image VARCHAR(200),
        imageAlt VARCHAR(50),
        price DECIMAL(7,2),
        FOREIGN KEY (sellerID) REFERENCES users(ID)
    );

    CREATE TABLE IF NOT EXISTS reveiws(
        usrID BIGINT NOT NULL,
        prodID BIGINT NOT NULL,
        descript VARCHAR(200),
        rating int CHECK (rating BETWEEN 1 AND 5));
    CREATE TABLE IF NOT EXISTS carts(
        custID BIGINT,
        itemID BIGINT);";

?>