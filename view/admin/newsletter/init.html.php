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

$mailing = $this['mailing'];

$link = SITE_URL.'/mail/'.base64_encode(md5(uniqid()).'¬any¬'.$mailing->mail).'/?email=any';

// mostrar enlace de si no ves y boton para activar
?>
<div class="widget">
    <p><?php echo utf8_encode("La newsletter est pr�t pour l'exp�dition avec ") ?><a href="<?php echo $link; ?>" target="_blank">ce contenu</a> aux <?php echo $mailing->receivers ?> destinataires.</p>
    <p><?php echo utf8_encode("Si tout est bien appuyez sur le bouton pour activer les exp�ditions automatique Vid�o. ") ?><br /> <a href="/admin/newsletter/activate/<?php echo $mailing->id; ?>" class="button" onclick="return confirm(<?php echo utf8_encode("Va commencer � envoyer automatiquement !") ?>)">ACTIVER!</a></p>

    <h3>Liste de destinataires</h3>
    <table>
        <tr>
            <th>Email</th>
            <th>Alias</th>
            <th>Utilisateurs</th>
        </tr>
        <?php foreach ($this['receivers'] as $user) : ?>
        <tr>
            <?php echo "<td>$user->email</td><td>$user->name</td><td>$user->user</td>" ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>