<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>ტესტი</title>
</head>
<body>
<h2>PHP ტესტი</h2>

<form method="post">
    <p>1. რომელი სიმბოლოთი იწყება PHP ცვლადი?</p>
    <input type="radio" name="q1" value="a" required> #
    <input type="radio" name="q1" value="b"> $
    <input type="radio" name="q1" value="c"> @
    <input type="radio" name="q1" value="d"> &amp;

    <p>2. რომელი მეთოდის მონაცემები ჩანს URL-ში?</p>
    <input type="radio" name="q2" value="a" required> POST
    <input type="radio" name="q2" value="b"> PUT
    <input type="radio" name="q2" value="c"> GET
    <input type="radio" name="q2" value="d"> DELETE

    <p>3. რომელ მასივში ინახება POST ფორმიდან მიღებული მონაცემები?</p>
    <input type="radio" name="q3" value="a" required> $_GET
    <input type="radio" name="q3" value="b"> $_POST
    <input type="radio" name="q3" value="c"> $_COOKIE
    <input type="radio" name="q3" value="d"> $_SESSION

    <p>4. რა გაფართოება აქვს PHP ფაილს?</p>
    <input type="text" name="q4" required>

    <p>5. რომელი PHP ბრძანებით შეიძლება ტექსტის გამოტანა?</p>
    <textarea name="q5" required></textarea><br><br>

    <input type="submit" name="send" value="შემოწმება">
</form>

<?php
if (isset($_POST['send'])) {
    $swori = 0;

    if (isset($_POST['q1']) && $_POST['q1'] == 'b') $swori++;
    if (isset($_POST['q2']) && $_POST['q2'] == 'c') $swori++;
    if (isset($_POST['q3']) && $_POST['q3'] == 'b') $swori++;
    if (strtolower(trim($_POST['q4'])) == 'php' || strtolower(trim($_POST['q4'])) == '.php') $swori++;
    if (strtolower(trim($_POST['q5'])) == 'echo') $swori++;

    echo "<h3>სწორი პასუხების რაოდენობა: $swori/5</h3>";
}
?>
</body>
</html>
