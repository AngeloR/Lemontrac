<?php include('lib/markdown/markdown.php'); ?>
<div class="wrapper">

    <div id="details">
        <h3>Current Avatar</h3>
        <form action="<?php echo url_for('/user/settings'); ?>" method="post" enctype="multipart/form-data">
        <p>
            <img src="<?php echo url_for('/user/avatar/'.$user['email'].'/80'); ?>" width="80"><br>
            <input type="file" name="avatar" size="20" style="border: 0px; padding-left: 0px;">
        </p>
        <p>
            <button type="submit" class="button blue">Update Avatar</button>
        </p>
        </form>
    </div>

    <h2>Edit Profile</h2>

    <form action="<?php echo url_for('/user/settings'); ?>" method="post">
        <table class="form">
            <tr>
                <td style="text-align: right; "><label>Email: </label></td>
                <td><input type="text" name="email" value="<?php echo $user['email']; ?>"></td>
            </tr>
            <tr>
                <td style="text-align: right; "><label>Password: </label></td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td style="text-align: right; "><label>Confirm Password: </label></td>
                <td><input type="password" name="confirm_password"></td>
            </tr>
            <tr>
                <td style="text-align: right; " colspan="2">
                    <button type="submit" class="button green">Save</button>
                </td>
            </tr>
        </table>
        <p></p>
    </form>

    <div class="clear"></div>
</div>
