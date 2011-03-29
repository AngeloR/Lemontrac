<div class="wrapper">
    <h2>Edit Project</h2>
    <p>From here you can edit the project details that are visible to users. Updating the color
        for the project will update the project-color for all current bugs as well. All fields are
    mandatory and must be completed in order to save your changes.1</p>
    <form action="<?php echo url_for('/project/'.$project['project_id']);?>" method="post">
        <table class="form">
            <tr>
                <td style="text-align: right;"><label>Title: </label></td>
                <td><input type="text" name="project_title" id="title" value="<?php echo $project['project_title']; ?>"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label>Project Color: </label></td>
                <td>
                    <input type="text" name="color" id="color" value="<?php echo $project['color']; ?>">
                    <div id="color-display-box" style="background-color: #<?php echo $project['color']; ?>">&nbsp;</div>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; "><label>Description</label></td>
                <td><textarea name="project_desc" rows="10" cols="100"><?php echo $project['project_desc']; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <button type="submit" class="button green">Save</button>
                </td>
            </tr>
        </table
    </form>
</div>