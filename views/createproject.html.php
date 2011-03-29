<div class="wrapper">
    <h2>Create A Project</h2>
    <p>From here you can easily create a project so that you can assign bugs to it. All bugs must be
        assigned to a project. During creation you can assign a project a specific color. This automatically
        tags all bugs assigned with this color so that you can easily see what bugs belong to what projects.</p>
    <p>
    <form action="<?php echo url_for('/project');?>" method="post">
        <table class="form">
            <tr>
                <td style="text-align: right;"><label>Title: </label></td>
                <td><input type="text" name="project_title" id="title" value="<?php echo $_POST['project_title']; ?>"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label>Project Color</label></td>
                <td>
                    <input type="text" name="color" id="color" value="<?php echo $_POST['color']; ?>">
                    <div id="color-display-box">&nbsp;</div>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; "><label>Description</label></td>
                <td><textarea name="project_description" rows="10" cols="100"><?php echo $_POST['project_description']; ?></textarea></td>
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