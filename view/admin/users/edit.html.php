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

$data = $this['data'];
$user = $this['user'];

$roles = $user->roles;
array_walk($roles, function (&$role) { $role = $role->name; });
?>

<!-- <span style="font-style:italic;font-weight:bold;">Atención! Le llegará email de verificación al usuario como si se hubiera registrado.</span> -->
<div class="widget">
    <dl>
        <dt>Nom d'utilisateur:</dt>
        <dd><?php echo $user->name ?></dd>
    </dl>
    <dl>
        <dt>Connexion d'acc&eacute;s:</dt>
        <dd><strong><?php echo $user->id ?></strong></dd>
    </dl>
    <dl>
        <dt>Email:</dt>
        <dd><?php echo $user->email ?></dd>
    </dl>
    <dl>
        <dt>Roles actuels :</dt>
        <dd><?php echo implode(', ', $roles); ?></dd>
    </dl>
    <dl>
        <dt>Statut du compte:</dt>
        <dd><strong><?php echo $user->active ? 'Actif' : 'Inactif'; ?></strong></dd>
    </dl>

    <form action="/admin/users/edit/<?php echo $user->id ?>" method="post">
        <p>
            <label for="user-email">Email:</label><span style="font-style:italic;">V&eacute;rifer que le email soit valide avant de valider</span><br />
            <input type="text" id="user-email" name="email" value="<?php echo $data['email'] ?>" style="width:500px" maxlength="255"/>
        </p>
        <p>
            <label for="user-password">Mot de passe:</label><span style="font-style:italic;">Au moins 6 caract&eacute;res</span><br />
            <input type="text" id="user-password" name="password" value="<?php echo $data['password'] ?>" style="width:500px" maxlength="255"/>
        </p>

        <input type="submit" name="edit" value="Actualiser"  onclick="return confirm('Voulez vous modifier les details de compte utilisateur?');"/><br />
        <span style="font-style:italic;font-weight:bold;color:red;">Attention! les donn&eacute;es chang&eacute;e seront autmatiquement chang&eacute; aucune notification mail sera envoy&eacute;es.</span>

    </form>
</div>
