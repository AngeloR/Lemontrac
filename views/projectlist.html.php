<ul id="project-list">
    <?php foreach($projects  as $index=>$project): ?>
    <li<?php echo ($index%2 != 0)?' class="zebra"':''; ?>>
        <table width="100%">
            <tr>
                <td rowspan="2" class="color-tag" style="background-color: #<?php echo $project['color']; ?>">&nbsp;</td>
                <td>
                    <a href="<?php echo url_for('/'.$project['project_id']); ?>"><?php echo $project['project_title']; ?></a> -
                    <?php echo excerpt($project['project_desc']); ?>
                </td>
            </tr>
            <tr>
                <td class="extra-options">
                    <?php echo $project['bugs_assigned'].' bug'; echo ($project['bugs_assigned'] != 1)?'s':'';?> assigned.
                    <a href="<?php echo url_for('/project/'.$project['project_id']);?>">Details</a>
                </td>
            </tr>
        </table>
    </li>
    <?php endforeach; ?>
</ul>