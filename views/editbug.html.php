<div class="wrapper">
    <h2>Edit Bug Details</h2>
    <p>All fields are mandatory and must not be empty in order to save the changes to this bug. Please note that
        the fields also support <a href="http://en.wikipedia.org/wiki/Markdown">Markdown</a></p>
    <form action="<?php echo url_for('/bug/'.$bug['bug_id']);?>" method="post">
        <table class="form">
            <tr>
                <td style="text-align: right;"><label>Title: </label></td>
                <td><input type="text" name="title" id="title" value="<?php echo $bug['title']; ?>"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label>Severity Level</label></td>
                <td>
                    <select name="severity_level">
                    <?php foreach($priority_map as $i=>$p):  ?>
                        <option value="<?php echo $i;?>"
                        <?php if($bug['severity_level'] == $i) : ?>
                            selected="selected"
                        <?php endif; ?>
                        ><?php echo $p;?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; "><label>Description</label></td>
                <td><textarea name="desc" rows="10" cols="100"><?php echo $bug['description']; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <button type="submit" class="button green">Save</button>
                </td>
            </tr>
        </table
    </form>
</div>