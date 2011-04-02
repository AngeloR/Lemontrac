<div class="wrapper">
    <h2>Create A Bug</h2>
    <p>By filling out the form below you can create a bug and assign it to a project. All the fields presented below
    are considered mandatory and must be completed in order to create the bug. Once created you will be able to all the fields
    of this bug.</p>
    <p>
    <form action="<?php echo url_for('/bug/new');?>" method="post">
        <table class="form">
            <tr>
                <td style="text-align: right;"><label>Title: </label></td>
                <td><input type="text" name="title" id="title" value="<?php echo $_POST['title']; ?>"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label>Severity Level</label></td>
                <td>
                    <select name="severity_level">
                    <?php foreach($priority_map as $i=>$p):  ?>
                    <option value="<?php echo $i;?>"><?php echo $p;?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; "><label>Project: </label></td>
                <td>
                    <select name="project">
                    <?php foreach($projects as $i=>$project):
                        if(!empty($pre_sel) && $pre_sel == $project['project_id']) : ?>
                        <option value="<?php echo $project['project_id']; ?>" selected="selected"><?php echo $project['project_title']; ?></option>
                    <?php else: ?>
                        <option value="<?php echo $project['project_id']; ?>"><?php echo $project['project_title']; ?></option>
                    <?php endif;
                    endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; "><label>Description</label></td>
                <td><textarea name="desc" rows="10" cols="100"><?php echo $_POST['desc']; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <button type="submit" class="button green">Create</button>
                </td>
            </tr>
        </table>
    </form>
    </p>
</div>