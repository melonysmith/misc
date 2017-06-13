<!--
* Created by: Melony Smith
* August 13th, 2016
* Server-Side Languages
* Week 2: Fruits DB App
-->

<?php

// instantiate pdo connection
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost; dbname=SSL; port=8889', $user, $pass);

// get id from $_GET array and store as variable
$fruit_ID = $_GET['id'];

// use pdo to create delete statement with parameters
$stmt = $dbh->prepare("DELETE FROM fruits where fruitid IN (:fruitid)");
// bind parameter to ID variable
$stmt->bindParam(':fruitid', $fruit_ID);
// execute delete statement
$stmt->execute();
// redirect to fruits.php
header('Location: fruitsads.php');
// kill process
die();