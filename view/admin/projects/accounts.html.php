<?php
/*
 *  Copyright (C) 2012 Platoniq y FundaciÃ³n Fuentes Abiertas (see README for details)
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
    Goteo\Model,
    Goteo\Core\Redirection,
    Goteo\Library\Message;

$project = $this['project'];

if (!$project instanceof Model\Project) {
    Message::Error('Instancia de proyecto corrupta');
    throw new Redirection('/admin/projects');
}

$accounts = $this['accounts'];
?>
<div class="widget">
    <p><?php echo utf8_encode("Vous avez besoin d'un projet pour avoir un compte PayPal pour exécuter les charges. Le compte bancaire n'a que les informations dans le même environnement, mais elle ne s'utilise pas dans un processus public de ce système.") ?></p>

    <form method="post" action="/admin/projects" >
        <input type="hidden" name="id" value="<?php echo $project->id ?>" />

    <p>
        <label for="account-bank">Compte bancaire:</label><br />
        <input type="text" id="account-bank" name="bank" value="<?php echo $accounts->bank; ?>" style="width: 475px;"/>
    </p>

    <p>
        <label for="account-bank_owner">Titulaire du compte bancaire:</label><br />
        <input type="text" id="account-bank_owner" name="bank_owner" value="<?php echo $accounts->bank_owner; ?>" style="width: 475px;"/>
    </p>

    <p>
        <label for="account-paypal">Compte PayPal:</label><br />
        <input type="text" id="account-paypal" name="paypal" value="<?php echo $accounts->paypal; ?>" style="width: 475px;"/>
    </p>

    <p>
        <label for="account-paypal_owner">Titulaire du compte PayPal:</label><br />
        <input type="text" id="account-paypal_owner" name="paypal_owner" value="<?php echo $accounts->paypal_owner; ?>" style="width: 475px;"/>
    </p>

    <p>
        <label for="account-allowpp">Permet d'utiliser PayPal: </label>
        <input type="checkbox" id="account-allowpp" name="allowpp" value="1"<?php if ($accounts->allowpp) echo ' checked="checked"'; ?>/>
    </p>

        <input type="submit" name="save-accounts" value="Enregistrer" />
        
    </form>
</div>