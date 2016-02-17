<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solution 2 - Recursive Multiplication</title>
    <style>
        table.result tr td {
            padding: 3px 10px;
        }
    </style>
</head>
<body>
<h1>Solution 2 - Recursive Multiplication</h1>

<form method="post" action="">
    <table>
        <tbody>
        <tr>
            <td>Start Number</td>
            <td>:</td>
            <td><input type="text" name="startNumber"/></td>
        </tr>
        <tr>
            <td>End Number</td>
            <td>:</td>
            <td><input type="text" name="setEndNumber"/></td>
        </tr>
        <tr>
            <td>Step</td>
            <td>:</td>
            <td><input type="text" name="step"/></td>
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
    echo '<div style="margin: 10px; background-color: #ddd;padding: 10px; border: 1px solid red; color: red; font-weight: bold;">'.implode(', ', $modelObject->getError()).'</div>';
}
if ($modelObject->isHasCalculated() === true) {
    $resultTable = $modelObject->getResultTable();
    ?>
    <h2>Result: </h2>
    <table border="1" class="result">
        <thead>
        <tr style="background-color:#ddd">
            <th>Input</th>
            <th>Output</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($resultTable as $input => $output) {
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $input; ?></td>
                <td style="text-align: right;"><?php echo $output; ?></td>
            </tr>
            <?php
        } ?>
        </tbody>
    </table>
    <?php
}
?>
</body>
</html>
