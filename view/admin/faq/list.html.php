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
    Goteo\Core\ACL;

$translator = ACL::check('/translate') ? true : false;
$filters = $this['filters'];
?>
<div class="container">
		<div class="row">
		<div class="col-md-12 column">
 <div class="title-admin">
<p>FAQs  </p>
		<hr/>
		</div>
<a href="/admin/faq/add/?filter=" class="btn btn-default" style="color:white"><?php echo Text::_("Ajouter une question");?></a>

<div class="widget board" style="margin-top:15px;">
    <form id="sectionfilter-form" action="/admin/faq" method="get">
     	<div class="form-group col-lg-4">
        <label for="section-filter"><?php echo Text::_("Afficher les questions:");?></label>
        <select class="form-control"id="section-filter" name="section" onchange="document.getElementById('sectionfilter-form').submit();">
        <?php foreach ($this['sections'] as $sectionId=>$sectionName) : ?>
            <option value="<?php echo $sectionId; ?>"<?php if ($filters['section'] == $sectionId) echo ' selected="selected"';?>><?php echo $sectionName; ?></option>
        <?php endforeach; ?>
        </select>
        </div>
    </form>
</div>

<div class="widget board">
    <?php if (!empty($this['faqs'])) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <td><!-- Edit --></td>
                <th><?php echo Text::_("Titre");?></th> <!-- title -->
                <th><?php echo Text::_("Position");?></th> <!-- order -->
                <td><!-- Move up --></td>
                <td><!-- Move down --></td>
                <td><!-- Traducir--></td>
                <td><!-- Remove --></td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['faqs'] as $faq) : ?>
            <tr>
                <td><a href="/admin/faq/edit/<?php echo $faq->id; ?>">[Editer]</a></td>
                <td><?php echo $faq->title; ?></td>
                <td><?php echo $faq->order; ?></td>
                <td><a href="/admin/faq/up/<?php echo $faq->id; ?>">[&uarr;]</a></td>
                <td><a href="/admin/faq/down/<?php echo $faq->id; ?>">[&darr;]</a></td>
                <?php if ($translator) : ?>
                <td><a href="/translate/faq/edit/<?php echo $faq->id; ?>" >[Traduire]</a></td>
                <?php endif; ?>
                <td><a href="/admin/faq/remove/<?php echo $faq->id; ?>" onclick="return confirm(<?php echo utf8_encode("Vous voulez supprimer cet enregistrement?") ?>);">[Supprimer]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
   <p class="text-primary"><?php echo utf8_encode("Aucun résultat trouvé") ?></p>
    <?php endif; ?>

</div>
</div>
</div>
</div>