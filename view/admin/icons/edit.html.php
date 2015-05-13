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
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
<div class="widget board">
    <!-- super form -->
    <form method="post" action="/admin/icons">
<div class="form-group col-lg-4">
        <input type="hidden" name="action" value="<?php echo $this['action']; ?>" />
        <input type="hidden" name="id" value="<?php echo $this['icon']->id; ?>" />
        <input type="hidden" name="order" value="<?php echo $this['icon']->order; ?>" />

        <label for="icon-group"><?php echo Text::_('regroupement:');?></label><br />
        <select id="icon-group" name="group" class="form-control">
            <option value=""><?php echo Text::_("les deux"); ?></option>
            <?php foreach ($this['groups'] as $id=>$name) : ?>
            <option value="<?php echo $id; ?>"<?php if ($id == $this['icon']->group) echo ' selected="selected"'; ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
<br />
        <label for="icon-name"> <?php echo Text::_("nom :"); ?></label><br />
        <input type="text" name="name" id="icon-name" value="<?php echo $this['icon']->name; ?>" class="form-control" />
<br />
        <label for="icon-description"> <?php echo Text::_("Texte info-bulle:"); ?></label><br />
        <textarea name="description" id="icon-description" cols="60" rows="10" class="form-control"><?php echo $this['icon']->description; ?></textarea>

<br/>
        <input type="submit" name="save" value="Enregistrer" class="btn btn-primary" style="float:right"/>
        </div>
    </form>
</div>
</div>
</section>
</div>