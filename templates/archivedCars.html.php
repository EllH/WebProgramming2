<main class="<?=$main ?? 'admin'?>">
    <?php
        require '../templates/adminSideNav.html.php';
    ?>

<section class="right">
    <h2>Archived Cars</h2>
<?php
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>Model</th>';
echo '<th style="width: 10%">Price</th>';
echo '<th style="width: 5%">New Price</th>';
echo '<th style="width: 5%">Mileage</th>';
echo '<th style="width: 5%">Engine Type</th>';
echo '<th style="width: 5%">Staff Who Added:</th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '</tr>';

foreach ($cars as $car) {
    if ($car->archived == 'yes') {
        echo '<tr>';
        echo '<td>' . $car->name . '</td>';
        echo '<td>£' . $car->price . '</td>';
        echo '<td>£' . $car->newprice . '</td>';
        echo '<td>' . $car->mileage . '</td>';
        echo '<td>' . $car->engine_type . '</td>';
        echo '<td>' . $car->getStaff()->name . '</td>';

        echo '<td><a style="float: right" href="editcar?id=' . $car->id . '">Edit</a></td>';
        echo '<td><form method="post" action="deletecar">
				<input type="hidden" name="id" value="' . $car->id . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
        echo '<td><form method="post" action="restorecar">
				<input type="hidden" name="car[id]" value="' . $car->id . '" />
				<input type="hidden" name="car[archived]" value="no" />
				<input type="submit" name="submit" value="Restore Car" />
				</form></td>';
        echo '</tr>';
    }
}

echo '</thead>';
echo '</table>';