<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solution 5 - Sinus Graph Spatial Area Calculation</title>
</head>
<body>
<h1>Solution 5 - Sinus Graph Spatial Area Calculation</h1>

<form method="post" action="">
    <table>
        <tbody>
        <tr>
            <td>Lower Limit</td>
            <td>:</td>
            <td><input type="text" name="lowerLimit" value="<?php echo $modelObject->getLowerLimit(); ?>"/></td>
        </tr>
        <tr>
            <td>Upper Limit</td>
            <td>:</td>
            <td><input type="text" name="upperLimit" value="<?php echo $modelObject->getUpperLimit(); ?>"/></td>
        </tr>
        <tr>
            <td>Iteration</td>
            <td>:</td>
            <td><input type="text" name="iteration" value="<?php echo $modelObject->getIteration(); ?>"/></td>
        </tr>
        <tr>
            <td>Calculation Method</td>
            <td>:</td>
            <td>
                <select name="calculationMethod">
                    <option value="rectangle">Rectangle</option>
                    <option value="parallelogram">Parallelogram</option>
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
if ($modelObject->isHasCalculated() === true) {
    ?>
    <h2>Result: </h2>
    <?php
    echo $modelObject->getAreaWide();
}
?>
</body>
</html>
