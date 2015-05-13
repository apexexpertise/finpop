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
    <div class="form-group col-lg-5">
      
            <label for="user-user">Login: (<span style="font-style:italic;">Seuls les lettres, chiffres et trait d'union '-'.</span> ) </label>
            <input type="text" id="user-user" name="userid" value="<?php echo $data['user'] ?>"  maxlength=50 class="form-control" />
       
            <label for="user-name">Nom publi&eacute;:</label><br />
            <input type="text" id="user-name" name="name" value="<?php echo $data['name'] ?>" maxlength="255" class="form-control"/>
      
            <label for="user-email">Email:<span style="font-style:italic;">Valide.</span> </label><br />
            <input type="text" id="user-email" name="email" value="<?php echo $data['email'] ?>" maxlength=255 class="form-control"/>
       
            <label for="user-password">Mot de passe :<span style="font-style:italic;">Au moins 6 caract&eacute;res.</span></label><br />
            <input type="text" id="user-password" name="password" value="<?php echo $data['password'] ?>" class="form-control" maxlength="255"/>
       
        <input type="submit" name="add" value="Ajouter l'utilisateur" class="btn btn-primary" style="margin-top:10px;float:right" />
        <br clear="both"/>
        <span style="font-style:italic;font-weight:bold;">Attention! Nous envoyons un email de validation &aacute; l'utilisateur pour valider son compte !</span>
 
</div>
   </form>
   
</div>