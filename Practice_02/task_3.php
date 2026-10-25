<?php
$base = 'data/task_3';
if (!is_dir('data')) {
    mkdir('data');
}
if (!is_dir($base)) {
    mkdir($base);
}
$message = '';
if (isset($_POST['send'])) {
    $folder = trim($_POST['folder']);
    $action = $_POST['action'];
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false)) {
        $message = 'საქაღალდის სახელი არასწორია.';
    } elseif ($action == 'create') {
        if (is_dir($base . '/' . $folder)) {
            $message = 'საქაღალდე უკვე არსებობს.';
        } elseif (mkdir($base . '/' . $folder)) {
            $message = 'საქაღალდე შეიქმნა.';
        } else {
            $message = 'შექმნა ვერ მოხერხდა.';
        }
    } elseif (!is_dir($base . '/' . $folder)) {
        $message = 'საქაღალდე არ არსებობს.';
    } else {
        $list = scandir($base . '/' . $folder);
        if (count($list) == 2) {
            if (rmdir($base . '/' . $folder)) {
                $message = 'ცარიელი საქაღალდე წაიშალა.';
            } else {
                $message = 'საქაღალდე ვერ წაიშალა.';
            }
        } else {
            $message = 'საქაღალდე ცარიელი არ არის.';
        }
    }
}
if (isset($_GET['folder'])) {
    $folder = trim($_GET['folder']);
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false)) {
        $message = 'საქაღალდის სახელი არასწორია.';
    } elseif (is_dir($base . '/' . $folder)) {
        $message = 'საქაღალდე არსებობს.';
    } else {
        $message = 'საქაღალდე არ არსებობს.';
    }
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>დავალება 3 - ცარიელი საქაღალდის წაშლა</title>
</head>
<body>
<h2>დავალება 3 - ცარიელი საქაღალდის წაშლა</h2>
<h3>სატესტო საქაღალდის შექმნა</h3>
<form method="post">
    <input type="hidden" name="action" value="create">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="შექმნა">
</form>
<h3>ცარიელი საქაღალდის წაშლა</h3>
<form method="post">
    <input type="hidden" name="action" value="delete">
    წასაშლელი საქაღალდე: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="წაშლა">
</form>
<h3>შემოწმება GET მეთოდით</h3>
<form method="get">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="შემოწმება">
</form>

<p>იშლება მხოლოდ ცარიელი საქაღალდე.</p>
<?php
if ($message != '') {
    echo '<p>' . htmlspecialchars($message) . '</p>';
}
?>
</body>
</html>
