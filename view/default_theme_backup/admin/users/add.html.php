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
?>
<div class="widget">
    <form action="/admin/users/add" method="post">
        <p>
            <label for="user-user">Login:</label><span style="font-style:italic;">Seuls les lettres, chiffres et trait d'union '-'.</span><br />
            <input type="text" id="user-user" name="userid" value="<?php echo $data['user'] ?>" style="width:250px" maxlength="50"/>
        </p>
        <p>
            <label for="user-name">Nom publi&eacute;:</label><br />
            <input type="text" id="user-name" name="name" value=<?php echo $data['name'] ?>"" style="width:500px" maxlength="255"/>
        </p>
        <p>
            <label for="user-email">Email:</label><span style="font-style:italic;">Valide.</span><br />
            <input type="text" id="user-email" name="email" value="<?php echo $data['email'] ?>" style="width:500px" maxlength="255"/>
        </p>
        <p>
            <label for="user-password">Contraseña:</label><span style="font-style:italic;">Au moins 6 caract&eacute;res.</span><br />
            <input type="text" id="user-password" name="password" value="<?php echo $data['password'] ?>" style="width:500px" maxlength="255"/>
        </p>

        <input type="submit" name="add" value="Crear este usuario" /><br />
        <span style="font-style:italic;font-weight:bold;">Attention! Nous envyons un email de validation &aacute; l'utilisateur pout valider son compte !</span>

    </form>
</div>