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

$filters = $_SESSION['mailing']['filters'];

?>

 <div class="title-admin">
<p>Communications  </p>
		<hr/>
		</div>
<div class="widget board">
    <form id="filter-form" action="/admin/mailing/edit" method="post">

        <div style="float:left;margin:5px;">
                    <label for="type-filter"><?php echo Text::_("&Aacute;"); ?></label><br />
                    <select id="type-filter" name="type" class="form-control">
                    <?php foreach ($this['types'] as $typeId=>$typeName) : ?>
                        <option value="<?php echo $typeId; ?>"<?php if ($filters['type'] == $typeId) echo ' selected="selected"';?>><?php echo $typeName; ?></option>
                    <?php endforeach; ?>
                    </select>
               
                    <label for="project-filter"><?php echo Text::_("Projets dont le nom contient"); ?></label><br />
                    <input id="project-filter" name="project" value="<?php echo $filters['project']?>" class="form-control"/>
              </div>
           <div style="float:left;margin:5px;">
                    <label for="status-filter"><?php echo Text::_("Dans l'&eacute;tat"); ?></label><br />
                    <select id="status-filter" name="status" class="form-control">
                        <option value="-1"<?php if ($filters['status'] == -1) echo ' selected="selected"';?>> <?php echo utf8_encode("Etat quelconque") ?></option>
                    <?php foreach ($this['status'] as $statusId=>$statusName) : ?>
                        <option value="<?php echo $statusId; ?>"<?php if ($filters['status'] == $statusId) echo ' selected="selected"';?>><?php echo $statusName; ?></option>
                    <?php endforeach; ?>
                    </select>
               
                    <label for="method-filter"><?php echo Text::_("Propos&eacute; par"); ?></label><br />
                    <select id="method-filter" name="method" class="form-control">
                        <option value=""><?php echo Text::_("toute m&eacute;thode"); ?></option>
                    <?php foreach ($this['methods'] as $methodId=>$methodName) : ?>
                        <option value="<?php echo $methodId; ?>"<?php if ($filters['methods'] == $methodId) echo ' selected="selected"';?>><?php echo $methodName; ?></option>
                    <?php endforeach; ?>
                    </select>
          </div>
           <div style="float:left;margin:5px;">
                    <label for="interest-filter"><?php echo Text::_("Int&eacute;ress&eacute; pour"); ?></label><br />
                    <select id="interest-filter" name="interest" class="form-control">
                        <option value=""><?php echo Text::_("tout"); ?></option>
                    <?php foreach ($this['interests'] as $interestId=>$interestName) : ?>
                        <option value="<?php echo $interestId; ?>"<?php if ($filters['interest'] == $interestId) echo ' selected="selected"';?>><?php echo $interestName; ?></option>
                    <?php endforeach; ?>
                    </select>
              
                    <label for="name-filter"><?php echo Text::_("Le nom ou email contient"); ?></label><br />
                    <input id="name-filter" name="name" value="<?php echo $filters['name']?>" class="form-control" />
               </div>
           <div style="float:left;margin:5px;">
                    <label for="role-filter"><?php echo Text::_("Ce sont"); ?></label><br />
                    <select id="role-filter" name="role" class="form-control">
                        <option value=""><?php echo Text::_("Tout"); ?></option>
                    <?php foreach ($this['roles'] as $roleId=>$roleName) : ?>
                        <option value="<?php echo $roleId; ?>"<?php if ($filters['role'] == $roleId) echo ' selected="selected"';?>><?php echo $roleName; ?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>
                    <br clear="both"/>
                     <div style="margin:5px;">
              <input type="submit" name="select" value="<?php echo Text::_("Recherche b&eacute;n&eacute;ficiaires"); ?>" class="btn btn-primary" style="float:right">
            </div>
    </form>
</div>
