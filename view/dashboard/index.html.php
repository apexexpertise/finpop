<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

use Goteo\Library\Text,
    Goteo\Core\View;

$bodyClass = 'dashboard project-edit';

$user = $_SESSION['user'];

$option = $this['option'];
include 'view/prologue.html.php';
include 'view/header.html.php'; ?>
<?php if($user->avatarp->id==1) {

$bc="background:rgb(137, 143, 149);background-size: 100% 100%;"; 
} 


else {
$url=$user->avatarp->getLink(1920, 400, true);
$bc="background:url(".$url.");background-size: 100% 100%;";

}

?>
        <div id="sub-header" style="<?php echo $bc; ?>">
            <div class="dashboard-header">
                <a href="/user/<?php echo $user->id; ?>" target="_blank"><div class="img-profile"><img src="<?php echo $user->avatar->getLink(168, 168, true); ?>" /></div></a>
                <h2><span><?php if (empty($option)) {
                        echo Text::get('dashboard-header-main');
                    } else {
                        echo Text::get('dashboard-header-main') . ' / ' . $this['menu'][$this['section']]['label'] . ' / ' . $this['menu'][$this['section']]['options'][$option];
                    } ?></span></h2>
            </div>
        </div>
<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-9 column <?php echo $this['option'] ?>">
		<?php if ($this['section'] == 'projects') echo new View ('view/dashboard/projects/selector.html.php', $this); ?>
			<?php if ($this['section'] == 'translates') echo new View ('view/dashboard/translates/selector.html.php', $this); ?>

            <?php if (!empty($this['message'])) : ?>
                <div class="widget">
                    <p><?php echo $this['message']; ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($this['errors'])) : ?>
                <div class="widget" style="color:red;">
                    <p><?php echo implode('<br />',$this['errors']); ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($this['success'])) : ?>
                <div class="widget">
                    <p><?php echo implode('<br />',$this['success']); ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($this['section']) && !empty($this['option'])) {
                echo new View ('view/dashboard/'.$this['section'].'/'.$this['option'].'.html.php', $this);
            } ?>
		</div>
		<div class="col-md-3 column">
			<?php  echo new View ('view/dashboard/menu.html.php', $this) ?>
		</div>
	</div>
</div>
<?php
include 'view/footer.html.php';
include 'view/epilogue.html.php';
