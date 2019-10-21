<main class="<?=$main ?? 'admin'?>">
<?php
        require '../templates/adminSideNav.html.php';
    ?>

    <section class="right">
        <h2>Add/Edit Manufacturer</h2>

        <?php
            require '../templates/displayErrors.html.php';
        ?>

        <form action="" method="POST">
            <input type="hidden" name="manufacturer[id]" value="<?=$currentMan->id ?? ''?>" />
            <label>Name</label>
            <input type="text" name="manufacturer[name]" value="<?=$currentMan->name ?? ''?>" />


            <input type="submit" name="submit" value="Save Manufacturer" />

        </form>