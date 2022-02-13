<?php
include_once('connect.php');

$sql = "CREATE DATABASE IF NOT EXISTS Scheduler;";
$conn->query($sql);

$sql = "USE Scheduler;";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS user(
		id INT(100) NOT NULL AUTO_INCREMENT,
		username VARCHAR(100) NOT NULL,
		email VARCHAR(320) NOT NULL,
		password VARCHAR(128) NOT NULL,
		Department VARCHAR(255) NOT NULL,
		designation VARCHAR(255) NOT NULL,
		HigherE VARCHAR(255) NOT NULL,
		ResearchA VARCHAR(255) NOT NULL,
		contact VARCHAR(255) NOT NULL,
		PRIMARY KEY (id,username)
		)";
$conn->query($sql);
