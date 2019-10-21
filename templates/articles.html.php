<main class="<?=$main ?? 'admin'?>">
    <?php
    require '../templates/adminSideNav.html.php';
    ?>

    <section class="right">
        <h2>Articles</h2>

        <a class="new" href="editarticle">Add new Article</a>

<?php
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th style="width: 5%">Name</th>';
echo '<th style="width: 5%">Staff who created</th>';
echo '<th style="width: 5%">Content: </th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '</tr>';

foreach ($articles as $article) {
        echo '<tr>';
        echo '<td>' . $article->id . '</td>';
        echo '<td>' . $article->name . '</td>';
        echo '<td>' . $article->getStaff()->name . '</td>';
        echo '<td>' . $article->description . '</td>';
        echo '<td><a style="float: right" href="editarticle?id=' . $article->id . '">Edit</a></td>';
        echo '<td><form method="post" action="deletearticle">
				<input type="hidden" name="id" value="' . $article->id . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
        echo '</tr>';
}

echo '</thead>';
echo '</table>';