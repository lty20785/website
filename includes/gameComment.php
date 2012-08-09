<?php

require_once 'database/comment.php';

$dt = new DateTime($comment['postTime']);

echo <<<HTML
<li class="gameComment">
<div class="comment">
<div class="commentInfo">
<a href="profile.php?userid={$comment['userId']}">{$comment['username']}</a><br/>
{$dt->format("d/m/Y H:i:s")}
</div>

<div class="commentText">
{$comment['commentText']}
</div>
</div>

</li>
HTML;

?>
