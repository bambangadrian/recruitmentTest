<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solution 1 - Bank Interest</title>
    <style>
        table.result tr td {
            padding: 3px 10px;
        }
    </style>
</head>
<body>
<h1>Solution 1 - Bank Interest</h1>

<form method="post" action="">
    <table>
        <tbody>
        <tr>
            <td>Intial Balance</td>
            <td>:</td>
            <td><input type="text" name="initialBalance"/></td>
        </tr>
        <tr>
            <td>Period Length</td>
            <td>:</td>
            <td><input type="text" name="periodLength"/></td>
        </tr>
        <tr>
            <td>Interest Rate</td>
            <td>:</td>
            <td><input type="text" name="interestRate"/></td>
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
if ($modelObject->isHasCalculated() === true) {
    $balanceSheet = $modelObject->getBalanceSheet();
    ?>
    <h2>Result: </h2>
    <table border="1" class="result">
        <thead>
        <tr style="background-color:#ddd;">
            <th>Year</th>
            <th>Amount</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($balanceSheet as $month => $amount) {
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $month; ?></td>
                <td style="text-align: right;"><?php echo $amount; ?></td>
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
