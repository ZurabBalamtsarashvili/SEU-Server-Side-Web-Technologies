<?php
$base = 'data/task_12';
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
    $file = trim($_POST['file']);
    $action = $_POST['action'];
    if (($main == '' || $main == '.' || $main == '..' || strpos($main, '/') !== false || strpos($main, '\\') !== false) || ($sub == '' || $sub == '.' || $sub == '..' || strpos($sub, '/') !== false || strpos($sub, '\\') !== false) || ($file == '' || $file == '.' || $file == '..' || strpos($file, '/') !== false || strpos($file, '\\') !== false)) {
        $message = 'შეიყვანეთ სწორი სახელები.';
    } else {
        $mainPath = $base . '/' . $main;
        $subPath = $mainPath . '/' . $sub;
        $filePath = $subPath . '/' . $file;
        if ($action == 'create') {
            if (!is_dir($mainPath)) {
                mkdir($mainPath);
            }
            if (is_dir($mainPath) && !is_dir($subPath)) {
                mkdir($subPath);
            }
            if (!is_dir($subPath)) {
                $message = 'საქაღალდეები ვერ შეიქმნა.';
            } elseif (file_exists($filePath)) {
                $message = 'ასეთი ფაილი უკვე არსებობს.';
            } elseif (touch($filePath)) {
                $message = 'სტრუქტურა წარმატებით შეიქმნა.';
            } else {
                $message = 'ფაილი ვერ შეიქმნა.';
            }
        } elseif ($action == 'delete') {
            if (!is_file($filePath)) {
                $message = 'ასეთი ფაილი არ არსებობს.';
            } elseif (unlink($filePath)) {
                if (count(scandir($subPath)) == 2) {
                    rmdir($subPath);
                }
                if (is_dir($mainPath) && count(scandir($mainPath)) == 2) {
                    rmdir($mainPath);
                }
                $message = 'ფაილი წაიშალა.';
            } else {
                $message = 'წაშლა ვერ მოხერხდა.';
            }
        }
    }
}
if (isset($_GET['folder'])) {
    $folder = trim($_GET['folder']);
    if (($folder == '' || $folder == '.' || $folder == '..' || strpos($folder, '/') !== false || strpos($folder, '\\') !== false) || !is_dir($base . '/' . $folder)) {
        $message = 'მთავარი საქაღალდე არ არსებობს.';
    } else {
        $showList = true;
        $path = $base . '/' . $folder;
        $list = scandir($path);
        for ($i = 0; $i < count($list); $i++) {
            $item = $list[$i];
            if ($item != '.' && $item != '..') {
                if (is_dir($path . '/' . $item)) {
                    $items[] = 'საქაღალდე: ' . $item;
                    $insideList = scandir($path . '/' . $item);
                    for ($j = 0; $j < count($insideList); $j++) {
                        $inside = $insideList[$j];
                        if ($inside != '.' && $inside != '..') {
                            $items[] = 'ფაილი: ' . $item . '/' . $inside;
                        }
                    }
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
    <title>დავალება 12 - საქაღალდე, ქვესაქაღალდე და ფაილი</title>
</head>
<body>
<h2>დავალება 12 - საქაღალდე, ქვესაქაღალდე და ფაილი</h2>
<h3>შექმნა POST მეთოდით</h3>
<form method="post">
    <input type="hidden" name="action" value="create">
    მთავარი საქაღალდე: <input type="text" name="main" required><br><br>
    ქვესაქაღალდე: <input type="text" name="sub" required><br><br>
    ფაილის სახელი: <input type="text" name="file" required><br><br>
    <input type="submit" name="send" value="შექმნა">
</form>
<h3>შიგთავსის ნახვა GET მეთოდით</h3>
<form method="get">
    მთავარი საქაღალდე: <input type="text" name="folder" required><br><br>
    <input type="submit" name="send" value="ნახვა">
</form>
<h3>წაშლა POST მეთოდით</h3>
<form method="post">
    <input type="hidden" name="action" value="delete">
    მთავარი საქაღალდე: <input type="text" name="main" required><br><br>
    ქვესაქაღალდე: <input type="text" name="sub" required><br><br>
    ფაილის სახელი: <input type="text" name="file" required><br><br>
    <input type="submit" name="send" value="წაშლა">
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
