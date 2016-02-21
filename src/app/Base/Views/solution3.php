<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solution 3 - Encoding/Decoding</title>
</head>
<body>
<h1>Solution 3 - Encoding/Decoding</h1>

<form method="post" action="">
    <table>
        <tbody>
        <tr>
            <td>Input String</td>
            <td>:</td>
            <td><input type="text" name="inputString"/></td>
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
if ($modelObject->isAlreadyEncoded() === true) {
    ?>
    <h2>Result: </h2>
    <?php
    echo $modelObject->getEncodeResult();
}
?>
</body>
</html>
