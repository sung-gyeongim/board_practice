<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
/**
 * Created by PhpStorm.
 * User: qwz11
 * Date: 2017-09-19
 * Time: 오후 7:57
 */
session_start();
$id = $_GET['id']; // board_id값 받아오기

$db_con = mysqli_connect("localhost", "root", "autoset", "sgi_test"); // DB접속
$sql = "delete from board where board_id=$id"; // sql문 -> 테이블의 해당 행 삭제
mysqli_query($db_con, $sql); // 질의 수행

echo "<script>location.replace('list.php')</script>" // 삭제 후 바로 목록페이지로 이동
?>