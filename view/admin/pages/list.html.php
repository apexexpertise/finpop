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
?>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
 <div class="title-admin">
<p>Pages </p>
		<hr/>
		</div>
<?php if (!isset($_SESSION['admin_node'])) : ?>
<a href="/admin/pages/add" class="btn btn-default" style="color:white">Nouvelle page</a>
<?php endif; ?>


<div class="widget board">
    <?php if (!empty($this['pages'])) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th><!-- Editar --></th>
                <th>Page</th>
                <th>Description</th>
                <th><!-- Abrir --></th>
                <th><!-- Traducir --></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this['pages'] as $page) : ?>
            <tr>
                <td><a href="/admin/pages/edit/<?php echo $page->id; ?>">[Editer]</a></td>
                <td><p class="text-info"><?php echo $page->name; ?></p></td>
                <td><p class="text-info"><?php echo $page->description; ?></p></td>
                <td><a href="<?php echo $page->url; ?>" target="_blank">[Voir]</a></td>
                <td>
                <?php if ($translator && $node == \GOTEO_NODE) : ?>
                <a href="/translate/pages/edit/<?php echo $page->id; ?>" >[Traduire]</a>
                <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
    <p class="text-primary">PAS DE R�SULTAT</p>
    <?php endif; ?>
</div>

</div>
</section>
</div>