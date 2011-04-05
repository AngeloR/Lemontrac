<?php if(!is_array($bugs) && strpos('Resource id',$bugs) >= 0) : ?>
<div class="wrapper">
    <h2>No Bugs</h2>
    <p>There are currently no bugs present for this project. You can go ahead and create a
        new bug by hitting the "Create A Bug" button.</p>
</div>
<?php else: ?>
<ul id="bug-list">
    <?php foreach($bugs as $index=>$bug): ?>
    <li<?php echo ($index%2 != 0)?' class="zebra"':''; ?>>
        <table>
            <tr>
                <td rowspan="2" class="color-tag" style="background-color: #<?php echo $bug['color']; ?>"></td>
                <td rowspan="2" class="sev-level">
                    <span class="sev-<?php echo $bug['severity_level']; ?>"><?php echo $priority_map[$bug['severity_level']]; ?></span>
                </td>
                <td>
                    <a href="<?php echo url_for('/bug/'.$bug['bug_id']); ?>"><?php echo $bug['title']; ?></a> -
                    <?php echo excerpt($bug['description']); ?>
                </td>
            </tr>
            <tr>
                <td class="extra-options">
                    Created by <a href="<?php echo url_for('/user/'.$bug['user_id']); ?>"><?php echo $bug['username']; ?></a>,
                    last updated <?php echo pretty_date($bug['updated_time']); ?>
                </td>
            </tr>
            <?php if(count($bug['bug_categories']) > 0): ?>
            <tr>
                <td></td>
                <td colspan="2" class="bug-categories">
                    <?php foreach($bug['bug_categories'] as $i=>$category): ?><span><?php echo $category['category_name']; ?></span><?php endforeach; ?>
                </td>
            </tr>
            <?php endif; ?>
        </table>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>