<?php

if(isset($_GET['name'])) {
    unlink('tests/' . $_GET['name'] . '.json');
}
header('Location: list.php');