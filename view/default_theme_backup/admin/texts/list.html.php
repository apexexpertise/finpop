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
$botones = array(
    'edit' => '[Editer]',
    'remove' => '[Supprimer]',
    'up' => '[&uarr;]',
    'down' => '[&darr;]'
);

// ancho de los tds depende del numero de columnas
$cols = count($this['columns']);
$per = 100 / $cols;

?>
<?php if (!empty($this['addbutton'])) : ?>
<a href="<?php echo $this['url'] ?>/add" class="btn btn-default" style="color:white"><?php echo $this['addbutton'] ?></a>
<?php endif; ?>
<!-- Filtro -->
<?php if (!empty($filters)) : ?>
<div class="widget board">
    <form id="filter-form" action="<?php echo $this['url']; ?>" method="get">
    	<div class="form-group col-lg-4">
        <?php foreach ($filters as $id=>$fil) : ?>
        <?php if ($fil['type'] == 'select') : ?>
            <label for="filter-<?php echo $id; ?>"><?php echo $fil['label']; ?></label>
            <select id="filter-<?php echo $id; ?>" name="<?php echo $id; ?>" onchange="document.getElementById('filter-form').submit();" class="form-control">
            <?php foreach ($fil['options'] as $val=>$opt) : ?>
                <option value="<?php echo $val; ?>"<?php if ($fil['value'] == $val) echo ' selected="selected"';?>><?php echo $opt; ?></option>
            <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <?php if ($fil['type'] == 'input') : ?>
            <br />
            <label for="filter-<?php echo $id; ?>"><?php echo $fil['label']; ?></label>
            <input name="<?php echo $id; ?>" value="<?php echo (string) $fil['value']; ?>" class="form-control"/>
            <input type="submit" name="filter" value="Chercher" class="btn btn-primary" style="float:right;">
        <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </form>
</div>
<?php endif; ?>

<!-- lista -->
<div class="widget board">
<?php if ($filters['filtered'] != 'yes') : ?>
    <p>Vous avez besoin de mettre des filtres, trop de dossiers!</p>
<?php elseif (!empty($this['data'])) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th><!-- Editar --></th>
                <th>Texte</th>
                <th>Positon</th>
                <th><!-- Traducir --></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this['data'] as $item) : ?>
            <tr>
                <td><a href="/admin/texts/edit/<?php echo $item->id; ?>">[Editer]</a></td>
                <td><?php echo $item->text; ?></td>
                <td><?php echo $item->group; ?></td>
                <?php if ($translator) : ?>
                <td><a href="/translate/texts/edit/<?php echo $item->id; ?>" >[Traduire]</a></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
   <p class="text-primary">Pas de r&eacute;sultat</p>
    <?php endif; ?>
</div>