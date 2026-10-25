<?php
$base = 'data/task_1';
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
        $message = 'საქაღალდის სახელი არასწორია.';
    } elseif (is_dir($base . '/' . $folder)) {
        $message = 'საქაღალდე უკვე არსებობს.';
    } elseif (mkdir($base . '/' . $folder)) {
        $message = 'საქაღალდე წარმატებით შეიქმნა.';
    } else {
        $message = 'საქაღალდე ვერ შეიქმნა.';
    }
}
if (!isset($_GET['show']) || $_GET['show'] != '1') {
    $message = '';
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>დავალება 1 - საქაღალდის შექმნა</title>
</head>
<body>
<h2>დავალება 1 - საქაღალდის შექმნა</h2>
<form method="post" action="?show=1">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="შექმნა">
</form>

<?php
if ($message != '') {
    echo '<p>' . htmlspecialchars($message) . '</p>';
}
?>
</body>
</html>
