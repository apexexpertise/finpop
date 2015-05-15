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

 <div class="title-admin">
<p >Review criteria  </p>
		<hr/>
		</div>
		<div class="widget board">
<a href="/admin/criteria/add" class="btn btn-default" style="color:white"><?php echo Text::_('Ajouter des crit&eacute;res'); ?></a>
</div>
<div class="widget board">
    <form id="sectionfilter-form" action="/admin/criteria" method="get">
    	<div class="form-group col-lg-4">
        <label for="section-filter"><?php echo Text::_('Voir les crit&eacute;res de l\'article:'); ?></label>
        <select id="section-filter" name="section" onchange="document.getElementById('sectionfilter-form').submit();" class="form-control">
        <?php foreach ($this['sections'] as $sectionId=>$sectionName) : ?>
            <option value="<?php echo $sectionId; ?>"<?php if ($filters['section'] == $sectionId) echo ' selected="selected"';?>><?php echo $sectionName; ?></option>
        <?php endforeach; ?>
        </select>
        </div>
    </form>
</div>

<div class="widget board">
    <?php if (!empty($this['criterias'])) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <td><!-- Edit --></td>
                <th><?php echo Text::_('Titre'); ?></th> <!-- title -->
                <th><?php echo Text::_('Position'); ?></th> <!-- order -->
                <td><!-- Move up --></td>
                <td><!-- Move down --></td>
                <th><!-- Traducir--></th>
                <td><!-- Remove --></td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['criterias'] as $criteria) : ?>
            <tr>
                <td><a href="/admin/criteria/edit/<?php echo $criteria->id; ?>">[Editer]</a></td>
                <td><?php echo $criteria->title; ?></td>
                <td><?php echo $criteria->order; ?></td>
                <td><a href="/admin/criteria/up/<?php echo $criteria->id; ?>">[&uarr;]</a></td>
                <td><a href="/admin/criteria/down/<?php echo $criteria->id; ?>">[&darr;]</a></td>
                
                <td><a href="/admin/criteria/remove/<?php echo $criteria->id; ?>" onclick="return confirm('Seguro que deseas eliminar este registro?');">[Supprimer]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p><?php echo Text::_('Aucun r&eacute;sultat trouv&eacute;'); ?></p>
    <?php endif; ?>
</div>
