<main class="<?=$main ?? 'admin'?>">
    <?php
    require '../templates/adminSideNav.html.php';
    ?>

    <section class="right">
        <h2>Completed Enquiries</h2>

<?php
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th style="width: 5%">Name</th>';
echo '<th style="width: 5%">Email</th>';
echo '<th style="width: 5%">Telephone Number </th>';
echo '<th style="width: 5%">Content</th>';
echo '<th style="width: 5%">Staff Who Completed</th>';
echo '<th style="width: 5%">&nbsp;</th>';
echo '</tr>';

foreach ($enquiries as $enquiry) {
        if ($enquiry->completed === 'yes'){
            echo '<tr>';
            echo '<td>' . $enquiry->id . '</td>';
            echo '<td>' . $enquiry->name . '</td>';
            echo '<td>' . $enquiry->email . '</td>';
            echo '<td>' . $enquiry->telephone_number . '</td>';
            echo '<td>' . $enquiry->content . '</td>';
            echo '<td>' . $enquiry->getStaff()->name . '</td>';
            echo '<td><form method="post" action="completedenquiries">
                    <input type="hidden" name="enquiry[id]" value="' . $enquiry->id . '" />
                    <input type="hidden" name="enquiry[staff_id]" value="" />
                    <input type="hidden" name="enquiry[completed]" value="no" />
                    <input type="submit" name="submit" value="Restore" />
                    </form></td>';
            echo '</tr>';
        }
}

echo '</thead>';
echo '</table>';