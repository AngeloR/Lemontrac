<?php include('lib/markdown/markdown.php'); ?>
<div class="wrapper">

    <div id="details">
        <h3>Profile Details</h3>
        <p>
            <b>Member Since: </b><?php echo pretty_date($user_info['created_time']); ?><br>
           
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
        <img src="<?php echo gravatar($user_info['email'],100);?>" align="top"> <?php echo $user_info['username']; ?>

    </h2>
    <?php echo Markdown($user_info['bio']);?>

    <div class="clear"></div>
    <p><h2>Recent Activity</h2></p>
    <ul class="history">
        <?php foreach($log as $i=>$entry): ?>
        <li><?php echo ucfirst($entry['message']); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
