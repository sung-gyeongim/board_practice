<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
session_start();
/**
 * Created by PhpStorm.
 * User: qwz11
 * Date: 2017-09-19
 * Time: 오후 3:42
 */
$changeTitle = $_GET['title']; // 변경된 제목
$changeContent = $_GET['content']; // 변경된 내용
$id = $_GET['board_id']; // board_id

echo $changeContent, $changeTitle, $id;
$db_con = mysqli_connect("localhost", "root", "autoset", "sgi_test"); // DB접속

$sql = "update board set title='$changeTitle', content='$changeContent' where board_id=$id"; // 해당 행 수정

mysqli_query($db_con,$sql); // 질의 수행

echo "<script>location.replace('list.php')</script>"; // 목록페이지 이동
?>
