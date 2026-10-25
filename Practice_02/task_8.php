<?php
$base = 'data/task_8';
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
    $first = trim($_POST['first']);
    $second = trim($_POST['second']);
    if (($first == '' || $first == '.' || $first == '..' || strpos($first, '/') !== false || strpos($first, '\\') !== false) || ($second == '' || $second == '.' || $second == '..' || strpos($second, '/') !== false || strpos($second, '\\') !== false)) {
        $message = 'შეიყვანეთ სწორი სახელები.';
    } else {
        if (!is_dir($base . '/' . $first)) {
            mkdir($base . '/' . $first);
        }
        if (!is_dir($base . '/' . $second)) {
            mkdir($base . '/' . $second);
        }
        if (is_dir($base . '/' . $first) && is_dir($base . '/' . $second)) {
            $message = 'ორივე საქაღალდე არსებობს.';
        } else {
            $message = 'საქაღალდეები ვერ შეიქმნა.';
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
                if (is_dir($base . '/' . $folder . '/' . $item)) {
                    $items[] = 'საქაღალდე: ' . $item;
                } else {
                    $items[] = 'ფაილი: ' . $item;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>დავალება 8 - ორი საქაღალდე</title>
</head>
<body>
<h2>დავალება 8 - ორი საქაღალდე</h2>
<form method="post">
    პირველი საქაღალდე: <input type="text" name="first" required><br><br>
    მეორე საქაღალდე: <input type="text" name="second" required><br><br>
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
