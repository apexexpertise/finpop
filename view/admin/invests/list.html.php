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
    Goteo\Model\Invest;

$filters = $this['filters'];

?>
<!-- filtros -->
<?php $the_filters = array(
    'projects' => array (
        'label' =>  Text::_("projet"),
        'first' =>  Text::_("Tous les projets")),
    'users' => array (
        'label' =>  Text::_("utilisateur"),
        'first' =>  Text::_("Tous les utilisateurs")),
    'methods' => array (
        'label' =>  Text::_("Mode de paiement"),
        'first' =>  Text::_("Tous les modes")),
    'status' => array (
        'label' =>  Text::_("État du projet"),
        'first' =>  Text::_("Tous les états")),
    'investStatus' => array (
        'label' =>  Text::_("Etat d'entrée"),
        'first' =>  Text::_("Tous les entrée")),
    'campaigns' => array (
        'label' =>  Text::_("appel"),
        'first' =>  Text::_("Tous les appels")),
    'types' => array (
        'label' =>  Text::_("Extra"),
        'first' =>  Text::_("Tous"))
); ?>
<div class="widget board">
    <h3 class="title">Filtros</h3>
    <form id="filter-form" action="/admin/invests" method="get">
        <input type="hidden" name="filtered" value="yes" />
        <?php foreach ($the_filters as $filter=>$data) : ?>
        <div style="float:left;margin:5px;">
            <label for="<?php echo $filter ?>-filter"><?php echo $data['label'] ?></label><br />
            <select id="<?php echo $filter ?>-filter" name="<?php echo $filter ?>">
                <option value="<?php if ($filter == 'investStatus' || $filter == 'status') echo 'all' ?>"<?php if (($filter == 'investStatus' || $filter == 'status') && $filters[$filter] == 'all') echo ' selected="selected"'?>><?php echo $data['first'] ?></option>
            <?php foreach ($this[$filter] as $itemId=>$itemName) : ?>
                <option value="<?php echo $itemId; ?>"<?php if ($filters[$filter] === (string) $itemId) echo ' selected="selected"';?>><?php echo substr($itemName, 0, 50); ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <?php endforeach; ?>
        <br clear="both" />

        <div style="float:left;margin:5px;">
            <label for="name-filter">Alias / utilisateur Email:</label><br />
            <input type="text" id ="name-filter" name="name" value ="<?php echo $filters['name']?>" />
        </div>

        <br clear="both" />

        <div style="float:left;margin:5px;">
            <input type="submit" value="filtrar" />
        </div>
    </form>
    <br clear="both" />
    <a href="/admin/invests/?reset=filters"><?php echo Text::_("Retirer les filtres"); ?></a>
</div>

<div class="widget board">
<?php if ($filters['filtered'] != 'yes') : ?>
    <p><?php echo Text::_("Vous avez besoin de mettre des filtres, trop de dossiers!"); ?></p>
<?php elseif (!empty($this['list'])) : ?>
<?php $Total = 0; foreach ($this['list'] as $invest) { $Total += $invest->amount; } ?>
    <p><strong>TOTAL:</strong>  <?php echo number_format($Total, 0, '', '.') ?> &euro;</p>
    <p><strong>OJO!</strong> Resultado limitado a 999 registros como mÃ¡ximo.</p>
    
    <table width="100%">
        <thead>
            <tr>
                <th></th>
                <th><?php echo Text::_("contribution ID"); ?></th>
                <th><?php echo Text::_("date"); ?></th>
                <th><?php echo Text::_("cofinanceur"); ?></th>
                <th><?php echo Text::_("Projet"); ?></th>
                <th><?php echo Text::_("Etat"); ?></th>
                <th><?php echo Text::_("Metodo"); ?></th>
                <th><?php echo Text::_("contribution de l'Etat"); ?></th>
                <th><?php echo Text::_("montant"); ?></th>
                <th><?php echo Text::_("Extra"); ?></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['list'] as $invest) : ?>
            <tr>
                <td><a href="/admin/invests/details/<?php echo $invest->id ?>">[Détails]</a></td>
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
                    <?php if ($invest->anonymous == 1)  echo Text::_("AnÃ³nimo").' ' ?>
                    <?php if ($invest->resign == 1)  echo Text::_("contribution").' ' ?>
                    <?php if (!empty($invest->admin)) echo Text::_("manuel") ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
<?php else : ?>
    <p>Aucune contribution qui répondent aux filtres</p>
<?php endif;?>
</div>