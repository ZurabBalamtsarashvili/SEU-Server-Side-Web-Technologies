<?php
$base = 'data/task_5';
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
    $main = trim($_POST['main']);
    $sub = trim($_POST['sub']);
    if (($main == '' || $main == '.' || $main == '..' || strpos($main, '/') !== false || strpos($main, '\\') !== false) || ($sub == '' || $sub == '.' || $sub == '..' || strpos($sub, '/') !== false || strpos($sub, '\\') !== false)) {
        $message = 'შეიყვანეთ სწორი სახელები.';
    } else {
        $mainPath = $base . '/' . $main;
        if (!is_dir($mainPath)) {
            mkdir($mainPath);
        }
        if (is_dir($mainPath) && !is_dir($mainPath . '/' . $sub)) {
            mkdir($mainPath . '/' . $sub);
        }
        if (is_dir($mainPath . '/' . $sub)) {
            $message = 'საქაღალდეები შექმნილია.';
        } else {
            $message = 'შექმნა ვერ მოხერხდა.';
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
    <title>დავალება 5 - მთავარი და ქვესაქაღალდე</title>
</head>
<body>
<h2>დავალება 5 - მთავარი და ქვესაქაღალდე</h2>
<form method="post">
    მთავარი საქაღალდე: <input type="text" name="main" required><br><br>
    ქვესაქაღალდე: <input type="text" name="sub" required><br><br>
    <input type="submit" name="send" value="შექმნა">
</form>
<h3>შიგთავსის ნახვა GET მეთოდით</h3>
<form method="get">
    მთავარი საქაღალდე: <input type="text" name="folder" required><br><br>
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
