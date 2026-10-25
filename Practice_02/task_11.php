<?php
$base = 'data/task_11';
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
    $count = (int) $_POST['count'];
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false) || $count < 1 || $count > 20) {
        $message = 'შეიყვანეთ სწორი სახელი და რაოდენობა 1-დან 20-მდე.';
    } else {
        $path = $base . '/' . $folder;
        if (!is_dir($path)) {
            mkdir($path);
        }
        if (!is_dir($path)) {
            $message = 'საქაღალდე ვერ შეიქმნა.';
        } else {
            for ($i = 1; $i <= $count; $i++) {
                $file = $path . '/file_' . $i . '.txt';
                if (!file_exists($file)) {
                    touch($file);
                }
            }
            $message = 'ტექსტური ფაილები შეიქმნა.';
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
    <title>დავალება 11 - რამდენიმე ტექსტური ფაილი</title>
</head>
<body>
<h2>დავალება 11 - რამდენიმე ტექსტური ფაილი</h2>
<form method="post">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
    ფაილების რაოდენობა: <input type="number" name="count" min="1" max="20" required><br><br>
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
    echo '<ol>';
    for ($i = 0; $i < count($items); $i++) {
        $item = $items[$i];
        echo '<li>' . htmlspecialchars($item) . '</li>';
    }
    echo '</ol>';
}
?>
</body>
</html>
