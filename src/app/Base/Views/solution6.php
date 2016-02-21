<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solution 6 - Currency Rate Conversion</title>
    <style>
        table.result tr td {
            padding: 3px 10px;
        }
    </style>
</head>
<body>
<h1>Solution 6 - Currency Rate Conversion</h1>

<form method="post" action="">
    <table>
        <tbody>
        <tr>
            <td>Input Command</td>
            <td>:</td>
            <td><textarea name="commands" rows="10" cols="50"></textarea></td>
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
?>
<h2>Result: </h2>
<table border="1" class="result">
    <thead>
    <tr style="background-color:#ddd">
        <th>Command</th>
        <th>Result</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $commandResult = $modelObject->getCommandResult();
    $commandSegments = $modelObject->getCommandSegments();
    foreach ($commandSegments as $sequence) {
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $sequence['command']; ?></td>
            <td style="text-align: right;"><?php echo $commandResult[$sequence['sequence']]; ?></td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>
</body>
</html>
