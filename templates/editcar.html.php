<main class="<?=$main ?? 'admin'?>">
<?php
require '../templates/adminSideNav.html.php';
?>

    <section class="right">
    <h2>Edit Car</h2>

        <?php
            require '../templates/displayErrors.html.php';
        ?>

    <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="car[id]" value="<?=$car->id ?? ''?>" />

        <input type="hidden" name="car[staff_id]" value="<?=$car->staff_id ?? $_SESSION['staffId']?>" />
        <label>Name</label>
        <input type="text" name="car[name]" value="<?=$car->name ?? ''?>" />

        <label>Price</label>
        <input type="text" name="car[price]" value="<?=$car->price ?? ''?>" />

        <label>Mileage</label>
        <input type="text" name="car[mileage]" value="<?=$car->price ?? ''?>" />

        <label>Engine Type</label>
        <input type="text" name="car[engine_type]" value="<?=$car->price ?? ''?>" />


        <label>Description</label>
        <textarea name="car[description]"><?=$car->description ?? ''?></textarea>

        <?php
        if (isset($_GET['id'])){
            ?>
            <label>New Price</label>
            <input type="text" name="car[newprice]" value="<?=$car->newprice ?? ''?>" />';
        <?php
        }
        ?>

        <label>Category</label>

        <select name="car[manufacturerId]">
            <?php

            foreach ($manufacturers as $row) {
                if ($car->manufacturerId == $row->id) {
                    echo '<option selected="selected" value="' . $row->id . '">' . $row->name . '</option>';
                }
                else {
                    echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                }

            }

            ?>

        </select>
        <label>Product image</label>

        <input type="file" name="images[]" multiple />


        <input type="submit" name="submit" value="Save Product" />

    </form>

        <ul class="cars">
        <?php
        if ($car != false){

            $i = 1;
            $directory = '/srv/http/default/public/images/cars/' . $car->id . '/';
            $filecount = 0;
            $files = glob($directory . "*");
            if ($files){
                $filecount = count($files);
            }
            for ($i=1; $i <= $filecount; $i++) {
                if (file_exists('/srv/http/default/public/images/cars/' . $car->id . '/' . $i . '.jpg')) {
                    echo '<li><a href="../images/cars/' . $car->id . '/' . $i . '.jpg"><img src="../images/cars/' . $car->id . '/' . $i . '.jpg" /></a></li>';
                }
            }
        }
        ?>
        </ul>
    </section>
