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
	<p style="padding-left:20px;color:#555555;font-family:Myriad Pro Regular;;font-size:29px;">Niveaux de m&eacute;ritocratie </p>
		<hr style="width:2000px;margin-top:25px;"/>
<div class="widget board">
    <?php if (!empty($this['worthcracy'])) : ?>
    <table>
        <thead>
            <tr>
                <th><!-- Editar--></th>
                <th>Niveau</th>
                <th>Montant</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['worthcracy'] as $worth) : ?>
            <tr>
                <td width="5%"><a href="/admin/worth/edit/<?php echo $worth->id; ?>">[Editer]</a></td>
                <td width="15%"><?php echo $worth->name; ?></td>
                <td width="15%"><?php echo $worth->amount; ?> &euro;</td>
                <td></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>IMPOSIBLE!!!Aucun Enregistrement Trouv&eacute;</p>
    <?php endif; ?>
</div>