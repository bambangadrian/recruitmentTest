<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solution 3 - Encoding/Decoding</title>
    <style>
        table th {
            font-weight: bold;
        }
    </style>
</head>
<body>
<h1>Solution 3 - Encoding/Decoding</h1>

<form method="post" action="">
    <table>
        <tbody>
        <tr>
            <td>Start Node</td>
            <td>:</td>
            <td><input type="text" name="startNode"/></td>
        </tr>
        <tr>
            <td>Target Node</td>
            <td>:</td>
            <td><input type="text" name="targetNode"/></td>
        </tr>
        <tr>
            <td>Node Path Length</td>
            <td>:</td>
            <td>
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                            <th>Node <?php echo $i; ?></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $fieldName = 'nodePathLength';
                    for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <tr>
                            <td>
                                Node <?php echo $i; ?>
                            </td>
                            <?php
                            for ($j = 1; $j <= 10; $j++) {
                                ?>
                                <td>
                                    <input type="text" size="5" name="<?php echo $fieldName.'['.$i.']['.$j.']'; ?>"/>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>


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
    echo '<div style="margin: 10px; background-color: #ddd;padding: 10px; border: 1px solid red; color: red; font-weight: bold;">'.implode(', ', $modelObject->getError()).'</div>';
}
if ($modelObject->isHasCalculated() === true) {
    ?>
    <h2>Result: </h2>
    <div>Shortest Path : <?php echo $modelObject->getShortestPathRouteString(); ?></div>
    <div>Minimun Length : <?php echo $modelObject->getDistanceAmount(); ?></div>
    <?php
}
?>
</body>
</html>
