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


 <div class="title-admin">
<p >Reviews  </p>
		<hr/>
		</div>
<div class="widget board">
<form id="filter-form" action="/admin/reviews" method="get">
     <div class="form-group col-lg-4">
    <label for="project-filter">Projet:</label>
    <select id="project-filter" name="project" onchange="document.getElementById('filter-form').submit();" class="form-control">
        <option value="">--</option>
        <?php foreach ($this['projects'] as $projId=>$projName) : ?>
            <option value="<?php echo $projId; ?>"<?php if ($filters['project'] == $projId) echo ' selected="selected"';?>><?php echo substr($projName, 0, 100); ?></option>
        <?php endforeach; ?>
    </select>

    <br />

    <label for="status-filter">Afficher par l'&eacute;tat:</label>
    <select id="status-filter" name="status" onchange="document.getElementById('filter-form').submit();" class="form-control">
        <option value="">Tout</option>
    <?php foreach ($this['status'] as $statusId=>$statusName) : ?>
        <option value="<?php echo $statusId; ?>"<?php if ($filters['status'] == $statusId) echo ' selected="selected"';?>><?php echo $statusName; ?></option>
    <?php endforeach; ?>
    </select>

    <label for="checker-filter">Assign&eacute; &aacute;:</label>
    <select id="checker-filter" name="checker" onchange="document.getElementById('filter-form').submit();" class="form-control">
        <option value="">Tous</option>
    <?php foreach ($this['checkers'] as $checker) : ?>
        <option value="<?php echo $checker->id; ?>"<?php if ($filters['checker'] == $checker->id) echo ' selected="selected"';?>><?php echo $checker->name; ?></option>
    <?php endforeach; ?>
    </select>
    </div>
</form>
</div>

<?php if (!empty($this['list'])) : ?>
    <?php foreach ($this['list'] as $project) : ?>
        <div class="widget board">
            <table class="table table-hover">
                <thead>
                    <tr class="active">
                        <th width="30%">Projet</th> <!-- edit -->
                        <th width="20%">Cr&eacute;ateur</th> <!-- mailto -->
                        <th width="5%">%</th> <!-- segun estado -->
                        <th width="5%">Points</th> <!-- segun estado -->
                        <th>
                            <!-- Iniciar revision si no tiene registro de revision -->
                            <!-- Editar si tiene registro -->
                        </th>
                        <th><!-- Ver informe si tiene registro --></th>
                        <th><!-- Cerar si abierta --></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><a href="/project/<?php echo $project->project; ?>" target="_blank" title="Preview"><?php echo $project->name; ?></a></td>
                        <td><?php echo $project->owner; ?></td>
                        <td><?php echo $project->progress; ?></td>
                        <td><?php echo $project->score . ' / ' . $project->max; ?></td>
                        <?php if (!empty($project->review)) : ?>
                        <td><a href="/admin/reviews/edit/<?php echo $project->project; ?>">[Editer]</a></td>
                        <td><a href="/admin/reviews/report/<?php echo $project->project; ?>" target="_blank">[Voir information]</a></td>
                            <?php if ( $project->status > 0 ) : ?>
                        <td><a href="/admin/reviews/close/<?php echo $project->review; ?>">[Fermer]</a></td>
                            <?php else : ?>
                        <td>R&eacute;vision ferm&eacute;</td>
                            <?php endif; ?>
                        <?php else : ?>
                        <td><a href="/admin/reviews/add/<?php echo $project->project; ?>">[Lancer la r&eacute;vision]</a></td>
                        <td></td>
                        <?php endif; ?>
                        <td><?php if ($project->translate) : ?><a href="<?php echo "/admin/translates/edit/{$project->project}"; ?>">[Allez &aacute; la traduction]</a>
                        <?php else : ?><a href="<?php echo "/admin/translates/add/?project={$project->project}"; ?>">[Activer la traduction]</a><?php endif; ?></td>


                    </tr>
                </tbody>

            </table>

            <?php if (!empty($project->review)) : ?>
            <table class="table table-hover">
                <tr class="active">
                    <th>R&eacute;viseur</th>
                    <th>Points</th>
                    <th>Pret</th>
                    <th></th>
                </tr>
                <?php foreach ($project->checkers as $user=>$checker) : ?>
                <tr>
                    <td><?php echo $checker->name; ?></td>
                    <td><?php echo $checker->score . '/' . $checker->max; ?></td>
                    <td><?php if ($checker->ready) : ?>Listo <a href="/admin/reviews/unready/<?php echo $project->review; ?>/?user=<?php echo $user; ?>">[Rouvrir]</a><?php endif ?></td>
                    <td><a href="/admin/reviews/unassign/<?php echo $project->review; ?>/?user=<?php echo $user; ?>">[D&eacute;sallouer]</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if ($project->status > 0) : ?>
                <tr>
                    <form id="form-assign-<?php echo $project->review; ?>" action="/admin/reviews/assign/<?php echo $project->review; ?>/" method="get">
                    <td colspan="2">
                        <select name="user">
                            <option value="">S&eacute;lectionnez un nouveau r&eacute;viseur</option>
                            <?php foreach ($this['checkers'] as $user) :
                                if (in_array($user->id, array_keys($project->checkers))) continue;
                                ?>
                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><a href="#" onclick="document.getElementById('form-assign-<?php echo $project->review; ?>').submit(); return false;">[Assigner]</a></td>
                    </form>
                </tr>
                <?php endif; ?>
            </table>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
<?php else : ?>
<p class="text-primary">Pas de r&eacute;sultat</p>
<?php endif; ?>
