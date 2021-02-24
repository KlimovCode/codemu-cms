<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once '../db/connection.php';
$link = mysqli_connect($host, $user, $password, $dbname);
mysqli_query($link, "SET NAMES 'utf8'");

function getPage($info) {
    $title = 'pages admin panel';

    if(isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
        $title = $_POST['title'];
        $url = $_POST['url'];
        $text = $_POST['text'];
    } else {
        $title = '';
        $url = '';
        $text = '';
    }
    $content = '
    <form method="POST">
        <label for="">title<input type="title" value="' . $title . '" name="title"></label> <br><br>
        <label for="">url<input type="text" value="' . $url . '" name="url"></label><br><br>
        <label for="">
            <textarea name="text" id="" cols="30" rows="10">' . $text . '</textarea>
        </label><br><br>
        <button type="submit">Add</button>
    </form>';

    include 'layout.php';
}
function addPage($link) {
    if(isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
        $title = $_POST['title'];
        $url = $_POST['url'];
        $text = $_POST['text'];

        $sql = "SELECT COUNT(*) as count FROM pages WHERE url='$url'";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
        $isPage = mysqli_fetch_assoc($result)['count'];

        if($isPage) {
            return 'Url already uses!';
        } else {
            $sql = "INSERT INTO pages (title, url, text) VALUES ('$title', '$url', '$text')";
            mysqli_query($link, $sql) or die(mysqli_error($link));
            return 'Page added successful!';
        }

    } else {
        return '';
    }
}

$info = addPage($link);
getPage($info);


?>


