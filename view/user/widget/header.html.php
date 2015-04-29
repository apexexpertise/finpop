<?php

use Goteo\Library\Text;

$user = $this['user'];
?>
<?php if($user->avatarp->id==1) {

$bc="background:rgb(137, 143, 149);background-size: 100% 100%;"; 
} 


else {
$url=$user->avatarp->getLink(1920, 400, true);
$bc="background:url(".$url.");background-size: 100% 100%;";

}

?>
        <div id="sub-header" style="<?php echo $bc; ?>">
	<div class="header-box">
		<a href="/user/<?php echo $user->id; ?>"><div class="img-profile"><img src="<?php echo $user->avatar->getLink(168, 168, true); ?>" /></div></a> 
        <h2><?php echo $user->name; ?></h2>
    </div>
</div>
