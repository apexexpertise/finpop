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
<div class="container">
		<div class="row">
		<div class="col-md-12 column">
<p class="text-info"><strong><?php echo $this['template']->name; ?></strong>: <?php echo $this['template']->purpose; ?></p>

<div class="widget board">
    <form method="post" action="/admin/templates/edit/<?php echo $this['template']->id; ?>">
    <div class="form-group col-lg-4">
        <input type="hidden" name="group" value="<?php echo $this['template']->group; ?>" />
        <p>
            <label for="tpltitle">Titre:</label><br />
            <input id="tpltitle" type="text" name="title" size="120" value="<?php echo $this['template']->title; ?>" class="form-control" />
        </p>

        <p>
            <label for="tpltext">Contenu:</label><br />
            <textarea id="tpltext" name="text" cols="100" rows="20" class="form-control"><?php echo $this['template']->text; ?></textarea>
        </p>

        <input type="submit" name="save" value="Enregistrer" class="btn btn-primary" style="float:right"/>
        </div>
    </form>
</div>
</div>
</div>
</div>