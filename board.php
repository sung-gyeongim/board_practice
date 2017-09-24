<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<div class="container">
<?php
/**
 * Created by PhpStorm.
 * User: qwz11
 * Date: 2017-09-18
 * Time: 오후 8:33
 */
session_start();

$id = $_GET['board_id']; // board_id값 받아오기
$user_id = $_SESSION['id'];

//DB접속
$db_con = mysqli_connect("localhost", "root", "autoset", "sgi_test"); // DB접속

$sql = "select * from board where board_id=$id"; // 해당 행 불러오기

$result = mysqli_query($db_con, $sql); // 질의 수행

$array = mysqli_fetch_assoc($result); // 연관 배열로 만들기

$commentSql = "select * from comment where board_id = $id";
$CM_Result = mysqli_query($db_con, $commentSql);


?>
<h2>board</h2>
<table class="table table-bordered">
    <tr>
        <td>제목 : <?php echo $array['title'] ?></td> <!-- 제목 -->

        <td>날짜 : <?php echo $array['date'] ?></td> <!--날짜-->
        <td>작성자 : <?php echo $array['writer'] ?></td> <!-- 작성자-->

        <td>조회수 : <?php echo $array['hit'] ?></td> <!--조회수-->
    </tr>
    <tr>
        <td colspan="4">내용 : <?php echo $array['content'] ?></td> <!--내용-->
    </tr>
</table>

<input type="button"  value="목록으로" class='btn btn-default pull-left' onclick="location.replace('list.php')"> <!--클릭시 목록페이지로 이동-->

<?php

if (isset($_SESSION['user_state']) && $array['writer'] == $_SESSION['id']) {

    echo "<form action='modify.php' method='get'>
                <input type='submit' value='수정' class='btn btn-default pull-right'> <!--수정 페이지로 이동, board_id값 전달을 위해 form으로 묶음-->
                <input type='hidden' name = 'id' value=$id>
          </form>";

    echo "<form action='remove.php' method='get'>
                <input type='submit' value='삭제' class='btn btn-default pull-right'> <!--삭제 페이지로 이동, board_id값 전달을 위해 form으로 묶음-->
                <input type='hidden' value=$id name='id'>
          </form>";
}

echo "<input type='button' value='댓글보기' id='show'  class='btn btn-default' onclick='show()'><br>";
echo "<div id='comment' style='visibility: hidden'>
<form action='comment.php' method='get'><br><textarea cols='50' rows='3' name='comment'></textarea>
<input type='submit' value='댓글등록' class='btn btn-default'>
<input type='hidden' name='board_id' value='$id'>
</form> ";
//echo $CM_array['CM_contents'];
?>
<?php

while ($CM_array = mysqli_fetch_assoc($CM_Result)) {
    $cm_id = $CM_array['CM_id'];
    echo "<tr style='text-align: center'>";

    echo "<td>";
    echo $CM_array['CM_user'], " ", $CM_array['CM_contents'], " ", $CM_array['CM_date'];


    if ($user_id == $CM_array['CM_user']) {
        echo "<form action='CM_delete.php' method='get' style='display: inline-block'>
    <input type='hidden' name='cm_id' value='$cm_id'>
    <input type='hidden' name='board_id' value='$id'>
    <input type='submit' value='삭제' class='btn btn-default'></form> ";
    }
    echo "</td></tr><br>";
}
?>
<?php
echo "</div>";
?>

<script>
    var a = document.getElementById('show');
    var b = document.getElementById('comment');
    function show() {
        a.value = '댓글접기';
        a.removeAttribute('onclick');
        a.setAttribute('onclick', 'fold()');
        b.style.visibility = 'visible';
    }
    function fold() {
        a.value = "댓글보기";
        a.removeAttribute('onclick');
        a.setAttribute('onclick', 'show()');
        b.style.visibility = 'hidden';
    }
</script>
</div>

