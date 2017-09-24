<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
/**
 * Created by PhpStorm.
 * User: qwz11
 * Date: 2017-09-25
 * Time: 오전 12:33
 */
session_start();

$id = $_GET['cm_id'];
$board_id = $_GET['board_id'];
$db_con = mysqli_connect("localhost", "root", "autoset", "sgi_test"); // DB접속
$sql = "delete from comment where CM_id=$id"; // sql문 -> 테이블의 해당 행 삭제
mysqli_query($db_con, $sql); // 질의 수행
// 삭제 후 바로 목록페이지로 이동
?>

<script>
    location.href = "board.php?board_id=<?php echo $board_id ?>";
</script>
