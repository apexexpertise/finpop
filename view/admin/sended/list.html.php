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
    Goteo\Core\View;

// paginacion
require_once 'library/pagination/pagination.php';

$filters = $this['filters'];
$templates = $this['templates'];
$the_filters = '';
foreach ($filters as $key => $value) {
    $the_filters .= "&{$key}={$value}";
}

$pagedResults = new \Paginated($this['sended'], 20, isset($_GET['page']) ? $_GET['page'] : 1);
?>

<div class="container">
		<div class="row">
		<div class="col-md-12 column">
		<div class="title-admin">
<p>Historiques </p>
		<hr/>
		</div>
<div class="widget board">
    <form id="filter-form" action="/admin/sended" method="get">
    <div class="form-group col-lg-8">
        <div style="float:left;margin:5px;">
            <label for="user-filter">ID, nom ou email destinataire</label><br />
            <input id="user-filter" name="user" value="<?php echo $filters['user']; ?>" class="form-control"/>
        </div>

        <div style="float:left;margin:5px;">
            <label for="template-filter">Mod&eacute;le</label><br />
            <select id="template-filter" name="template" onchange="document.getElementById('filter-form').submit();" class="form-control" >
                <option value="">Tous les mod&eacute;les</option>
                <?php foreach ($templates as $templateId => $templateName) : ?>
                    <option value="<?php echo $templateId; ?>"<?php if ($filters['template'] == $templateId)
                    echo ' selected="selected"'; ?>><?php echo $templateName; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
		
        <br clear="both" />


        <div style="float:left;margin:5px;" id="date-filter-from">
            <label for="date-filter-from">De </label><br />
<?php echo new View('library/superform/view/element/datebox.html.php', array('value' => $filters['date_from'], 'id' => 'date-filter-from', 'name' => 'date_from','class' =>'form-control')); ?>
        </div>
        <div style="float:left;margin:5px;" id="date-filter-until">
            <label for="date-filter-until">&Aacute;</label><br />
<?php echo new View('library/superform/view/element/datebox.html.php', array('value' => $filters['date_until'], 'id' => 'date-filter-until', 'name' => 'date_until','class' =>'form-control')); ?>
        </div>
        <br clear="both"/>
        <div style="float:left;margin:5px;">
            <input type="submit" name="filter" value="Filtrer" class="btn btn-primary" style="float:right">
        </div>
</div>
    </form>
</div>

<div class="widget board">
    <?php if ($filters['filtered'] != 'yes') : ?>
        <p>Vous avez besoin de mettre des filtres, trop de dossiers!</p>
<?php elseif (!empty($this['sended'])) : ?>
        <table class="table table-hover">
            <thead>
                <tr class="active">
                    <th width="5%"><!-- Si no ves --></th>
                    <th width="45%">Destinataire</th>
                    <th width="35%">Mod&eacute;le</th>
                    <th width="15%">Date</th>
                    <th><!-- reenviar --></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($send = $pagedResults->fetchPagedRow()) :
                    $link = SITE_URL . '/mail/' . base64_encode(md5(uniqid()) . '¬' . $send->email . '¬' . $send->id) . '/?email=' . urlencode($send->email);
                    ?>
                    <tr>
                        <td><a href="<?php echo $link; ?>" target="_blank">[lien]</a></td>
                        <td><a href="/admin/users/?name=<?php echo urlencode($send->email) ?>"><?php echo $send->email; ?></a></td>
                        <td><?php echo $templates[$send->template]; ?></td>
                        <td><?php echo $send->date; ?></td>
                        <td><!-- <a href="#" target="_blank">[Reenviar]</a> --></td>
                    </tr>
    <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <ul id="pagination">
    <?php $pagedResults->setLayout(new DoubleBarLayout());
    echo $pagedResults->fetchPagedNavigation(str_replace('?', '&', $the_filters)); ?>
    </ul>
<?php else : ?>
<p class="text-primary">Pas de r&eacute;sultat</p>
<?php endif; ?>
</div>
</div>
</div>