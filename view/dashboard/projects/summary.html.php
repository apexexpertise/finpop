<?php
/*
 * Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 * This file is part of Goteo.
 *
 * Goteo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Goteo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Goteo. If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */
use Goteo\Core\View, Goteo\Library\Text, Goteo\Model\Project;

$project = $this ['project'];

if (! $project instanceof Goteo\Model\Project) {
	return;
}
?>
<div class="widget user-project-title">
	<p>
		<strong><?php echo $project->name ?></strong>
	</p>
</div>

<div class="status user-project-status">
	<div class="dropdown" id="menu-user-project">
		<button class="btn btn-default dropdown-toggle" type="button"
			id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			Actions <span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a role="menuitem" tabindex="-1"
				href="/project/edit/<?php echo $project->id ?>"><?php echo Text::get('regular-edit') ?></a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1"
				href="/project/<?php echo $project->id ?>" target="_blank"><?php echo Text::get('dashboard-menu-projects-preview') ?></a></li>
     <?php if ($project->status == 1) : ?>
    	<li role="presentation"><a role="menuitem" tabindex="-1"
				href="/project/delete/<?php echo $project->id ?>"
				onclick="return confirm('<?php echo Text::get('dashboard-project-delete_alert') ?>')"><?php echo Text::get('regular-delete') ?></a>
    <?php endif ?>
  </ul>
</div>
    <div id="project-status">
					<h3><?php echo Text::get('form-project-status-title'); ?></h3>
        <ul>
            <?php foreach (Project::status() as $i => $s): ?>
            <li></i><?php if ($i == $project->status) echo '<strong>' ?><i
							class="fa fa-chevron-circle-right margin-right"></i><?php echo htmlspecialchars($s) ?><?php if ($i == $project->status) echo '</strong>' ?></li>
            <?php endforeach ?>
        </ul>
    </div>


			
			</div>

<div id="meter-big" class="widget collapsable">

    <?php echo new View('view/project/meter_hor_big.html.php', $this) ?>
    
</div>

