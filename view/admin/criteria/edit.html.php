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
<script type="text/javascript">

jQuery(document).ready(function ($) {

    $('#criteria-section').change(function () {
        order = $.ajax({async: false, url: '<?php echo SITE_URL; ?>/ws/get_criteria_order/'+$('#criteria-section').val()}).responseText;
        $('#criteria-order').val(order);
        $('#criteria-num').html(order);
    });

});
</script>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
<div class="widget board">
    <form method="post" action="/admin/criteria">
<div class="form-group col-lg-4">
        <input type="hidden" name="action" value="<?php echo $this['action']; ?>" />
        <input type="hidden" name="id" value="<?php echo $this['criteria']->id; ?>" />

        <p>
        <?php if ($this['action'] == 'add') : ?>
            <label for="criteria-section"><?php echo Text::_('Section:'); ?></label><br />
            <select id="criteria-section" name="section" class="form-control">
                <option value="" disabled><?php echo Text::_('Choisissez la section'); ?></option>
                <?php foreach ($this['sections'] as $id=>$name) : ?>
                <option value="<?php echo $id; ?>"<?php if ($id == $this['criteria']->section) echo ' selected="selected"'; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        <?php else : ?>
            <label for="criteria-section">Section: <?php echo $this['sections'][$this['criteria']->section]; ?></label><br />
            <input type="hidden" name="section" value="<?php echo $this['criteria']->section; ?>" class="form-control"/>
        <?php endif; ?>
        </p>

        <p>
            <label for="criteria-title"><?php echo Text::_('Titre:'); ?></label><br />
            <input type="text" name="title" id="criteria-title" value="<?php echo $this['criteria']->title; ?>" class="form-control"/>
        </p>

        <p>
            <label for="criteria-description"><?php echo Text::_('Description:'); ?></label><br />
            <textarea name="description" id="criteria-description" cols="60" rows="10" class="form-control"><?php echo $this['criteria']->description; ?></textarea>
        </p>

        <p>
            <label for="criteria-order"><?php echo Text::_('Position:'); ?></label><br />
            <select name="move" class="form-control">
                <option value="same" selected="selected" disabled><?php echo Text::_('Comme ce est'); ?></option>
                <option value="up"><?php echo Text::_('ant&eacute;rieur &aacute; '); ?></option>
                <option value="down"><?php echo Text::_('apr&eacute;s '); ?></option>
            </select>&nbsp;
            <input type="text" name="order" id="criteria-order" value="<?php echo $this['criteria']->order; ?>" size="4" class="form-control" />
            &nbsp;de&nbsp;<span id="criteria-num"><?php echo $this['criteria']->cuantos; ?></span>
        </p>


        <input type="submit" name="save" value="Enregistrer" class="btn btn-primary" style="float:right"/>
        </div>
    </form>
</div>
</div>
</section>
</div>