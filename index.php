<?php
if (isset($_COOKIE['login'])) {
    setcookie('login', '', time()-1);
}
if (isset($_COOKIE['password'])) {
    setcookie('password', '', time()-1);
}
$userList = json_decode(file_get_contents('{login}.json'));
if(isset($_POST['submit'])) {
    session_start();
    if (!file_exists('{login}.json')) {
        echo 'Файл {login} не найден';
        exit;
    }
    $login = $_POST['login'];
    $password = $_POST['password'];
    if($password !== '') {
        foreach ($userList->users as $user) {
            if ($login === $user->login && md5($password) === md5($user->password)) {
                setcookie('login', $user->login, time() + 60 * 60);
                setcookie('password', md5($user->password), time() + 60 * 60);
                $_SESSION['id'] = $user->login;
                header('Location: list.php');
                exit;
            }
        }
        echo 'Имя пользователя и пароль не совпадают. Попробуйте еще раз.';
    } else {
        $_SESSION['id'] = $login;
        header('Location: list.php');
        exit;
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <style>
        body {
            color: #eafdf0;
            background: radial-gradient(circle, #7745c8, #40074A, #1a0723) ;
        }

        h3 {
            margin-top: 15%;
            text-align: center;
        }
        form {
            background: #c2a6dd;
            width: 25%;
            border: 5px solid rgba(117, 34, 184, 0.5);
            box-shadow: 0 0 20px rgba(243, 250, 255, 0.8);
            padding: 20px;
            margin: 50px auto;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            color: #f3faff;
            background:  rgba(148,147,200, 0.5);
            margin: auto;
            width: 40%;
            border: 2px solid rgba(117, 34, 184, 0.7);
        }
    </style>
</head>
<body>
<h3>Авторизуйтесь или войдите как гость, введя только имя:</h3>
<form method="post">
    <label>Ваше имя <input name="login" required></label>
    <label>Пароль <input type="password" name="password"></label>
    <input type="submit" name="submit" value="Войти">
</form>
</body>
</html>