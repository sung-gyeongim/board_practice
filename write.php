<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
/**
 * Created by PhpStorm.
 * User: qwz11
 * Date: 2017-09-14
 * Time: 오전 10:53
 */
session_start();
$title = $_POST['title']; // 제목
$content = $_POST['content'];

$content = "<html><pre>" . $content . "</pre></html>"; // 내용

$date = date('Y-m-d H:i:s');

// DB 상수
define("HOST", "localhost");
define("USER", "root");
define("PASS", "autoset");

$user_id = $_SESSION['id'];
$db_con = mysqli_connect(HOST, USER, PASS, "sgi_test"); // DB접속
// 글 내용 값 넣기
$sql = "insert into board (writer, title, content, date) values ('$user_id','$title','$content','$date')";

mysqli_query($db_con, $sql);

echo "<script>location.replace('list.php')</script>";
echo mysqli_error($db_con);
?>