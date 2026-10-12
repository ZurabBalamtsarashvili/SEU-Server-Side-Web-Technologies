<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>სახელფასო უწყისი</title>
</head>
<body>
<h2>სახელფასო უწყისი</h2>

<form method="get">
    სახელი: <input type="text" name="saxeli" required><br><br>
    გვარი: <input type="text" name="gvari" required><br><br>
    თანამდებობა: <input type="text" name="tanamdeboba" required><br><br>
    ხელფასი: <input type="number" name="xelfasi" min="0" step="0.01" required><br><br>

    გადასახადის პროცენტი:
    <select name="procenti">
        <option value="5">5%</option>
        <option value="10">10%</option>
        <option value="15">15%</option>
        <option value="20">20%</option>
        <option value="25">25%</option>
    </select><br><br>

    <input type="submit" name="send" value="გამოთვლა">
</form>

<?php
if (isset($_GET['send'])) {
    $saxeli = htmlspecialchars($_GET['saxeli']);
    $gvari = htmlspecialchars($_GET['gvari']);
    $tanamdeboba = htmlspecialchars($_GET['tanamdeboba']);
    $xelfasi = (float) $_GET['xelfasi'];
    $procenti = (float) $_GET['procenti'];

    $gadasaxadi20 = round($xelfasi * 20 / 100, 2);
    $xelze20 = $xelfasi - $gadasaxadi20;

    $gadasaxadi2 = round($xelfasi * $procenti / 100, 2);
    $xelze2 = $xelfasi - $gadasaxadi2;

    echo "<h3>შედეგი</h3>";
    echo "<table border='1' cellpadding='6'>
        <tr><th>სახელი</th><td>$saxeli</td></tr>
        <tr><th>გვარი</th><td>$gvari</td></tr>
        <tr><th>თანამდებობა</th><td>$tanamdeboba</td></tr>
        <tr><th>ხელფასი</th><td>$xelfasi</td></tr>
        <tr><th>გადასახადი 20%</th><td>$gadasaxadi20</td></tr>
        <tr><th>ხელზე ასაღები 20%-ით</th><td>$xelze20</td></tr>
        <tr><th>არჩეული პროცენტი</th><td>$procenti%</td></tr>
        <tr><th>არჩეული გადასახადი</th><td>$gadasaxadi2</td></tr>
        <tr><th>ხელზე ასაღები</th><td>$xelze2</td></tr>
    </table>";
}
?>
</body>
</html>
