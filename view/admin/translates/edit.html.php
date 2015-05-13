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
    Goteo\Library\i18n\Lang;

$project = $this['project'];
$langs = Lang::getAll();

$filters = $this['filters'];
?>
<script type="text/javascript">
function assign() {
    if (document.getElementById('assign-user').value != '') {
        document.getElementById('form-assign').submit();
        return true;
    } else {
        alert('Vous n\'avez s&eacute;lectionn&eacute; aucun traducteur');
        return false;
    }
}
</script>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
<div class="widget">
<?php if ($this['action'] == 'edit') : ?>
    <h3 class="title">Traducteurs pour le projet <?php echo $project->name ?></h3>
        <!-- asignar -->
        <table>
            <tr>
                <th>Traducteur</th>
                <th></th>
            </tr>
            <?php foreach ($project->translators as $userId=>$userName) : ?>
            <tr>
                <td><?php if ($userId == $project->owner) echo '(AUTEUR) '; ?><?php echo $userName; ?></td>
                <td><a href="/admin/translates/unassign/<?php echo $project->id; ?>/?user=<?php echo $userId; ?>">[d&eacute;sallouer]</a></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <form id="form-assign" action="/admin/translates/assign/<?php echo $project->id; ?>" method="get">
                <td colspan="2">
                    <select id="assign-user" name="user">
                        <option value="">S&eacute;lectionnez un autre traducteur</option>
                        <?php foreach ($this['translators'] as $user) :
                            if (in_array($user->id, array_keys($project->translators))) continue;
                            ?>
                        <option value="<?php echo $user->id; ?>"><?php if ($user->id == $project->owner) echo '(AUTOR) '; ?><?php echo $user->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><a href="#" onclick="return assign();" class="button">Assigner</a></td>
                </form>
            </tr>
        </table>
        <hr />
        <a href="/admin/translates/close/<?php echo $project->id; ?>" class="button" onclick="return confirm('vous voulez mettre fin &aacute; la traduction?')">Fermez la traduction</a>&nbsp;&nbsp;&nbsp;
        <a href="/admin/translates/send/<?php echo $project->id; ?>" class="button green" onclick="return confirm('Un email sera envoy&eacute; automatiquement, ok?')">Avertir l'auteur</a>
        <hr />
<?php endif; ?>

    <form method="post" action="/admin/translates/<?php echo $this['action']; ?>/<?php echo $project->id; ?>">
     	<div class="form-group col-lg-4">
				<?php if ($this['action'] == 'add') : ?>
                    <label for="add-proj">Projet nous permettons</label><br />
                    <select id="add-proj" name="project" class="form-control">
                        <option value="">S&eacute;lectionnez le projet</option>
                        <?php foreach ($this['availables'] as $proj) : ?>
                            <option value="<?php echo $proj->id; ?>"<?php if ($_GET['project'] == $proj->id) echo ' selected="selected"';?>><?php echo $proj->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else : ?>
                    <input type="hidden" name="project" value="<?php echo $project->id; ?>" class="form-control" />
                <?php endif; ?>
               
                    <label for="orig-lang">Projet de la langue d'origine</label><br />
                    <select id="orig-lang" name="lang" class="form-control">
                        <?php foreach ($langs as $item) : ?>
                            <option value="<?php echo $item->id; ?>"<?php if ($project->lang == $item->id || (empty($project->lang) && $item->id == 'es' )) echo ' selected="selected"';?>><?php echo $item->name; ?></option>
                        <?php endforeach; ?>
                    </select>
               
<br/>
       <input type="submit" name="save" value="Enregistrer" class="btn btn-primary" style="float:right;" />
       </div>
    </form>
</div>
</div>
</section>
</div>