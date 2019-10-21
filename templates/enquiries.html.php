<main class="<?=$main ?? 'admin'?>">
    <?php
    require '../templates/adminSideNav.html.php';
    ?>

    <section class="right">
        <h2>Enquiries</h2>

<?php
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th style="width: 5%">Name</th>';
echo '<th style="width: 5%">Email</th>';
echo '<th style="width: 5%">Telephone Number </th>';
echo '<th style="width: 5%">Content</th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '</tr>';

foreach ($enquiries as $enquiry) {
        if ($enquiry->completed === 'no'){
            echo '<tr>';
            echo '<td>' . $enquiry->id . '</td>';
            echo '<td>' . $enquiry->name . '</td>';
            echo '<td>' . $enquiry->email . '</td>';
            echo '<td>' . $enquiry->telephone_number . '</td>';
            echo '<td>' . $enquiry->content . '</td>';
            echo '<td><form method="post" action="completedenquiry">
                    <input type="hidden" name="enquiry[id]" value="' . $enquiry->id . '" />
                    <input type="hidden" name="enquiry[staff_id]" value="' . $_SESSION['staffId'] . '" />
                    <input type="hidden" name="enquiry[completed]" value="yes" />
                    <input type="submit" name="submit" value="Completed" />
                    </form></td>';
            echo '</tr>';
        }
}

echo '</thead>';
echo '</table>';