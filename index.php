<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once 'db/connection.php';
$link = mysqli_connect($host, $user, $password, $dbname);
mysqli_query($link, "SET NAMES 'utf8'");

if(isset($_GET['page'])) {
    $pageId = $_GET['page'];
} else {
    $pageId = 'index';
}

$sql = "SELECT * FROM pages WHERE url='$pageId'";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$page = mysqli_fetch_assoc($result);

if(!$page) {
    $sql = "SELECT * FROM pages WHERE url='404'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $page = mysqli_fetch_assoc($result);
    header("HTTP/1.0 404 Not Found");
}

$title = $page['title'];
$content = $page['text'];


include 'layouts/main.php';

mysqli_close($link);