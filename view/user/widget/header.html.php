<?php

use Goteo\Library\Text;

$user = $this['user'];
?>
<div id="sub-header" style="background:url(<?php echo $user->avatarp->getLink(1920, 300, true); ?>);background-size: 100% 100%;">
	<div class="header-box">
		<a href="/user/<?php echo $user->id; ?>"><div class="img-profile"><img src="<?php echo $user->avatar->getLink(168, 168, true); ?>" /></div></a> 
        <h2><?php echo $user->name; ?></h2>
    </div>
</div>
