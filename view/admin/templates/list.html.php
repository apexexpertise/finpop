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
<p style="padding-left:20px;color:#555555;font-family:Myriad Pro Regular;;font-size:29px;">Templates </p>
		<hr style="width:2000px;margin-top:25px;"/>
<div class="widget board">
    <form id="filter-form" action="/admin/templates" method="get">
        <table>
            <tr>
                <td>
                    <label for="group-filter">Filtre groupement:</label><br />
                    <select id="group-filter" name="group">
                        <option value="">Tous les groupes</option>
                    <?php foreach ($this['groups'] as $groupId=>$groupName) : ?>
                        <option value="<?php echo $groupId; ?>"<?php if ($filters['group'] == $groupId) echo ' selected="selected"';?>><?php echo $groupName; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <label for="name-filter">Filtrer par nom ou par sujet:</label><br />
                    <input type="text" id ="name-filter" name="name" value ="<?php echo $filters['name']?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="filter" value="Filtrer">
                </td>
            </tr>
        </table>
    </form>
</div>

<div class="widget board">
    <?php if (!empty($this['templates'])) : ?>
    <table>
        <thead>
            <tr>
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
    <p>PAS DE R&eacute;SULTAT</p>
    <?php endif; ?>
</div>