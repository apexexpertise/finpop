<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundaci�n Fuentes Abiertas (see README for details)
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
    Goteo\Model;

$banner = $this['banner'];

// proyectos disponibles
// si tenemos ya proyecto seleccionado lo incluimos
$projects = Model\Banner::available($banner->project);
$status = Model\Project::status();

?>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
  
<form class="form-horizontal" method="post" action="/admin/banners" enctype="multipart/form-data">
	<div class="form-group col-lg-4">
    <input type="hidden" name="action" value="<?php echo $this['action'] ?>" />
    <input type="hidden" name="order" value="<?php echo $banner->order ?>" />
    <input type="hidden" name="id" value="<?php echo $banner->id; ?>" />

<p>
    <label for="banner-project"><?php echo Text::_("Proyecto"); ?>:</label><br />
    <select id="banner-project" name="project" class="form-control">
        <option value="" ><?php echo Text::_("Seleccionar el proyecto a mostrar en el banner"); ?></option>
    <?php foreach ($projects as $project) : ?>
         <option value="<?php echo $project->id; ?>"<?php if ($banner->project == $project->id) echo' selected="selected"';?>><?php echo $project->name . ' ('. $status[$project->status] . ')'; ?></option>
    <?php endforeach; ?>
    </select>
</p>

<p>
    <label><?php echo Text::_("Description"); ?>:</label><br />
   <TEXTAREA name="description" rows=4 cols=40 class="form-control">description du banniere</TEXTAREA>
</p>

<p>
    <label><?php echo Text::_("Titre du projet"); ?>:</label><br />
    <input  type="text" placeholder="title" name="title" class="form-control">
   
</p>

<p>
    <label><?php echo Text::_("lien"); ?>:</label><br />
    
   <INPUT type=text name="url" class="form-control" />
</p>

<p>
    <label >statut du banniere:</label><br />
    <select name="active" class="form-control">
        <option value="1" >1</option>
    
         <option value="2" >2</option>
    
    </select>
  
</p>



<p>
    <label for="banner-image"><?php echo Text::_("Image de taille: 700 x 156 (strict)"); ?></label><br />
    <input type="file" id="banner-image" name="image" class="form-control" />
    <?php if (!empty($banner->image)) : ?>
        <br />
        <input type="hidden" name="prev_image" value="<?php echo $banner->image->id ?>" />
        <img src="<?php echo $banner->image->getLink(700, 156, true) ?>" title="<?php echo Text::_("Album"); ?>" alt="<?php echo Text::_("Image"); ?>"/>
    <?php endif; ?>
</p>

 <input type="submit" name="save" value="<?php echo Text::_("Enregister"); ?>"   class="btn btn-primary" style="float:right"/>
   
    </div>
   
</form>
</div>
</section>
</div>
