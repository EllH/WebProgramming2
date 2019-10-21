<main class="<?=$main ?? 'admin'?>">
<p>Welcome to Claire's Cars, Northampton's specialist in classic and import cars.</p>

    <ul class="articles">

        <?php
        foreach ($articles as $article) {
                echo '<li>';
                echo '<h2>' . $article->name . '</h2>';
                if (file_exists('images/articles/' . $article->id . '.jpg')) {
						echo '<img src="images/articles/' . $article->id . '.jpg" />';
                }
                echo '<div class="details">';
                echo '<p>' . $article->description . '</p>';
                echo '<p> Posted By: ' . $article->getStaff()->name . '</p>';

                echo '</div>';
                echo '</li>';
            }
        ?>
        <ul>