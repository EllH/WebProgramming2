<main class="<?=$main ?? 'admin'?>">
    <?php
    require '../templates/adminSideNav.html.php';
    ?>


    <h2>Edit Staff</h2>

    <form action="changePassword" method="POST">

        <input type="hidden" name="staff[id]" value="<?=$staff->id ?? ''?>" />
        <label>New Password</label>
        <input type="text" name="staff[password]" />

        <input type="submit" name="submit" value="Save Password" />

    </form>