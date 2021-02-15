<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$pageId = $_GET['page'];
$pagePath = "pages/$pageId.php";

if(file_exists($pagePath)) {
    include $pagePath;
} else {
    echo 'page not found 404';
}

