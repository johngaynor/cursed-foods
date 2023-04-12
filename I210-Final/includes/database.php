<?php
// define parameters
$host="localhost";
$login="phpuser";
$password="phpuser";
$database="restaurantdb";

// connect to the mysql sever
$conn=@new mysqli($host,$login,$password,$database);

// handle any errors
if ($conn->connect_errno){
    $errno=$conn->connect_errno;
    $errmsg=$conn->connect_error;
    die("Connection to database failed:($errno)$errmsg.");
}

