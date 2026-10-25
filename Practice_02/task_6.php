<?php
$base = 'data/task_6';
if (!is_dir('data')) {
    mkdir('data');
}
if (!is_dir($base)) {
    mkdir($base);
}
$message = '';
$items = [];
$showList = false;
if (isset($_POST['send'])) {
    $folder = trim($_POST['folder']);
    $file = trim($_POST['file']);
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false) || ($file == '' || $file == '.' || $file == '..' || strpos($file, '/') !== false || strpos($file, '\\') !== false)) {
        $message = 'საქაღალდის ან ფაილის სახელი არასწორია.';
    } else {
        $path = $base . '/' . $folder;
        if (!is_dir($path)) {
            mkdir($path);
        }
        if (!is_dir($path)) {
            $message = 'საქაღალდე ვერ შეიქმნა.';
        } elseif (file_exists($path . '/' . $file)) {
            $message = 'ფაილი უკვე არსებობს.';
        } elseif (touch($path . '/' . $file)) {
            $message = 'საქაღალდე და ცარიელი ფაილი შეიქმნა.';
        } else {
            $message = 'ფაილი ვერ შეიქმნა.';
        }
    }
}
if (isset($_GET['folder'])) {
    $folder = trim($_GET['folder']);
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false) || !is_dir($base . '/' . $folder)) {
        $message = 'საქაღალდე არ არსებობს.';
    } else {
        $showList = true;
        $list = scandir($base . '/' . $folder);
        for ($i = 0; $i < count($list); $i++) {
            $item = $list[$i];
            if ($item != '.' && $item != '..') {
                $items[] = $item;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>დავალება 6 - საქაღალდე და ცარიელი ფაილი</title>
</head>
<body>
<h2>დავალება 6 - საქაღალდე და ცარიელი ფაილი</h2>
<form method="post">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    ფაილის სახელი: <input type="text" name="file" required><br><br>
    <input type="submit" name="send" value="შექმნა">
</form>
<h3>შიგთავსის ნახვა GET მეთოდით</h3>
<form method="get">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="ნახვა">
</form>

<?php
if ($message != '') {
    echo '<p>' . htmlspecialchars($message) . '</p>';
}
if ($showList) {
    echo '<h3>საქაღალდის შიგთავსი</h3>';
    echo '<ul>';
    for ($i = 0; $i < count($items); $i++) {
        $item = $items[$i];
        echo '<li>' . htmlspecialchars($item) . '</li>';
    }
    echo '</ul>';
}
?>
</body>
</html>
