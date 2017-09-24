<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
/**
 * Created by PhpStorm.
 * User: sung gyeong im
 * Date: 2017-09-12
 * Time: 오후 3:32
 * Title : login
 */
session_start(); // 세션이 중복되어 실행되는 것을 방지
$User_Id = $_POST['id']; // 입력받은 ID값 가져오기
$User_Pass = $_POST['password']; // 입력받은 PASSWORD 값 가져오기

$connect = mysqli_connect("localhost", "root", "autoset", "sgi_test") or die("연결 실패");
/*echo "DB에 접속<br>";
gettype($connect);

$status = mysqli_select_db($connect, "sgi_test");
if (!$status) {
    echo "데이터베이스 연결 실패<br>";
    $errno = mysqli_errno($connect); // 에러번호
    $errmsg = mysqli_error($connect);
    echo "에러번호 :" . $errno . ":" . $errmsg;
} else {
    echo "DB 접속 성공";
}
*/

$sql = "select * from information where user_id= '$User_Id' and pass = '$User_Pass'";

$result = mysqli_query($connect, $sql);

$_SESSION['user_state'] = true;
$array = mysqli_fetch_array($result);

if ($array) {
    echo "<script>location.href = 'http://localhost:8080/page/list.php';</script>";
    $_SESSION['id'] = $User_Id;
} else
    echo "<script>alert('아이디 또는 비밀번호 오류'); location.href = 'http://localhost:8080/page/login.html';</script>";

mysqli_close($connect);


?>