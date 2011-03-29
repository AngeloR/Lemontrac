<?php include('lib/markdown/markdown.php'); ?>
<div class="wrapper">

    <div id="details">
        <h3>Profile Details</h3>
        <p>
            <b>Member Since: </b><?php echo pretty_date($user['created_time']); ?><br>
            <?php echo ($project['last_updated'] == null)?'':'<b>Last Activity: </b>'.pretty_date($user['updated_time']); ?>
        </p>
        <p>
        <?php
        $current_user = user();
        if($user['user_id'] == $current_user['user_id']) {
            echo '<a href="'.url_for('/user/edit').'" class="button black">Edit Profile</a>&nbsp;&nbsp;&nbsp;';
        }
        ?>
        </p>
    </div>

    <h2>
        <img src="<?php echo gravatar($user['email'],100);?>" align="top"> <?php echo $user['username']; ?>

    </h2>
    <?php echo Markdown($project['project_desc']);?>


    <div class="clear"></div>
</div>
