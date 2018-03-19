<?php
session_start();
$id = $_SESSION['id'];
if (!file_exists(__DIR__ . '/tests/' . $_GET["name"] . '.json')) {
    header('HTTP/1.1 404 Not Found');
    exit;
}
$testFile = '/tests/' . $_GET["name"] . '.json';
$test = json_decode(file_get_contents(__DIR__ . $testFile));
if(isset($_COOKIE['authorized'])) {
    $username = $_COOKIE['id'];
    echo $username;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Тест</title>
    <style>
        body {
            background: radial-gradient(circle, #9493c8, #40074A, #1a0723);
        }

        fieldset {
            color: #f3faff;
            background: rgba(148,147,200, 0.5);
            border: 5px dashed rebeccapurple;
            width: 40%;
            margin: 0 auto 20px;
        }

        input[type="radio"] {
            margin-left: 15px;
        }

        input[type="submit"] {
            color: #f3faff;
            background:  rgba(148,147,200, 0.5);
            margin-left: 30%;
            width: 40%;
            border: 5px dashed rebeccapurple;
            font: bold 26px/30px Bitter;
        }
        input[type="submit"]:active {
            color: #acea94;
            background: #7574a8;
            margin-left: 30%;
            width: 40%;
            border: 5px dashed #832b99;
            font: bold 28px/30px Bitter;
        }

        p {
            color: #c2a6dd;
            margin-left: 30%;
            font-size: 26px;
        }
    </style>
</head>
<body>
<form method="post" action="scr/certificate.php">
    <input type="hidden" name="myName" value="<?= $id ?>">
    <input type="hidden" name="testFile" value="<?php echo $testFile; ?>">
    <?php
    if (!empty($_GET["name"])) {
        $test = json_decode(file_get_contents('./tests/' . $_GET["name"] . '.json'));
        foreach ($test->questions as $question) {
            echo '<fieldset>';
            echo '<h3>' . $question->question . '</h3>';
            foreach ($question->choices as $key => $choice) {
                echo '<input  type="radio" value="' . $key . '" name="' . $question->id . '"><label>' . $choice . '</label>';
            }
            echo '</fieldset>';
        }
    }
    ?>
    <input type="submit" value="Принять ответы">
</form>
</body>
</html>
