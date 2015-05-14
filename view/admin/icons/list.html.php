<?php
/*
 *  Copyright (C) 2012 Platoniq y FundaciÃ³n Fuentes Abiertas (see README for details)
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
<div class="container">
		<div class="row">
		<div class="col-md-12 column">
 <div class="title-admin">
<p> Types de retour </p>
		<hr/>
		</div>
<div class="widget board">
    <form id="groupfilter-form" action="/admin/icons" method="get">
    <div class="form-group col-lg-4">
        <label for="group-filter"> <?php echo Text::_("Afficher les tarifs de:"); ?></label>
        <select id="group-filter" name="group" onchange="document.getElementById('groupfilter-form').submit();" class="form-control">
            <option value=""><?php echo Text::_("Tout"); ?></option>
        <?php foreach ($this['groups'] as $groupId=>$groupName) : ?>
            <option value="<?php echo $groupId; ?>"<?php if ($filters['group'] == $groupId) echo ' selected="selected"';?>><?php echo $groupName; ?></option>
        <?php endforeach; ?>
        </select>
        </div>
    </form>
</div>

<div class="widget board">
    <?php if (!empty($this['icons'])) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th><!-- Editar --></th>
                <th> <?php echo Text::_("Nom"); ?></th> <!-- name -->
                <th>Tooltip</th> <!-- descripcion -->
                <th><?php echo Text::_("regroupement"); ?></th> <!-- group -->
                <th><!-- Traducir--></th>
<!--                        <th> Remove </th>  -->
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['icons'] as $icon) : ?>
            <tr>
                <td><a href="/admin/icons/edit/<?php echo $icon->id; ?>"><?php echo Text::_("[Editer]"); ?></a></td>
                <td><?php echo $icon->name; ?></td>
                <td><?php echo $icon->description; ?></td>
                <td><?php echo !empty($icon->group) ? $this['groups'][$icon->group] : Text::_('les deux'); ?></td>
                <?php if ($translator) : ?>
                <td><a href="/translate/icon/edit/<?php echo $icon->id; ?>" ><?php echo Text::_("[Traduire]"); ?></a></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p><?php echo Text::_("Aucun résultat"); ?></p>
    <?php endif; ?>
</div>
</div>
</div>
</div>