<?php
	$host = 'localhost';//= 'db.cs.dal.ca'
	$db = 'lzhou';
	$user = 'root';
	$pass = '';//$pass = 'God@2022';//$pass = 'God@2019'; empty pass!
	$charset = 'utf8mb4';
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
//so my html connection doesn't need to connect with this?! Password is diff
	//on java since it is empty here....
$opt = [
   PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
   PDO::ATTR_EMULATE_PREPARES => false



];//so my html connection doesn't need to connect with this?! 

$pdo = new PDO($dsn,$user,$pass,$opt);
// file:///C:/A3Xampp/htdocs/CSCI4140A3HTML.html PATH TO FILE
// again no comments outside of the tags!!!
?>

