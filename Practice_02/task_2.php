<?php
$base = 'data/task_2';
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
        $message = 'საქაღალდე შეიქმნა.';
    } else {
        $message = 'საქაღალდე ვერ შეიქმნა.';
    }
}
if (isset($_GET['folder'])) {
    $folder = trim($_GET['folder']);
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false)) {
        $message = 'საქაღალდის სახელი არასწორია.';
    } elseif (is_dir($base . '/' . $folder)) {
        $message = 'ეს საქაღალდე არსებობს.';
    } else {
        $message = 'ეს საქაღალდე არ არსებობს.';
    }
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>დავალება 2 - შექმნა და არსებობის შემოწმება</title>
</head>
<body>
<h2>დავალება 2 - შექმნა და არსებობის შემოწმება</h2>
<form method="post">
    ახალი საქაღალდე: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="შექმნა">
</form>
<h3>შემოწმება GET მეთოდით</h3>
<form method="get">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="შემოწმება">
</form>

<?php
if ($message != '') {
    echo '<p>' . htmlspecialchars($message) . '</p>';
}
?>
</body>
</html>
