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
use Goteo\Core\View, Goteo\Library\Text,  Goteo\Library\SuperForm,Goteo\Model\Project;

$project = $this ['project'];

if (! $project instanceof Goteo\Model\Project) {
	return;
}
?>

  <form id="selector-form" name="selector_form"
		class="form-horizontal"
		action="<?php echo '/dashboard/'.$this['section'].'/'.$this['option'].'/select'; ?>"
		method="post" enctype="multipart/form-data">
		
<div class="widget user-project-title">
	<p>
		<strong><?php echo $project->name ?></strong>
	</p>
</div>


<?php echo new SuperForm(array(
 
    'elements'      => array(
     
        'project_avatar' => array(
            'type'      => 'group',    
        		'title'     => Text::get('Couverture image'),
            'hint'      => Text::get('tooltip-user-image'),
            'errors'    => !empty($errors['avatar']) ? array($errors['avatar']) : array(),
            'ok'        => !empty($okeys['avatar']) ? array($okeys['avatar']) : array(),
            'class'     => 'user_avatar',
            'children'  => array(
                'avatar_upload'    => array(
                    'type'  => 'file',
                    'label' => Text::get('form-image_upload-button'),
                    'class' => 'inline avatar_upload',
                    'hint'  => Text::get('tooltip-user-image'),
                ),
                'avatar-current' => array(
                    'type' => 'hidden',
                    'value' => $project->avatar->id == 1 ? '' : $project->avatar->id,
                ),
                'avatar-image' => array(
                    'type'  => 'html',
                    'class' => 'inline avatar-image',
                    'html'  => is_object($project->avatar) &&  $project->avatar->id != 1 ?
                               $project->avatar . '<img src="'.SRC_URL.'/image/' . $project->avatar->id . '/128/128" alt="avatar" /><button class="image-remove" type="submit" name="avatar-'.$project->avatar->id.'-remove" title="Quitar imagen" value="remove">X</button>' :
                               ''
                )

            )
        

        
            
        )
    )
));

?>

<div class="status user-project-status">
	<div class="dropdown" id="menu-user-project">
		<button class="btn btn-default dropdown-toggle" type="button"
			id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			Actions <span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a role="menuitem" tabindex="-1"
				href="/project/edit/<?php echo $project->id ?>"><?php echo Text::get('regular-edit') ?></a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1"
				href="/project/<?php echo $project->id ?>" target="_blank"><?php echo Text::get('dashboard-menu-projects-preview') ?></a></li>
     <?php if ($project->status == 1) : ?>
    	<li role="presentation"><a role="menuitem" tabindex="-1"
				href="/project/delete/<?php echo $project->id ?>"
				onclick="return confirm('<?php echo Text::get('dashboard-project-delete_alert') ?>')"><?php echo Text::get('regular-delete') ?></a>
    <?php endif ?>
  </ul>
</div>
    <div id="project-status">
					<h3><?php echo Text::get('form-project-status-title'); ?></h3>
        <ul>
            <?php foreach (Project::status() as $i => $s): ?>
            <li></i><?php if ($i == $project->status) echo '<strong>' ?><i
							class="fa fa-chevron-circle-right margin-right"></i><?php echo htmlspecialchars($s) ?><?php if ($i == $project->status) echo '</strong>' ?></li>
            <?php endforeach ?>
        </ul>
    </div>


			
			</div>

<div id="meter-big" class="widget collapsable">

    <?php echo new View('view/project/meter_hor_big.html.php', $this) ?>
    
</div>
</form>

