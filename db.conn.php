<?php 

# server name
$host = "localhost";
# user name
$username = "root";
# password
$password = "";

# database name
$db_name = "vitagro";

#creating database connection
try {
    $dsn = "mysql:host=$host;dbname=$db_name";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connexion à la base de donnée impossible : ". $e->getMessage();
}