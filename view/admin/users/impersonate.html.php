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

$user = $this['user'];

$roles = $user->roles;
array_walk($roles, function (&$role) { $role = $role->name; });
?>
<div class="widget">
    <dl>
        <dt>Nom d'utilisateur</dt>
        <dd><?php echo $user->name ?></dd>
    </dl>
    <dl>
        <dt>Connexion d'acc&eacute;s</dt>
        <dd><strong><?php echo $user->id ?></strong></dd>
    </dl>
    <dl>
        <dt>Email</dt>
        <dd><?php echo $user->email ?></dd>
    </dl>
    <dl>
        <dt>Roles actuels</dt>
        <dd><?php echo implode(', ', $roles); ?></dd>
    </dl>

    <form action="/impersonate" method="post">
        <input type="hidden" name="id" value="<?php echo $user->id ?>" />

        <input type="submit" class="red" name="impersonate" value="Usurper l'identit&eacute; cet utilisateur" onclick="return confirm('Voulez vous continuez?');" /><br />
        <span style="font-style:italic;font-weight:bold;color:red;">Attention!! Avec cette op&eacute;ration vous n'avez pas le droit de vous connectez en tant que superAdmin. Vous aurez les autorisation et les restrictions d&eacute;finit pour cette utilisateur.</span>

    </form>
</div>