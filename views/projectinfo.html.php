<?php include('lib/markdown/markdown.php'); ?>
<div class="wrapper">

    <div id="details">
        <h3>Details</h3>
        <p><b>Severity Level: </b> <?php echo $priority_map[$bug['severity_level']]; ?><br>
            <b>Created On: </b><?php echo pretty_date($project['created_time']); ?><br>
            <?php echo ($project['last_updated'] == null)?'':'<b>Last Updated: </b>'.pretty_date($project['last_updated']); ?>
        </p>
        <p>
        <?php
        if($project['closed_bugs'] == $project['bugs_assigned']) {
            echo '<a href="'.url_for('/project/edit/'.$project['project_id']).'" class="button blue">Edit</a>&nbsp;&nbsp;&nbsp;';
            echo '<a href="'.url_for('/project/close/'.$project['project_id']).'" class="button blue">Complete Project</a>&nbsp;&nbsp;&nbsp;';
        }
        else {
            echo 'This project still has <a href="'.url_for('/'.$project['project_id']).'">unclosed bugs</a>. You need to close them before you can mark this project as complete.<br><br>';
            echo '<a href="'.url_for('/project/edit/'.$project['project_id']).'" class="button blue">Edit</a>&nbsp;&nbsp;&nbsp;';
        }
        ?>
        </p>
    </div>

    <h2>
        <div id="color-display-box" style="background-color: #<?php echo $project['color']; ?>;">&nbsp;</div>
        <?php echo $project['project_title']; ?>
    </h2>
    <?php echo Markdown($project['project_desc']);?>

    
    <div class="clear"></div>
</div>
