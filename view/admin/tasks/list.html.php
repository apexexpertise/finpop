<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *  This file is part of Goteo.
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

use Goteo\Library\Text;

$filters = $this['filters'];
?>
<a href="/admin/tasks/add" class="button">Nouvelle t&acirc;che</a>

<div class="widget board">
    <form id="filter-form" action="/admin/tasks" method="get">
        <table>
            <tr>
                <td>
                    <label for="status-filter">Afficher par l'&eacute;tat:</label><br />
                    <select id="status-filter" name="done" onchange="document.getElementById('filter-form').submit();">
                        <option value="">Tout Etat</option>
                    <?php foreach ($this['status'] as $statusId=>$statusName) : ?>
                        <option value="<?php echo $statusId; ?>"<?php if ($filters['done'] == $statusId) echo ' selected="selected"';?>><?php echo $statusName; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <label for="user-filter">Jou&eacute; par:</label><br />
                    <select id="user-filter" name="user" onchange="document.getElementById('filter-form').submit();">
                        <option value="">Tout administrateur</option>
                    <?php foreach ($this['admins'] as $adminId=>$adminName) : ?>
                        <option value="<?php echo $adminId; ?>"<?php if ($filters['user'] == $adminId) echo ' selected="selected"';?>><?php echo $adminName; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>

    </form>
</div>

<div class="widget board">
<?php if (!empty($this['tasks'])) : ?>
    <table>
        <thead>
            <tr>
                <th></th> <!-- edit -->
                <th>Noeud</th>
                <th>Devoirs</th>
                <th>Etat</th>
                <th></th> <!-- remove -->
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['tasks'] as $task) : ?>
            <tr>
                <td><a href="/admin/tasks/edit/<?php echo $task->id; ?>" title="Editar">[Editer]</a></td>
                <td><strong><?php echo $this['nodes'][$task->node]; ?></strong></td>
                <td><?php echo substr($task->text, 0, 150); ?></td>
                <td><?php echo (empty($task->done)) ? 'Pendiente' : 'Realizada ('.$task->user->name.')';?></td>
                <td><a href="/admin/tasks/remove/<?php echo $task->id; ?>" title="Eliminar" onclick="return confirm('La t&acirc;che sera &eacute;liminer de mani&egravere irr&eacute;versible ok, ok?')">[Eliminer]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>PAS DE R&eacute;SULTAT</p>
    <?php endif; ?>
</div>