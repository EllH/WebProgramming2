<main class="<?=$main ?? 'admin'?>">

    <?php
        require '../templates/adminSideNav.html.php';
    ?>

    <section class="right">

            <h2>Manufacturers</h2>

            <a class="new" href="editmanufacturer">Add new manufacturer</a>

            <?php
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Name</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '</tr>';
            foreach ($categories as $category) {
                echo '<tr>';
                echo '<td>' . $category->name . '</td>';
                echo '<td><a style="float: right" href="editmanufacturer?id=' . $category->id . '">Edit</a></td>';
                echo '<td><form method="post" action="deletemanufacturer">
				<input type="hidden" name="id" value="' . $category->id . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
                echo '</tr>';
            }

            echo '</thead>';
            echo '</table>';
            ?>
    </section>