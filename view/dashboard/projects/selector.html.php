<?php
/*
 * Copyright (C) 2012 Platoniq y FundaciÃ³n Fuentes Abiertas (see README for details)
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
?>
<div id="project-selector">
    <?php if (!empty($this['projects'])) : ?>
        <form id="selector-form" name="selector_form"
		class="form-horizontal"
		action="<?php echo '/dashboard/'.$this['section'].'/'.$this['option'].'/select'; ?>"
		method="post">
		<div class="form-group">
			 <div class="col-xs-2">
				<label for="selector">Projet :</label>
			</div>
			 <div class="col-xs-5">
				<select id="selector" name="project" class="form-control"
					onchange="document.getElementById('selector-form').submit();">
        <?php foreach ($this['projects'] as $project) : ?>
            <option value="<?php echo $project->id; ?>"
						<?php if ($project->id == $_SESSION['project']->id) echo ' selected="selected"'; ?>><?php echo $project->name; ?></option>
        <?php endforeach; ?>
        </select>
			</div>
		</div>
	</form>
    <?php else : ?>
    <p>
		Vous n'avez pas de projet, vous pouvez créer un  <a
			href="/project/create">ici</a>
	</p>
    <?php endif; ?>
</div>
