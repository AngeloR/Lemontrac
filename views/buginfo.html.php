<?php include('lib/markdown/markdown.php'); ?>
<div class="sev-<?php echo $bug['severity_level']; ?>">&nbsp;</div>
<div class="wrapper">
    <form action="<?php echo url_for('/bug/'.$bug['bug_id']); ?>" method="post">
    <div id="details">
        <h3>Details</h3>
        <p><b>Severity Level: </b> <?php echo $priority_map[$bug['severity_level']]; ?><br>
            <b>Created On: </b><?php echo pretty_date($bug['created_time']); ?><br>
            <b>Last Updated: </b><?php echo pretty_date($bug['updated_time']); ?><br>
            <b>Project: </b><?php echo $bug['project_title']; ?>
        </p>
        <p>
            <img src="<?php echo gravatar($bug['email'],16); ?>" align="top"> <a href="<?php echo url_for('/user/'.$bug['user_id']); ?>"><?php echo $bug['username']; ?></a>
            created this bug.
        </p>
        <p style="float: right; ">
        <?php
        $user = user();
        if($bug['created_by'] == $user['user_id']) {
            echo '<a href="'.url_for('/bug/edit/'.$bug['bug_id']).'" class="button blue">Edit Bug</a>&nbsp;&nbsp;&nbsp;';
            echo '<a href="'.url_for('/bug/fix/'.$bug['bug_id']).'" class="button black">Mark as Fixed</a>';
        }
        ?>
        </p>
    </div>

    <h2>
        <div id="color-display-box" style="background-color: #<?php echo $bug['color']; ?>;">&nbsp;</div>
        <?php echo $bug['title']; ?>
    </h2>
    <?php echo Markdown($bug['description']);?>

    
    <div class="clear"></div>
    <hr class="divider">
    <h2>Add a note</h2>
    <p>You can add more details to the bug, even if you are not the bugs owner by Adding a Note</p>
    <textarea id="notes" name="notes" rows="3" cols="120"></textarea>
    <p style="text-align: right;"><button type="submit" class="button green">Add Note</button></p>
    </form>
    <?php foreach($notes as $id=>$note) :?>
    <div class="note">
        <span class="author">
            <img src="<?php echo gravatar($note['email'],50); ?>" align="top">
            <a href="<?php echo url_for('/user/'.$note['added_by']);?>"><?php echo $note['username'];?></a>
        </span>
        <div class="note-body"><?php echo $note['note']; ?></div>
    </div>
    <?php endforeach; ?>
</div>
