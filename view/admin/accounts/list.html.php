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

$filters = $this['filters'];

?>
<div class="container">
		<div class="row">
		<div class="col-md-12 column">
 <div class="title-admin">
<p>Gestion des apports  </p>
		<hr/>
		</div>
		
<!-- filtros -->
<?php $the_filters = array(
    'projects' => array (
        'label' => Text::_("Projet"),
        'first' => Text::_("Tous les projets")),
    'users' => array (
        'label' => Text::_("Utilisateurs"),
        'first' => Text::_("Tous les utlisateurs")),
    'methods' => array (
        'label' => Text::_("M&eacute;thodes de paiement"),
        'first' => Text::_("Tous les modes")),
    'investStatus' => array (
        'label' => Text::_("Etat de la contribution"),
        'first' => Text::_("Tous les &eacute;tats")),
    'campaigns' => array (
        'label' => Text::_("Compagne"),
        'first' => Text::_("Tous les compagnes")),
    'review' => array (
        'label' => Text::_("Pour r&eacute;vision"),
        'first' => Text::_("Tous")),
); ?>
<a href="/admin/accounts/viewer" class="btn btn-default" style="color:white"><?php echo Text::_("Logs"); ?></a>&nbsp;&nbsp;&nbsp;
<div class="widget board">
    <h3 class="title"><?php echo Text::_("Filtres"); ?></h3>
    <form id="filter-form" action="/admin/accounts" method="get">
        <input type="hidden" name="filtered" value="yes" class="form-control"/>
        <input type="hidden" name="status" value="all" class="form-control" />
        <?php foreach ($the_filters as $filter=>$data) : ?>
        <div style="float:left;margin:5px;">
            <label for="<?php echo $filter ?>-filter"><?php echo $data['label'] ?></label><br />
            <select id="<?php echo $filter ?>-filter" name="<?php echo $filter ?>" onchange="document.getElementById('filter-form').submit();" class="form-control">
                <option value="<?php if ($filter == 'investStatus' || $filter == 'status') echo 'all' ?>"<?php if (($filter == 'investStatus' || $filter == 'status') && $filters[$filter] == 'all') echo ' selected="selected"'?>><?php echo $data['first'] ?></option>
            <?php foreach ($this[$filter] as $itemId=>$itemName) : ?>
                <option value="<?php echo $itemId; ?>"<?php if ($filters[$filter] === (string) $itemId) echo ' selected="selected"';?>><?php echo $itemName; ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <?php endforeach; ?>
        <div style="float:left;margin:5px;">
            <label for="date-filter-from">du</label><br />
            <input type="text" id ="date-filter-from" name="date_from" value ="" class="form-control"/>
        </div>
        <div style="float:left;margin:5px;">
            <label for="date-filter-until">jusqu'au</label><br />
            <input type="text" id ="date-filter-until" name="date_until" value ="<?php echo date('Y-m-d') ?>" class="form-control"/>
        </div>
       
         <br clear="both" />
            <input type="submit" value="Filtrer" class="btn btn-primary" style="float:right;" />
      </form>
    
    <br clear="both" />
    <a href="/admin/accounts">Supprimer les filtres</a>
</div>

<div class="widget board">
<?php if ($filters['filtered'] != 'yes') : ?>
    <p><?php echo Text::_("Vous avez besoin de mettre des filtres, trop de dossiers!"); ?></p>
<?php elseif (!empty($this['list'])) : ?>
<?php $Total = 0; foreach ($this['list'] as $invest) { $Total += $invest->amount; } ?>
    <p><strong><?php echo Text::_("TOTAL"); ?>:</strong>  <?php echo number_format($Total, 0, '', '.') ?> &euro;</p>
    
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th></th>
                <th><?php echo Text::_("Contribution ID"); ?></th>
                <th><?php echo Text::_("Date"); ?></th>
                <th><?php echo Text::_("Cofinanceur"); ?></th>
                <th><?php echo Text::_("Projet"); ?></th>
                <th><?php echo Text::_("Etat"); ?></th>
                <th><?php echo Text::_("M&eacute;thode"); ?></th>
                <th><?php echo Text::_("Etat de la contribution"); ?></th>
                <th><?php echo Text::_("Montant"); ?></th>
                <th><?php echo Text::_("Extra"); ?></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['list'] as $invest) : ?>
            <tr>
                <td><a href="/admin/accounts/details/<?php echo $invest->id ?>">[<?php echo Text::_("D&eacute;tails"); ?>]</a></td>
                <td><?php echo $invest->id ?></td>
                <td><?php echo $invest->invested ?></td>
                <td><?php echo $this['users'][$invest->user] ?></td>
                <td><?php echo $this['projects'][$invest->project]; if (!empty($invest->campaign)) echo '<br />('.$this['campaigns'][$invest->campaign].')'; ?></td>
                <td><?php echo $this['status'][$invest->status] ?></td>
                <td><?php echo $this['methods'][$invest->method] ?></td>
                <td><?php echo $this['investStatus'][$invest->investStatus] ?></td>
                <td><?php echo $invest->amount ?></td>
                <td><?php echo $invest->charged ?></td>
                <td><?php echo $invest->returned ?></td>
                <td>
                    <?php if ($invest->anonymous == 1)  echo Text::_("anonyme ") ?>
                    <?php if ($invest->resign == 1)  echo Text::_("Contribution ") ?>
                    <?php if (!empty($invest->admin)) echo Text::_("Manuel") ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
<?php else : ?>
   <p class="text-primary">Aucune transaction qui r&eacute;pond au filtre..</p>
<?php endif;?>
</div>
</div>
</div>
</div>