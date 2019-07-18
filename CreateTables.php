<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli ( $servername, $username, $password, $dbname );
// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}

// sql to create table
$sql = "CREATE TABLE reg(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
firstName VARCHAR(100) NOT NULL,
lastName VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
password VARCHAR(50) NOT NULL,
gender VARCHAR(6) NOT NULL,
avatar VARCHAR(255) NULL
)";
if ($conn->query ( $sql ) === TRUE) {
	echo "Table reg created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE images(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(100) NOT NULL,
name VARCHAR(100) NOT NULL,
path VARCHAR(200) NOT NULL,
type VARCHAR(100) NOT NULL
)";



if ($conn->query ( $sql ) === TRUE) {
	echo "Table images created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE posts(

         
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

name VARCHAR(100) NOT NULL,
author VARCHAR(16) NOT NULL,
email VARCHAR(100) NOT NULL,
data VARCHAR(100) NOT NULL,
type ENUM('a','b','c') NOT NULL

)";



if ($conn->query ( $sql ) === TRUE) {
	echo "Table posts created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE friends(

                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                user1 VARCHAR(16) NOT NULL,
                user2 VARCHAR(16) NOT NULL
                
                )";

if ($conn->query ( $sql ) === TRUE) {
	echo "Table friends created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS friends (
                id INT(11) NOT NULL AUTO_INCREMENT,
                user1 VARCHAR(16) NOT NULL,
                user2 VARCHAR(16) NOT NULL,
                datemade DATETIME NOT NULL,
                accepted ENUM('0','1') NOT NULL DEFAULT '0',
                PRIMARY KEY (id)
                )"; 

if ($conn->query ( $sql ) === TRUE) {
	echo "Table friends created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS status (
                id INT(11) NOT NULL AUTO_INCREMENT,
                osid INT(11) ,
                account_name VARCHAR(16) NOT NULL,
                author VARCHAR(16) NOT NULL,
                type ENUM('a','b','c') NOT NULL,
                data TEXT NOT NULL,
                postdate DATETIME NOT NULL,
                PRIMARY KEY (id)
                )"; 

if ($conn->query ( $sql ) === TRUE) {
	echo "Table status created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS notifications (
                id INT(11) NOT NULL AUTO_INCREMENT,
                username VARCHAR(16) NOT NULL,
                initiator VARCHAR(16) NOT NULL,
                app VARCHAR(255) NOT NULL,
                note VARCHAR(255) NOT NULL,
                did_read ENUM('0','1') NOT NULL DEFAULT '0',
                date_time DATETIME NOT NULL,
                PRIMARY KEY (id)
                )"; 

if ($conn->query ( $sql ) === TRUE) {
	echo "Table notifications created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}


$conn->close ();
?>