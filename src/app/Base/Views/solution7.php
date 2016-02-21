<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solution 7 - Rotating Encryption</title>
</head>
<body>
<h1>Solution 7 - Rotating Encryption</h1>

<form method="post" action="">
    <table>
        <tbody>
        <tr>
            <td>Input String</td>
            <td>:</td>
            <td><input type="text" name="inputString"/></td>
        </tr>
        <tr>
            <td>Left Rotate Amount</td>
            <td>:</td>
            <td><input type="text" name="leftRotate"/></td>
        </tr>
        <tr>
            <td>Right Rotate Amount</td>
            <td>:</td>
            <td><input type="text" name="rightRotate"/></td>
        </tr>
        <tr>
            <td>Encryption Method</td>
            <td>:</td>
            <td>
                <select name="algorithmMethod">
                    <option value="str">Substring</option>
                    <option value="arr">Array</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" value="Process"/>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Back</a>
            </td>
        </tr>
        </tbody>

    </table>
</form>

<?php
if (empty($modelObject->getError()) === false) {
    echo '<div style="margin: 10px; background-color: #ddd;padding: 10px; border: 1px solid red; color: red; font-weight: bold;">' . implode(
            ', ',
            $modelObject->getError()
        ) . '</div>';
}
if ($modelObject->isHasEncrypted() === true) {
    ?>
    <h2>Result: </h2>
    <?php
    echo $modelObject->getCipher();
}
?>
</body>
</html>
