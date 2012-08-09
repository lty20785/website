<?php

require_once 'database/profile.php';

$username = getUsername($participant);

echo <<<HTML
<li class="gameParticipant">
<a href="profile.php?userid={$participant}">{$username}</a>
HTML;

if ($game_uinter->can_rate($participant)) {
  echo <<<BUTTONS_HTML
  -1
  <input type="radio" name="{$participant}" value="-1" class="unhidden" />
  <input type="radio" name="{$participant}" value="+1" class="unhidden" />
  +1
BUTTONS_HTML;

}

echo "</li>";


?>
