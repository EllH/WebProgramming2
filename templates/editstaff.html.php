<main class="<?=$main ?? 'admin'?>">
    <?php
    require '../templates/adminSideNav.html.php';
    ?>


    <h2>Edit Staff</h2>

    <?php
        require '../templates/displayErrors.html.php';
    ?>

    <form action="" method="POST">

        <input type="hidden" name="staff[id]" value="<?=$staff->id ?? ''?>" />
        <label>Name</label>
        <input type="text" name="staff[name]" value="<?=$staff->name ?? ''?>" />
        <?php if(!isset($_GET['id'])){
            echo '<label>Password</label>';
            echo '<input type="text" name="staff[password]" />';
        }
        ?>

        <label>Usertype</label>

        <select name="staff[usertype]">
            <?php
            var_dump($staff);
            $usertype = array('USER', 'ADMIN');
            foreach ($usertype as $row) {
                if ($staff->usertype == $row) {
                    echo '<option selected="selected" value="' . $row . '">' . $row . '</option>';
                }
                else {
                    echo '<option value="' . $row . '">' . $row . '</option>';
                }

            }

            ?>

        </select>

        <input type="submit" name="submit" value="Save Staff" />

    </form>