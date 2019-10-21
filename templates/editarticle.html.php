<main class="<?=$main ?? 'admin'?>">
<?php
require '../templates/adminSideNav.html.php';
?>


    <h2>Edit Article</h2>

    <?php
        require '../templates/displayErrors.html.php';
    ?>

    <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="article[id]" value="<?=$article->id ?? ''?>" />

        <input type="hidden" name="article[staff_id]" value="<?=$article->staff_id ?? $_SESSION['staffId']?>" />
        <label>Article Name</label>
        <input type="text" name="article[name]" value="<?=$article->name ?? ''?>" />
        <label>Article Content</label>
        <textarea name="article[description]"><?=$article->description ?? ''?></textarea>

        <?php
        if ($article != false){
            if (file_exists('../images/articles/' . $article->id . '.jpg')) {
                echo '<img src="../images/articles/' . $article->id . '.jpg" />';
            }
        }
        ?>
        <label>Article image</label>

        <input type="file" name="image" />

        <input type="submit" name="submit" value="Save Article" />

    </form>