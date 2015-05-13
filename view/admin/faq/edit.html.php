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

    $('#faq-section').change(function () {
        order = $.ajax({async: false, url: '<?php echo SITE_URL; ?>/ws/get_faq_order/'+$('#faq-section').val()}).responseText;
        $('#faq-order').val(order);
        $('#faq-num').html(order);
    });

});
</script>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
<div class="widget board">
    <form method="post" action="/admin/faq">
		<div class="form-group col-lg-4">
        <input type="hidden" name="action" value="<?php echo $this['action']; ?>" class="form-control"/>
        <input type="hidden" name="id" value="<?php echo $this['faq']->id; ?>" class="form-control"/>

        <p>
        <?php if ($this['action'] == 'add') : ?>
            <label for="faq-section"><?php echo Text::_("Section");?>:</label><br />
            <select id="faq-section" name="section" class="form-control">
                <option value="" disabled><?php echo Text::_("Choisissez la section");?></option>
                <?php foreach ($this['sections'] as $id=>$name) : ?>
                <option value="<?php echo $id; ?>"<?php if ($id == $this['faq']->section) echo ' selected="selected"'; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        <?php else : ?>
            <label for="faq-section"><?php echo Text::_("Section");?>: <?php echo $this['sections'][$this['faq']->section]; ?></label><br />
            <input type="hidden" name="section" value="<?php echo $this['faq']->section; ?>" class="form-control"/>
        <?php endif; ?>
        </p>

        <p>
            <label for="faq-title"><?php echo Text::_("Titre");?>:</label><br />
            <input type="text" name="title" id="faq-title" value="<?php echo $this['faq']->title; ?>" class="form-control" />
        </p>

        <p>
            <label for="faq-description"><?php echo Text::_("Description");?>:</label><br />
            <textarea name="description" id="faq-description" cols="60" rows="10"class="form-control"><?php echo $this['faq']->description; ?></textarea>
        </p>

        <p>
            <label for="faq-order"><?php echo Text::_("position");?>:</label><br />
            <select name="move" class="form-control">
                <option value="same" selected="selected" disabled><?php echo Text::_("Comme ce est");?></option>
                <option value="up"><?php echo Text::_("ant&eacute;rieur &agrave;");?></option>
                <option value="down"><?php echo Text::_("Apr&eacute;s ");?></option>
            </select>&nbsp;
            <input type="text" name="order" id="faq-order" value="<?php echo $this['faq']->order; ?>" size="4" class="form-control"/>
           <p class="text-primary"> &nbsp;de&nbsp;<?php echo $this['faq']->cuantos; ?> </p>
        
		

        <input type="submit" name="save" value="Enregistrer" class="btn btn-primary" style="float:right"/>
        </div>
    </form>
</div>
</div>
</section>
</div>
