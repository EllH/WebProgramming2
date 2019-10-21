<main class="<?=$main ?? 'admin'?>">
    <?php
    require '../templates/adminSideNav.html.php';
    ?>

    <section class="right">
        <h2>Staff</h2>

        <?php
            require '../templates/displayErrors.html.php';
        ?>



        <a class="new" href="editstaff">Add new Staff</a>

<?php
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th style="width: 5%">Name</th>';
echo '<th style="width: 5%">Usertype</th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '</tr>';

foreach ($staff as $user) {
    if ($user->usertype == 'USER') {
        echo '<tr>';
        echo '<td>' . $user->id . '</td>';
        echo '<td>' . $user->name . '</td>';
        echo '<td>' . $user->usertype . '</td>';
        echo '<td><a style="float: right" href="editstaff?id=' . $user->id . '">Edit</a></td>';
        echo '<td><form method="post" action="deletestaff">
				<input type="hidden" name="id" value="' . $user->id . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
        echo '<td><form method="post" action="changepassword">
				<input type="hidden" name="id" value="' . $user->id . '" />
				<input type="submit" name="submit" value="Change Password" />
				</form></td>';
        echo '</tr>';
    }
}

echo '</thead>';
echo '</table>';