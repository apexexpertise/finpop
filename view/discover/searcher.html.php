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

use Goteo\Model\Category,
    Goteo\Model\Icon,
    Goteo\Library\Location,
    Goteo\Library\Text;

$categories = Category::getList();  // categorias que se usan en proyectos
$locations = Location::getList();  //localizaciones de royectos
$rewards = Icon::getList(); // iconos que se usan en proyectos

$params = $this['params'];
?>
<div class="widget searcher">
	<form method="post" action="/discover/results">
		<div class="filter">
			<label for="text-query"><?php echo Text::get('discover-searcher-bycontent-header'); ?></label>
			<input type="text" id="text-query" name="query"
				value="<?php echo \htmlspecialchars($params['query']); ?>" /> <br
				clear="all" />
		</div>

		<div class="filter">
			<label for="category"><?php echo Text::get('discover-searcher-bycategory-header'); ?></label>
			<div id="category">
				<input type="checkbox" name="category[]" class="all" value="all"
					<?php if (empty($params['category'])) echo ' checked'; ?>><?php echo Text::get('discover-searcher-bycategory-all'); ?></input><br/>
                <?php foreach ($categories as $id=>$name) : ?>
                    <input type="checkbox" name="category[]"
					value="<?php echo $id; ?>"
					<?php if (in_array("'{$id}'", $params['category'])) echo ' checked'; ?>><?php echo $name; ?></input><br/>
                <?php endforeach; ?> 
                </div>
		</div>

		<div class="filter">

			<label for="location"><?php echo Text::get('discover-searcher-bylocation-header'); ?></label>
			<div id="location">
				<input type="checkbox" name="location[]" class="all" value="all"
					<?php if (empty($params['location'])) echo ' checked'; ?>><?php echo Text::get('discover-searcher-bylocation-all'); ?></input><br/>
                <?php foreach ($locations as $id=>$name) : ?>
                    <input type="checkbox" name="location[]"
					value="<?php echo $id; ?>"
					<?php if (in_array("'{$id}'", $params['location'])) echo ' checked'; ?>><?php echo $name; ?></input><br/>
                <?php endforeach; ?>
                </div>
		</div>

		<div class="filter">

			<label for="reward"><?php echo Text::get('discover-searcher-byreward-header'); ?> </label>
			<div id="reward">
				<input type="checkbox" name="reward[]" class="all" value="all"
					<?php if (empty($params['reward'])) echo ' checked'; ?>><?php echo Text::get('discover-searcher-byreward-all'); ?></input><br/>
                <?php foreach ($rewards as $id=>$reward) : ?>
                    <input type="checkbox" name="reward[]"
					value="<?php echo $id; ?>"
					<?php if (in_array("'{$id}'", $params['reward'])) echo ' checked'; ?>><?php echo $reward->name; ?></input><br/>
                <?php endforeach; ?>
                </div>
		</div>

		<div style="float: left">
			<button type="submit" class="btn btn-primary" name="searcher"><?php echo Text::get('discover-searcher-button'); ?></button>
		</div>

		<br clear="all" />
	</form>
</div>
