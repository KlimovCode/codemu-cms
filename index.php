<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

if(isset($_GET['page'])) {
    $pageId = $_GET['page'];
} else {
    $pageId = 'index';
}

$pagePath = "pages/$pageId.php";

if(file_exists($pagePath)) {
    $content = file_get_contents($pagePath);

    $regTitle = '/\{\{title:(.*?)\}\}/';
    if(preg_match($regTitle, $content, $match)) {
        $title = $match[1];
        $content = trim(preg_replace($regTitle, '', $content));
    } else {
        $title = 'empty title';
    }
} else {
    $content = 'page not found 404';
    $title = 'page not found 404';
    header("HTTP/1.0 404 Not Found");
}

include 'layouts/main.php';
