<?php
/*
 * Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 * This file is part of Goteo.
 *
 * Goteo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Goteo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Goteo. If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */
use Goteo\Library\Text;

// paginacion
require_once 'library/pagination/pagination.php';

$filters = $this ['filters'];

$the_filters = '';
foreach ( $filters as $key => $value ) {
	$the_filters .= "&{$key}={$value}";
}

$pagedResults = new \Paginated ( $this ['projects'], 10, isset ( $_GET ['page'] ) ? $_GET ['page'] : 1 );
?>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
 <div class="title-admin">
<p>Project administration </p>
		<hr/>
		</div>
		<a href="/admin/translates" class="btn btn-default" style="color:white">Attribuer traducteurs</a>
<div class="widget board">
	<form id="filter-form" action="/admin/projects" method="get">
		<input type="hidden" name="filtered" value="yes" />
	
		<div class="form-group col-lg-5">
		
			<div class="form-group">
				<label for="name-filter">  Nom/Email 
					d'auteur: </label>
			
					<input type="text" id="name-filter" name="name"
						class="form-control" value="<?php echo $filters['name']?>" />
				
				<label for="proj_name-filter"> Nom du
					projet: </label>
			
					<input id="proj_name-filter"  class="form-control"
						name="proj_name" value="<?php echo $filters['proj_name']; ?>"
						/>
			
				<label for="category-filter">  Dans la
					cat&eacute;gorie:</label>
				
					<select id="category-filter" class="form-control" name="category"
						onchange="document.getElementById('filter-form').submit();">

						<option value="">toute les cat&eacute;gories</option>
                    <?php foreach ($this['categories'] as $categoryId=>$categoryName) : ?>
                        <option value="<?php echo $categoryId; ?>"
							<?php if ($filters['category'] == $categoryId) echo ' selected="selected"';?>><?php echo $categoryName; ?></option>
                    <?php endforeach; ?>
                    </select>
				
				<label for="status-filter"> Afficher
					par l'Etat: </label>
				
					<select id="status-filter" class="form-control" name="status"
						onchange="document.getElementById('filter-form').submit();">
						<option value="-1"
							<?php if ($filters['status'] == -1) echo ' selected="selected"';?>>Tous
							les &eacute;tats</option>
						<option value="-2"
							<?php if ($filters['status'] == -2) echo ' selected="selected"';?>>En
							n&eacute;gociation</option>
                    <?php foreach ($this['status'] as $statusId=>$statusName) : ?>
                        <option value="<?php echo $statusId; ?>"
							<?php if ($filters['status'] == $statusId) echo ' selected="selected"';?>><?php echo $statusName; ?></option>
                    <?php endforeach; ?>
                    </select>
				
			
			<label for="order-filter">Trier par:</label>
			
				<select id="order-filter" class="form-control" name="order"
					onchange="document.getElementById('filter-form').submit();">
                    <?php foreach ($this['orders'] as $orderId=>$orderName) : ?>
                        <option value="<?php echo $orderId; ?>"
						<?php if ($filters['order'] == $orderId) echo ' selected="selected"';?>><?php echo $orderName; ?></option>
                    <?php endforeach; ?>
                    </select>
			
					
					
					<br/>
					<input type="submit" name="filter" value="Chercher"
						class="btn btn-primary" style="float:right;"/>
						
						
				
			</div>
		</div>
	</form>
	<br/>
	<br/>
	<br clear="both" /> <a href="/admin/projects/?reset=filters">Retirer
		les filtres</a>
<?php if ($filters['filtered'] != 'yes') : ?>
    <p class="text-muted">Vous avez besoin d'appliquer au moins un filtre, il ya trop de
		dossiers!</p>
<?php elseif (empty($this['projects'])) : ?>
    <p>Pas de r&eacute;sultat</p>
<?php else: ?>
    <p class="text-danger">
		<strong>Attention!</strong> R&eacute;sultats limit&eacute;s &aacute;
		999 dossiers maximum.
	</p>
<?php endif; ?>
</div>


<?php

if (! empty ( $this ['projects'] )) :
	while ( $project = $pagedResults->fetchPagedRow () ) :
		?>
<div class="widget board">
	<table class="table table-hover ">
		<thead>
			<tr class="active">
				<th style="width: 250px;">Projet</th>
				<!-- edit -->
				<th style="min-width: 150px;">Cr&eacute;ateur</th>
				<!-- mailto -->
				<th style="min-width: 75px;">Re&ccedil;u</th>
				<!-- enviado a revision -->
				<th style="min-width: 80px;">Etat</th>
				<th style="min-width: 50px;">Noeud</th>
				<th style="min-width: 50px;">Minimum</th>
				<th style="min-width: 50px;">Optimal</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td><p class="text-info"><a href="/project/<?php echo $project->id; ?>" target="_blank"
					title="Preview"><?php echo $project->name; ?></a></p></td>
				<td><p class="text-info"><a href="mailto:<?php echo $project->user->email; ?>"><?php echo substr($project->user->email, 0, 100); ?></a></p></td>
				<td><p class="text-info"><?php echo date('d-m-Y', strtotime($project->updated)); ?></p></td>
				<td><?php echo ($project->status == 1 && !$project->draft) ? '<span style="color: green;">En n&eacute;gociation</span>' : $this['status'][$project->status]; ?></td>
				<td style="text-align: center;"><p class="text-info"><?php echo $project->node; ?></p></td>
				<td style="text-align: right;"><p class="text-info"><?php echo \amount_format($project->mincost).'€'; ?></p></td>
				<td style="text-align: right;"><p class="text-info"><?php echo \amount_format($project->maxcost).'€'; ?></p></td>
			</tr>
			<tr>
				<td colspan="7"><?php
		if ($project->status < 3)
			echo "Information <strong>{$project->progress}%</strong>";
		if ($project->status == 3 && $project->round > 0)
			echo "Nous sommes {$project->days} jour de la {$project->round}eme tour.&nbsp;&nbsp;&nbsp;<strong>Obtenu:</strong> " . \amount_format ( $project->invested ) . "€&nbsp;&nbsp;&nbsp;<strong>Cofinanceur:</strong> {$project->num_investors}&nbsp;&nbsp;&nbsp;<strong>Colabrateur:</strong> {$project->num_messegers}";
		?></td>
			</tr>
			<tr>
				<td colspan="7">Allez &aacute;:&nbsp; <a
					href="/project/edit/<?php echo $project->id; ?>" target="_blank">[Editer]</a>
					<a href="/admin/users/?id=<?php echo $project->owner; ?>"
					target="_blank">[Conduite]</a>
                    <?php
		
if (! isset ( $_SESSION ['admin_node'] ) || (isset ( $_SESSION ['admin_node'] ) && $_SESSION ['admin_node'] == \GOTEO_NODE) || (isset ( $_SESSION ['admin_node'] ) && $user->node == $_SESSION ['admin_node'])) :
			?>
                    <a
					href="/admin/accounts/?projects=<?php echo $project->id; ?>"
					title="Ver sus aportes">[Contributions]</a>
                    <?php else:  ?>
                    <a
					href="/admin/invests/?projects=<?php echo $project->id; ?>"
					title="Ver sus aportes">[Contributions]</a>
                    <?php endif; ?>
                    <a
					href="/admin/users/?project=<?php echo $project->id; ?>"
					title="Ver sus cofinanciadores">[Cofinanceurs]</a> <a
					href="/admin/projects/report/<?php echo $project->id; ?>"
					target="_blank">[Rapport financement]</a>
				</td>
			</tr>
			<tr>
				<td colspan="7">Changement:&nbsp; <a
					href="<?php echo "/admin/projects/dates/{$project->id}"; ?>">[dates]</a>
					<a href="<?php echo "/admin/projects/accounts/{$project->id}"; ?>">[comptes]</a>
                    <?php if ($project->status < 4) : ?><a
					href="<?php echo "/admin/projects/rebase/{$project->id}"; ?>"
					onclick="return confirm('Ce est tr&egrave;s d&eacute;licat, nous continuons?');">[Id]</a><?php endif; ?>
                    &nbsp;|&nbsp;
                    <?php if ($project->status < 2) : ?><a
					href="<?php echo "/admin/projects/review/{$project->id}"; ?>"
					onclick="return confirm('Le cr&eacute;ateur ne sera pas en mesure de modifier plus, ok?');">[Une
						r&eacute;vision]</a><?php endif; ?>
                    <?php if ($project->status < 3 && $project->status > 0) : ?><a
					href="<?php echo "/admin/projects/publish/{$project->id}"; ?>"
					onclick="return confirm('Le projet d&eacute;butera 40 jours du premier tour de la campagne, Voulez vous continuez?');">[Publier]</a><?php endif; ?>
                    <?php if ($project->status != 1) : ?><a
					href="<?php echo "/admin/projects/enable/{$project->id}"; ?>"
					onclick="return confirm('Attention! Le projet est en ligne, Voulez vous l&eacute;dite?');">[rouvrez
						&eacute;dition]</a><?php endif; ?>
                    <?php if ($project->status == 4) : ?><a
					href="<?php echo "/admin/projects/fulfill/{$project->id}"; ?>"
					onclick="return confirm('Le projet devrait devenir un exemple de r&eacute;ussite, ok?');">[Retour
						Termin&eacute;]</a><?php endif; ?>
                    <?php if ($project->status == 5) : ?><a
					href="<?php echo "/admin/projects/unfulfill/{$project->id}"; ?>"
					onclick="return confirm('Vous allez prendre un peu de recul, ok?');">[Retour
						en attente]</a><?php endif; ?>
                    <?php if ($project->status < 3 && $project->status > 0) : ?><a
					href="<?php echo "/admin/projects/cancel/{$project->id}"; ?>"
					onclick="return confirm('Le projet ne sera plus dans votre panneau d&apos;admin, et ne peut &ecirc;tre extraites de la base de donn&eacute;es, OK?');">[Jeter]</a><?php endif; ?>
                </td>
			</tr>
			<tr>
				<td colspan="5">
                    G&eacute;rer:&nbsp;
                    <?php if ($project->status == 1) : ?><a
					href="<?php echo "/admin/reviews/add/{$project->id}"; ?>"
					onclick="return confirm('Vous allez commenc&eacute; &aacute; examiner un projet de l&eacute;tat d&eacute;dition, ok?');">[D&eacute;marrer
						r&eacute;vision]</a><?php endif; ?>
                    <?php if ($project->status == 2) : ?><a
					href="<?php echo "/admin/reviews/?project=".urlencode($project->id); ?>">[Allez
						&aacute; la r&eacute;vision]</a><?php endif; ?>
                    <?php if ($project->translate) : ?><a
					href="<?php echo "/admin/translates/edit/{$project->id}"; ?>">[Traduction]</a>
                    <?php else : ?><a
					href="<?php echo "/admin/translates/add/?project={$project->id}"; ?>">[Activer
						la traduction]</a><?php endif; ?>
                    <a
					href="/admin/projects/images/<?php echo $project->id; ?>">[Organiser
						les images]</a>
                    <?php if ($project->status < 3) : ?><a
					href="<?php echo "/admin/projects/reject/{$project->id}"; ?>"
					onclick="return confirm('Un email sera envoy&eacute; automatiquement mais l&eacute;tat ne sera pas chang&eacute;, ok?');">[Rejet
						explicite]</a><?php endif; ?>
                </td>
			</tr>
		</tbody>

	</table>
</div>
<?php endwhile; ?>
<ul id="pagination">
<?php
	
$pagedResults->setLayout ( new DoubleBarLayout () );
	echo $pagedResults->fetchPagedNavigation ( $the_filters );
	?>
</ul>
<?php endif; ?>
</div>
</section>
</div>
