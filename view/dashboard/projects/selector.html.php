<?php
/*
 * Copyright (C) 2012 Platoniq y FundaciÃ³n Fuentes Abiertas (see README for details)
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
use Goteo\Library\Text,
Goteo\Library\SuperForm,
Goteo\Core\View;
define('ADMIN_NOAUTOSAVE', true);
$user   = $this['user'];
$errors = $this['errors'];
$this['level'] = 3;
?>
<div id="project-selector">
    <?php if (!empty($this['projects'])) : ?>
        <form id="selector-form" name="selector_form"
		class="form-horizontal"
		action="<?php echo '/dashboard/'.$this['section'].'/'.$this['option'].'/select'; ?>"
		method="post" enctype="multipart/form-data">
		<div class="form-group">
			 <div class="col-xs-2">
				<label for="selector">Changer la couverture :</label>
			</div>
			 <div class="col-xs-5">

<?php echo new SuperForm(array(
 
    'elements'      => array(
     
        'user_avatarp' => array(
            'type'      => 'group',
           
            'hint'      => Text::get('tooltip-user-image'),
            'errors'    => !empty($errors['avatarp']) ? array($errors['avatarp']) : array(),
            'ok'        => !empty($okeys['avatarp']) ? array($okeys['avatarp']) : array(),
            'class'     => 'user_avatarp',
            'children'  => array(
                'avatarp_upload'    => array(
                    'type'  => 'file',
                    'label' => Text::get('form-image_upload-button'),
                    'class' => 'inline avatarp_upload',
                    'hint'  => Text::get('tooltip-user-image'),
                ),
                'avatarp-current' => array(
                    'type' => 'hidden',
                    'value' => $user->avatarp->id == 1 ? '' : $user->avatarp->id,
                ),
                'avatarp-image' => array(
                    'type'  => 'html',
                    'class' => 'inline avatarp-image',
                    'html'  => is_object($user->avatarp) &&  $user->avatarp->id != 1 ?
                               $user->avatarp . '<img src="'.SRC_URL.'/image/' . $user->avatarp->id . '/128/128" alt="avatarp" /><button class="image-remove" type="submit" name="avatarp-'.$user->avatarp->id.'-remove" title="Quitar imagen" value="remove">X</button>' :
                               ''
                )

            )
        

        
            
        )
    )
));

?>
</div>
</div>
		<div class="form-group">
			 <div class="col-xs-2">
				<label for="selector">Projet :</label>
			</div>
			 <div class="col-xs-5">
				<select id="selector" name="project" class="form-control"
					onchange="document.getElementById('selector-form').submit();">
        <?php foreach ($this['projects'] as $project) : ?>
            <option value="<?php echo $project->id; ?>"
						<?php if ($project->id == $_SESSION['project']->id) echo ' selected="selected"'; ?>><?php echo $project->name; ?></option>
        <?php endforeach; ?>
        </select>
			</div>
		</div>
	</form>
	<script type="text/javascript">
$(function () {

    var webs = $('div#<?php echo $sfid ?> li.element#user_webs');

    webs.delegate('li.element.web input.edit', 'click', function (event) {
        var data = {};
        data[this.name] = '1';
        Superform.update(webs, data);
        event.preventDefault();
    });

    webs.delegate('li.element.editweb input.ok', 'click', function (event) {
        var data = {};
        data[this.name.substring(0, 7) + 'edit'] = '0';
        Superform.update(webs, data);
        event.preventDefault();
    });

    webs.delegate('li.element.editweb input.remove, li.element.web input.remove', 'click', function (event) {
        var data = {};
        data[this.name] = '1';
        Superform.update(webs, data);
        event.preventDefault();
    });

    webs.delegate('#web-add input', 'click', function (event) {
       var data = {};
       data[this.name] = '1';
       Superform.update(webs, data);
       event.preventDefault();
    });

});
</script>
    <?php else : ?>
    <p>
		Vous n'avez pas de projet, vous pouvez créer un  <a
			href="/project/create">ici</a>
	</p>
    <?php endif; ?>
</div>
