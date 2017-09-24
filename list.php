<head>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<div class="container">
    <?php

    session_start();

    define("showPage", 5); //내가 보여 줄 페이지 개수

    $option = $_GET['search'];
    $text = $_GET['text'];


    $logout = $_GET['logout'];

    $_SESSION['page'] = 1;
    $_SESSION['page'] = isset($_GET['id']) ? $_GET['id'] : $_SESSION['page'];

    $startContent = ($_SESSION['page'] - 1) * showPage; // 현재 페이지를 기준으로 게시글 보여주기

    $db_con = mysqli_connect('localhost', 'root', 'autoset', "sgi_test"); // DB접속

    if (isset($option)) {
        switch ($option) {
            case 'title':
                $sql = "select * from board where title like '%$text%'";
                break;
            case 'content' :
                $sql = "select * from board where content like '%$text%'";
                break;
            case 'writer' :
                $sql = "select * from board where writer like '%$text%'";
                break;
        }
    } else
        $sql = "select * from board order by date desc";// 날짜를 기준으로 내림차순 정렬

    $result = mysqli_query($db_con, $sql);

    $row = mysqli_num_rows($result); //행수 체크

    if (isset($option)) {
        switch ($option) {
            case 'title':
                $sql2 = "select * from board where title like '%$text%' order by date desc limit $startContent," . showPage;
                break;
            case 'content' :
                $sql2 = "select * from board where content like '%$text%' order by date desc limit $startContent," . showPage;
                break;
            case 'writer' :
                $sql2 = "select * from board where writer like '%$text%' order by date desc limit $startContent," . showPage;
                break;
        }
    } else
        $sql2 = "select * from board order by date desc limit $startContent," . showPage; // 보여 줄 게시글 수 제한

    $result2 = mysqli_query($db_con, $sql2);

    $page = ceil($row / showPage); // 전체 페이지 수 -> 게시글 수에 따른 페이지 계산

    $page2 = $_SESSION['page'];

    if ($_SESSION['page'] + 2 >= $page - 1) {
        $_SESSION['page'] -= 2;
    } else if ($_SESSION['page'] - 2 < 1) {
        $_SESSION['page'] = 1;
    } else if ($_SESSION['page'] <= 3) {
        $_SESSION['page'] = 1;
    }


    if ($logout == 'logout') {

        session_destroy();
        echo "<script>location.href = 'http://localhost:8080/page/list.php';</script>";
    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <script>
            function goLogin() {
                location.href = 'http://localhost:8080/page/login.html';
            }

            function Write() {
                location.href = 'http://localhost:8080/page/write.html';
            }
            function read(arg) {
                location.href = 'http://localhost:8080/page/board.php?board_id=' + arg;
            }
        </script>
        <style>
            a {
                text-decoration: none;
                color: black
            }

            a:hover {
                color: palevioletred
            }

        </style>
        <title>글목록</title>
    </head>
    <body>
    <h2 style="color: salmon"><i>경임쓰 게시글 목록</i></h2>
    <br>
    <div id="pageWrapper">

        <table border="1px" class="table table-striped">
            <tr class="text-center">
                <td>글번호</td>
                <td>제목</td>
                <td>작성자</td>
                <td>날짜</td>
                <td>조회수</td>
            </tr>

            <?php

            while ($value = mysqli_fetch_assoc($result2)) {
                $board_id = $value['board_id'];   // 글번호
                $subject = $value['title']; // 제목
                $reg_date = $value['date']; // 날짜
                $hits = $value['hit'];     // 조회수
                $user_name = $value['writer']; // 작성자

                echo "<tr onclick='read($board_id)'>";
                echo "<td>" . $board_id . "</td>";
                echo "<td>" . $subject . "</td>";
                echo "<td>" . $user_name . "</td>";
                echo "<td>" . $reg_date . "</td>";
                echo "<td>" . $hits . "</td>";
                echo "</tr>";
            }
            ?>
            </div>
            <form action="list.php" method="get">
                <div class="pull-right">
                <select name="search" >
                    <option value="title">제목</option>
                    <option value="content">내용</option>
                    <option value="writer">작성자</option>
                </select>

                <input type="text" name="text">

                <input type="submit" value="검색" class="btn btn-default"></div>
            </form><br><br>
        </table>
        <?php if (isset($_SESSION['user_state'])) {
            echo "<button onclick='Write()' class='btn btn-default pull-right'>글작성</button>";
            echo "<form action='list.php' method='get'>
                <input type='submit' name='logout' value='logout'class='btn btn-default pull-right'></form>";
        } else {
            echo "<button class='btn btn-default pull-right' onclick='goLogin()'>로그인</button>";
        }
        ?>


    </body>
    </html>

    <?php

    $previousPage = $page2 - 1;
    $nextPage = $page2 + 1;

    if ($previousPage == 0) {
        $previousPage = 1;
    } else if ($nextPage > $page) {
        $nextPage = $page;
    }
    echo "<div class='text-center'><ul>";
    echo "<ul class='pagination'><li><a href='list.php?id=$previousPage'>[<]</a></li>";

    for ($i = $_SESSION['page']; $i < $_SESSION['page'] + 5 && $i <= $page; $i++) {

        echo "<li><a href='list.php?id=$i'> $i </a></li>";
    }
    echo "<li><a href='list.php?id=$nextPage'>[>]</a></li></ul>";
    ?>

</div>


