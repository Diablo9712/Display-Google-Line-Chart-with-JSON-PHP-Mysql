<?php
$forexData = json_decode(file_get_contents('http://buzzocean.tk/forex/get.php'));
?>
<h2>gg</h2>

<table>
    <tr>
    <th>Currency</th>
    <th>unit</th>
    <th>Buying Rate</th>
    <th>Selling Rate</th>
    </tr>
    <?php foreach ($forexData as $forex) {
        ?>

        <tr>
            <td><?php echo $forex->name;?></td>
            <td><?php echo $forex->unit;?></td>
            <td><?php echo $forex->buying_rate;?></td>
            <td><?php echo $forex->selling_rate;?></td>
        </tr>
        <?php
    }
?>

</table>