<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>ნიშნების უწყისი</title>
</head>
<body>
<h2>ნიშნების უწყისი</h2>

<form method="post">
    სტუდენტის სახელი: <input type="text" name="saxeli" required><br><br>
    სტუდენტის გვარი: <input type="text" name="gvari" required><br><br>
    კურსი: <input type="number" name="kursi" min="1" required><br><br>
    სემესტრი: <input type="number" name="semestri" min="1" required><br><br>
    სასწავლო კურსი: <input type="text" name="sagani" required><br><br>
    მიღებული ქულა: <input type="number" name="qula" min="0" max="100" required><br><br>
    ლექტორის სახელი: <input type="text" name="leqtori_saxeli" required><br><br>
    ლექტორის გვარი: <input type="text" name="leqtori_gvari" required><br><br>
    დეკანის სახელი: <input type="text" name="dekani_saxeli" required><br><br>
    დეკანის გვარი: <input type="text" name="dekani_gvari" required><br><br>
    <input type="submit" name="send" value="შეფასება">
</form>

<?php
if (isset($_POST['send'])) {
    $saxeli = htmlspecialchars($_POST['saxeli']);
    $gvari = htmlspecialchars($_POST['gvari']);
    $kursi = (int) $_POST['kursi'];
    $semestri = (int) $_POST['semestri'];
    $sagani = htmlspecialchars($_POST['sagani']);
    $qula = (int) $_POST['qula'];
    $leqtori_saxeli = htmlspecialchars($_POST['leqtori_saxeli']);
    $leqtori_gvari = htmlspecialchars($_POST['leqtori_gvari']);
    $dekani_saxeli = htmlspecialchars($_POST['dekani_saxeli']);
    $dekani_gvari = htmlspecialchars($_POST['dekani_gvari']);

    if ($qula >= 91) {
        $shefaseba = 'A, ფრიადი';
    } elseif ($qula >= 81) {
        $shefaseba = 'B, ძალიან კარგი';
    } elseif ($qula >= 71) {
        $shefaseba = 'C, კარგი';
    } elseif ($qula >= 61) {
        $shefaseba = 'D, დამაკმაყოფილებელი';
    } elseif ($qula >= 51) {
        $shefaseba = 'E, საკმარისი';
    } elseif ($qula >= 41) {
        $shefaseba = 'FX, ვერ ჩააბარა';
    } else {
        $shefaseba = 'F, ჩაიჭრა';
    }

    echo "<h3>შედეგი</h3>";
    echo "<table border='1' cellpadding='6'>
        <tr><th>სახელი</th><td>$saxeli</td></tr>
        <tr><th>გვარი</th><td>$gvari</td></tr>
        <tr><th>კურსი</th><td>$kursi</td></tr>
        <tr><th>სემესტრი</th><td>$semestri</td></tr>
        <tr><th>სასწავლო კურსი</th><td>$sagani</td></tr>
        <tr><th>ქულა</th><td>$qula</td></tr>
        <tr><th>შეფასება</th><td>$shefaseba</td></tr>
        <tr><th>ლექტორი</th><td>$leqtori_saxeli $leqtori_gvari</td></tr>
        <tr><th>დეკანი</th><td>$dekani_saxeli $dekani_gvari</td></tr>
    </table>";
}
?>
</body>
</html>
