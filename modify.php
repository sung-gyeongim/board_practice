<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<div class="container">
    <?php
    /**
     * Created by PhpStorm.
     * User: qwz11
     * Date: 2017-09-18
     * Time: 오후 11:21
     */

    session_start();


    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "autoset");

    $id = $_GET['id'];

    $db_con = mysqli_connect(HOST, USER, PASS, "sgi_test"); // DB접속

    $sql = "select * from board where board_id=$id";

    $result = mysqli_query($db_con, $sql);

    $array = mysqli_fetch_assoc($result);

    $removeTagCon = strip_tags($array['content']); // html 태그 제거
    echo "<h2>글 수정</h2>";
    echo "<form action='changeValue.php' method='get'>";
    echo "<table class='table table-bordered'>";
    echo "<div><br>";
    echo "<tr>
                <th>제목</th>
                <td><input type='text' value='$removeTagCon' name='title' class='form - control'></td>
            </tr>";

    echo "<tr><td colspan='2'><textarea name='content'  cols= '40' class='form-control'>";
    echo $removeTagCon;
    echo "</textarea></td></tr>";


    echo "</table>";
    echo "<input type = 'submit' value='확인' class='btn btn-default pull-right'>";
    echo "<input type='button' value='취소' class='btn btn-default pull-right' onclick='goList()' >";
    echo "<input type='hidden' value = $id name='board_id'>"; // 변경된 값을 질의하기 위해 title, content, board_id 전달
    echo "</form>";
    echo "</div>";

    ?>
</div>
<script>
    function goList() {//목록페이지로 이동
        location.replace('http://localhost:8080/page/list.php');
    }
</script>
