<?php
$base = 'data/task_7';
if (!is_dir('data')) {
    mkdir('data');
}
if (!is_dir($base)) {
    mkdir($base);
}
$message = '';
if (isset($_POST['send'])) {
    $folder = trim($_POST['folder']);
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false)) {
        $message = 'სახელი არასწორია.';
    } elseif (is_dir($base . '/' . $folder)) {
        $message = 'საქაღალდე უკვე არსებობს.';
    } elseif (mkdir($base . '/' . $folder)) {
        $message = 'საქაღალდე შეიქმნა.';
    } else {
        $message = 'საქაღალდე ვერ შეიქმნა.';
    }
}
if (isset($_GET['folder'])) {
    $folder = trim($_GET['folder']);
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false) || !is_dir($base . '/' . $folder)) {
        $message = 'საქაღალდე არ არსებობს.';
    } else {
        $count = 0;
        $list = scandir($base . '/' . $folder);
        for ($i = 0; $i < count($list); $i++) {
            $item = $list[$i];
            if ($item != '.' && $item != '..') {
                $count++;
            }
        }
        $message = 'ელემენტების რაოდენობა: ' . $count;
    }
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>დავალება 7 - ელემენტების რაოდენობა</title>
</head>
<body>
<h2>დავალება 7 - ელემენტების რაოდენობა</h2>
<form method="post">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="შექმნა">
</form>
<h3>ელემენტების დათვლა GET მეთოდით</h3>
<form method="get">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="დათვლა">
</form>

<?php
if ($message != '') {
    echo '<p>' . htmlspecialchars($message) . '</p>';
}
?>
</body>
</html>
