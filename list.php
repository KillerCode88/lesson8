<?php
session_start();
$id = $_SESSION['id'];
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Список загруженных тестов</title>
    <style>
        .add {
            font-size: 26px;
            padding-left:20px ;
        }
        a {
            color: #151b8b;
            text-decoration: none;
        }

        h1 {
            text-align: center;
        }

        table {
            text-transform: capitalize;
            background: #8fffb2;
            border-collapse: collapse;
            margin: auto;
        }

        td {
            border: 5px dashed #0a6d5e;
            padding: 5px 15px;
        }
    </style>
</head>
<body>
<h1>Список тестов</h1>
<table>
    <?php
    $files = array_diff(scandir('tests/') , Array("." , ".."));
    $counter = 1;
    foreach ($files as $file) {
        if (end(explode('.' , $file)) === 'json') {
            $test = pathinfo($file)['filename'];
            echo '<tr><td>' . $counter . '</td><td><a href="test.php?name=' . $test . '">' . $test . '</a></td>';
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
                echo '<td><a href="delete.php?name=' . $test . '">Удалить тест</a></tr>';
            }
            echo '</tr>';
            $counter++;
        }
    }
    ?>

    <?php
    if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
        echo '<tr><td colspan="3" height="30"><a class="add" href="admin.php">Добавить тест</a></td></tr>';
    }
    ?></table>
</body>
</html>