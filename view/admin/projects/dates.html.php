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

use Goteo\Core\View,
    Goteo\Library\Text,
    Goteo\Model,
    Goteo\Core\Redirection,
    Goteo\Library\Message,
    Goteo\Library\SuperForm;

define('ADMIN_NOAUTOSAVE', true);

$project = $this['project'];

if (!$project instanceof Model\Project) {
    Message::Error('Instancia de proyecto corrupta');
    throw new Redirection('/admin/projects');
}

$elements = array(
    'created' => array(
        'type'      => 'datebox',
        'title'     => 'Date de cr&eacute;ation',
        'value'     => !empty($project->created) ? $project->created : null
    ),
    'updated' => array(
        'type'      => 'datebox',
        'title'     => 'Date d\'envoi à la r&eacute;vision',
        'value'     => !empty($project->updated) ? $project->updated : null
    ),
    'published' => array(
        'type'      => 'datebox',
        'title'     => 'Date de d&eacute;but de la campagne',
        'subtitle'  => '(Les jours sont calcul&eacute;s selon cette date )',
        'value'     => !empty($project->published) ? $project->published : null
    ),
    'success' => array(
        'type'      => 'datebox',
        'title'     => 'Date de succès',
        'subtitle'  => '(Date du second tour)',
        'value'     => !empty($project->success) ? $project->success : null
    ),
    'closed' => array(
        'type'      => 'datebox',
        'title'     => 'Date de cloture',
        'value'     => !empty($project->closed) ? $project->closed : null
    ),
    'passed' => array(
        'type'      => 'datebox',
        'title'     => 'Date de transit au second tour',
        'subtitle'  => '(Date de premier tour)',
        'value'     => !empty($project->passed) ? $project->passed : null
    )

);
?>
<div class="widget">
<p>
    <?php if (!empty($project->passed)) {
        echo 'Le projet s\'est termin&eacute; la premi&egrave;re ronde de la journ&eacute;e <strong>'.date('d/m/Y', strtotime($project->passed)).'</strong>.';
        if ($project->passed != $project->willpass) {
            echo '<br />Bien disposition doit avoir termin&eacute; la journ&eacute;e <strong>'.date('d/m/Y', strtotime($project->willpass)).'</strong>.';
        }
    } else {
        echo 'Le projet prendra fin la premi&egrave;re ronde de la journ&eacute;e <strong>'.date('d/m/Y', strtotime($project->willpass)).'</strong>.';
    } ?>

</p>

    <p> <?php echo utf8_encode("La modification des dates peut provoquer des changements dans les jours de campagne d'un projet.") ?></p>

    <form method="post" action="/admin/projects" >
        <input type="hidden" name="id" value="<?php echo $project->id ?>" />

<?php foreach ($elements as $id=>$element) : ?>
    <div id="<?php echo $id ?>">
        <h4><?php echo $element['title'] ?>:</h4>
        <?php echo new View('library/superform/view/element/datebox.html.php', array('value'=>$element['value'], 'id'=>$id, 'name'=>$id)); ?>
        <?php if (!empty($element['subtitle'])) echo $element['subtitle'].'<br />'; ?>
    </div>
        <br />
<?php endforeach; ?>

        <input type="submit" name="save-dates" value="Enregistrer" />

    </form>
</div>
