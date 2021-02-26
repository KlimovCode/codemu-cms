<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once '../db/connection.php';
$link = mysqli_connect($host, $user, $password, $dbname);
mysqli_query($link, "SET NAMES 'utf8'");

function getPageData($link, $info) {
    $id = $_GET['edit'];


    $sql = "SELECT * FROM pages WHERE id='$id'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $pageData = mysqli_fetch_assoc($result);

    $title = $pageData['title'];
    $text = $pageData['text'];

    $content = '
    <form method="POST">
        <label for="">title<input type="title" value="' . $title . '" name="title"></label> <br><br>
        <label for="">
            <textarea name="text" id="" cols="30" rows="10">' . $text . '</textarea>
        </label><br><br>
        <button type="submit">save</button>
    </form>';

    include 'partials/layout.php';
}

function editPage($link) {
    if(isset($_POST['title']) and isset($_POST['text'])) {
        $id = $_GET['edit'];
        $title = mysqli_real_escape_string($link, $_POST['title']);
        $text = mysqli_real_escape_string($link, $_POST['text']);

        $sql = "UPDATE pages SET title='$title', text='$text' WHERE id='$id'";
        mysqli_query($link, $sql) or die(mysqli_error($link));
        return 'Page edit successful!';

    } else {
        return 'Page ready for edited';
    }
}

$info = editPage($link);
getPageData($link, $info);


?>


