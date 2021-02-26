<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once '../db/connection.php';
$link = mysqli_connect($host, $user, $password, $dbname);
mysqli_query($link, "SET NAMES 'utf8'");

function showPagesTable($link, $info = '') {
    $sql = "SELECT * FROM pages";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));

    for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

    $content = '<table border="1"><tr><th>title</th><th>url</th><th>edit</th><th>delete</th></tr>';
    foreach($data as $page) {
        if($page['url'] == 404) continue;

        $content .= "<tr>
                    <td>{$page['title']}</td>
                    <td>{$page['url']}</td>
                    <td><a href=\"/admin/edit.php?edit={$page['id']}\">edit</a></td>
                    <td><a href=\"?delete={$page['id']}\">delete</a></td>
                </tr>
                ";
    }
    $content .= '</table>';
    $title = 'pages admin panel';

    include 'partials/layout.php';
}
function deletePage($link) {
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM pages WHERE id=$id";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
        return true;
    } else {
        return false;
    }
    $title = 'pages admin panel';
    include 'partials/layout.php';
}
$isDeleted = deletePage($link);
$info = '';
if($isDeleted) {
    $info = 'delete page success';
}

showPagesTable($link, $info);

mysqli_close($link);