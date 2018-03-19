<?php
if ($_POST) {
    $test = json_decode(file_get_contents('../' . $_POST['testFile']));
    $correct = 0;
    $total = 0;
    foreach ($_POST as $number => $answer) {
        foreach ($test->questions as $question) {
            if ($answer === $question->correct && $number === $question->id) {
                $correct++;
            }
        }
        $total++;
    }
    $wrong = $total - $correct - 2;
    $name = $_POST['myName'];
    $fontSize = 28;
    $correctString = 'Правильных ответов: ' . $correct . ' из ' . ($correct + $wrong);
    $wrongString = 'Неправильных ответов: ' . $wrong . ' из ' . ($correct + $wrong);
}