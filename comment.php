<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
/**
 * Created by PhpStorm.
 * User: qwz11
 * Date: 2017-09-21
 * Time: 오전 10:07
 */
session_start();

$comment = $_GET['comment']; // 댓글
$id = $_GET['board_id'];
$user_id = $_SESSION['id'];
$date =  date('Y-m-d H:i:s');

$db_con = mysqli_connect("localhost", "root", "autoset", "sgi_test");
$sql = "insert into comment (CM_user, CM_contents,CM_date, board_id) values ('$user_id', '$comment', '$date', $id)";

mysqli_query($db_con, $sql);

echo "<script>location.replace('http://localhost:8080/page/board.php?board_id=$id')</script>";
?>

