<main class="<?=$main ?? 'admin'?>">

    <?=$error ?? ''?>

    <h2>Log in</h2>
        <form action="" method="post" style="padding: 40px">
            <label>Staff Name: </label>
            <input type="text" name="login[name]" />
            <label>Enter Password: </label>
            <input type="password" name="login[password]" />

            <input type="submit" name="submit" value="Log In" />
        </form>

