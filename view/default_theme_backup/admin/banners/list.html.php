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


use Goteo\Library\Text;

?>
<a href="/admin/banners/add" class="button red"><?php echo Text::_("Nouvelle Banni&eacute;re"); ?></a>

<div class="widget board">
    <?php if (!empty($this['bannered'])) : ?>
    <table>
        <thead>
            <tr>
                <th><?php echo Text::_("Projet"); ?></th> <!-- preview -->
                <th><?php echo Text::_("Etat"); ?></th> <!-- status -->
                <th><?php echo Text::_("Position"); ?></th> <!-- order -->
                <th><!-- <?php echo Text::_("T&eacute;l&eacute;charger"); ?> --></th>
                <th><!-- <?php echo Text::_("Descendre"); ?> --></th>
                <th><!-- <?php echo Text::_("Editer"); ?>--></th>
                <th><!-- <?php echo Text::_("Supprimer"); ?>--></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['bannered'] as $banner) : ?>
            <tr>
                <td><a href="/project/<?php echo $banner->project; ?>" target="_blank" title="Preview"><?php echo $banner->name; ?></a></td>
                <td><?php echo $banner->status; ?></td>
                <td><?php echo $banner->order; ?></td>
                <td><a href="/admin/banners/up/<?php echo $banner->project; ?>">[&uarr;]</a></td>
                <td><a href="/admin/banners/down/<?php echo $banner->project; ?>">[&darr;]</a></td>
                <td><a href="/admin/banners/edit/<?php echo $banner->project; ?>">[<?php echo Text::_("Editer"); ?>]</a></td>
                <td><a href="/admin/banners/remove/<?php echo $banner->project; ?>">[<?php echo Text::_("Supprimer"); ?>]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>PAS DE R&eacute;SULTAT</p>
    <?php endif; ?>
</div>