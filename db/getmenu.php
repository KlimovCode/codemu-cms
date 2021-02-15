<?php

function createLink($href, $text) {
    if($href == '/?page=index') $href = '/';

    if($_SERVER['REQUEST_URI'] == $href) {
        echo "<li><a href=\"$href\" class=\"active\">$text</a></li>";
    } else {
        echo "<li><a href=\"$href\">$text</a></li>";
    }
}

require_once 'db/connection.php';
$link = mysqli_connect($host, $user, $password, $dbname);
mysqli_query($link, "SET NAMES 'utf8'");

$sql = "SELECT url, title FROM pages";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$urls = mysqli_fetch_all($result);

foreach ($urls as $url) {
    if($url[1] == 404) continue;
    createLink('/?page=' . $url[0], $url[1]);
}


