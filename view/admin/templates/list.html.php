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
    Goteo\Core\ACL;

$translator = ACL::check('/translate') ? true : false;

$filters = $this['filters'];
?>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
 <div class="title-admin">
<p>Templates </p>
		<hr/>
		</div>
<div class="widget board">
    <form id="filter-form" action="/admin/templates" method="get">
    <div class="form-group col-lg-4">
       
                    <label for="group-filter">Filtre groupement:</label><br />
                    <select id="group-filter" name="group" class="form-control">
                        <option value="">Tous les groupes</option>
                    <?php foreach ($this['groups'] as $groupId=>$groupName) : ?>
                        <option value="<?php echo $groupId; ?>"<?php if ($filters['group'] == $groupId) echo ' selected="selected"';?>><?php echo $groupName; ?></option>
                    <?php endforeach; ?>
                    </select>
               
                    <label for="name-filter">Filtrer par nom ou par sujet:</label><br />
                    <input type="text" id ="name-filter" name="name" value ="<?php echo $filters['name']?>" class="form-control"/>
              <br/>
                    <input type="submit" name="filter" value="Filtrer" class="btn btn-primary" style="float:right">
               
        </div>
    </form>
</div>

<div class="widget board">
    <?php if (!empty($this['templates'])) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th><!-- Editar --></th>
                <th>Mod&eacute;le</th>
                <th>Description</th>
                <th><!-- traducir --></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this['templates'] as $template) : ?>
            <tr>
                <td><a href="/admin/templates/edit/<?php echo $template->id; ?>">[Editer]</a></td>
                <td><?php echo $template->name; ?></td>
                <td><?php echo $template->purpose; ?></td>
                <?php if ($translator) : ?>
                <td><a href="/translate/template/edit/<?php echo $template->id; ?>" >[Traduire]</a></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
 <p class="text-primary">Pas de r&eacute;sultat</p>
    <?php endif; ?>
</div>
</div>
</section>
</div>