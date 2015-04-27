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
use Goteo\Library\Text;

?>
<a href="/admin/banners/add" class="button red"><?php echo Text::_("Nouvelle Banni&eacute;re"); ?></a>

<div class="widget board">
    <?php
				
				if (! empty ( $this ['bannered'] )) :
					?>
    <table class="table table-bordered">
		<thead>
			<tr>
				
				<!-- preview -->
				<th><?php echo Text::_("Titre"); ?></th>
				<!-- preview -->
				<th><?php echo Text::_("Etat "); ?></th>
				<!-- status -->
				<th><?php echo Text::_("Ordre "); ?></th>
				<!-- order -->
				<th><?php echo Text::_("Image "); ?></th>
				<!-- order -->


				<th>
					<!-- <?php echo Text::_("Editer"); ?>-->
				</th>
				
				<th>
					<!-- <?php echo Text::_("supprimer"); ?>-->
				</th>
				

			</tr>
		</thead>

		<tbody>
            <?php foreach ($this['bannered'] as $banner) : ?>
            <tr>
			
				<td><?php echo $banner->title; ?></td>
				<td><?php echo $banner->active; ?></td>
				<td><?php echo $banner->order; ?></td>
				<td><?php echo $banner->image; ?></td>


				<td><a href="/admin/banners/edit/<?php echo $banner->id ?>">[<?php echo Text::_("Editer"); ?>]</a></td>
<td><a href="/admin/banners/edit/<?php echo $banner->project; ?>">[<?php echo Text::_("Editer"); ?>]</a></td>
			</tr>
            <?php endforeach; ?>
        </tbody>

	</table>
    <?php else : ?>
    <p>PAS DE R&eacute;SULTAT</p>
    <?php endif; ?>
</div>