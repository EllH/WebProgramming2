<main class="<?=$main ?? 'admin'?>">
<section class="left">
    <ul>
        <?php
        foreach ($manufacturers as $manufacturer)
        echo '<li><a href="cars?id=' . $manufacturer->id . '">' . $manufacturer->name . '</a></li>';
        ?>
    </ul>
</section>

<section class="right">

    <h1><?php echo $pageHeading . " Cars"?></h1>

    <ul class="cars">

<?php
foreach ($cars as $car) {
    if ($car->archived == 'no'){
    echo '<li>';
        $i = 1;
        $directory = '/srv/http/default/public/images/cars/' . $car->id . '/';
        $filecount = 0;
        $files = glob($directory . "*");
        if ($files){
            $filecount = count($files);
        }

    for ($i=1; $i <= $filecount; $i++) {
        if (file_exists('images/cars/' . $car->id . '/' . $i . '.jpg')) {
            echo '<a href="images/cars/' . $car->id . '/' . $i . '.jpg"><img src="images/cars/' . $car->id . '/' . $i . '.jpg" /></a>';
        }
    }
    echo '<div class="details">';
        echo '<h2>' . $car->getManufacturer()->name . ' ' . $car->name . '</h2>';

        if ($car->newprice === null){
            echo '<h3>Price: £' . $car->price . '</h3>';
        } else {
            echo '<h3>Was: £' . $car->price . ' Now: £' . $car->newprice . '</h3>';
        }



        echo '<p>' . $car->description . '</p>';
        echo '<p> Mileage: ' . $car->mileage . '</p>';
        echo '<p> Engine Type: ' . $car->engine_type . '</p>';

        echo '</div>';
    echo '</li>';
}
}
?>
<ul>

</section>