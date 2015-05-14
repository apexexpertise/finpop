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
    Goteo\Model;

$worth = $this['worth'];

?>
<div class="container">
		<div class="row">
		<div class="col-md-12 column">
<form method="post" action="/admin/worth/edit" >
<div class="form-group col-lg-4">
    <input type="hidden" name="id" value="<?php echo $worth->id; ?>" />

<p>
    <label for="worth-name">Nom de niveau:</label><br />
    <input id="worth-name" name="name" value="<?php echo $worth->name ?>" class="form-control" />
</p>

<p>
    <label for="worth-amount">Montant:</label><br />
    <input id="worth-amount" name="amount" value="<?php echo $worth->amount ?>" class="form-control" />
</p>

    <input type="submit" name="save" value="Enregistrer" class="btn btn-primary" style="float:right"/>
    </div>
</form>
</div>
</div>
</div>