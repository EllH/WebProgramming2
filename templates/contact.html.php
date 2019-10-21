<main class="<?=$main ?? 'admin'?>">
    <section class="right">
        <h2>Enquiry Form</h2>

        <?php
            require '../templates/displayErrors.html.php';
        ?>


        <form action="" method="POST">
                <input type="hidden" name="enquiry[id]" />
                <label>Name</label>
                <input type="text" name="enquiry[name]" />
                <label>Email</label>
                <input type="text" name="enquiry[email]" />
                <label>Telephone Number</label>
                <input type="text" name="enquiry[telephone_number]" />
                <label>Enquiry</label>
                <input type="text" name="enquiry[content]" />

                <input type="submit" name="submit" value="Send Enquiry" />

            </form>