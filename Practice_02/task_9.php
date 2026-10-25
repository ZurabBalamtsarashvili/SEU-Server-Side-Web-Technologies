<?php
$base = 'data/task_9';
if (!is_dir('data')) {
    mkdir('data');
}
if (!is_dir($base)) {
    mkdir($base);
}
$message = '';
$files = [];
$folders = [];
$showList = false;
if (isset($_POST['send'])) {
    $folder = trim($_POST['folder']);
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false)) {
        $message = 'სახელი არასწორია.';
    } else {
        $path = $base . '/' . $folder;
        if (!is_dir($path)) {
            mkdir($path);
        }
        if (!is_dir($path)) {
            $message = 'საქაღალდე ვერ შეიქმნა.';
        } elseif (file_exists($path . '/info.txt')) {
            $message = 'info.txt უკვე არსებობს.';
        } elseif (file_put_contents($path . '/info.txt', 'საინფორმაციო ფაილი') !== false) {
            $message = 'საქაღალდე და info.txt შეიქმნა.';
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
                if (is_dir($base . '/' . $folder . '/' . $item)) {
                    $folders[] = $item;
                } else {
                    $files[] = $item;
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
    <title>დავალება 9 - info.txt ფაილი</title>
</head>
<body>
<h2>დავალება 9 - info.txt ფაილი</h2>
<form method="post">
    საქაღალდის სახელი: <input type="text" name="folder" required><br><br>
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
    echo '<h3>ფაილები</h3><ul>';
    for ($i = 0; $i < count($files); $i++) {
        $file = $files[$i];
        echo '<li>' . htmlspecialchars($file) . '</li>';
    }
    echo '</ul><h3>საქაღალდეები</h3><ul>';
    for ($i = 0; $i < count($folders); $i++) {
        $folder = $folders[$i];
        echo '<li>' . htmlspecialchars($folder) . '</li>';
    }
    echo '</ul>';
}
?>
</body>
</html>
