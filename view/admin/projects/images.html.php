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

$project = $this['project'];
$images = $this['images'];
$sections = $this['sections'];

function the_section($current, $image, $sections) {
    $select = '<select class="form-control" name="section_image_'.$image.'">';
    foreach ($sections as $secId => $secName) {
        $curSec = ($secId == $current) ? ' selected="selected"' : '';
        $select .= '<option value="'.$secId.'"'.$curSec.'>'.$secName.'</option>';
    }
    $select .= '</select>';
    
    return $select;
}

function the_link($current, $image) {
    return '<input  class="form-control" type="text" name="url_image_'.$image.'"  value="'.$current.'" style="width: 100%;"/>';
}

?>
<script type="text/javascript">
function move (img, direction, section) {
    document.getElementById('the_action').value = direction;
    document.getElementById('the_section').value = section;
    document.getElementById('move_pos').value = img;
    document.getElementById('images_form').submit();
}
</script>
<div class="widget board">
<a href="/admin/projects"  class="btn btn-default" style="color:white">Retour</a>

<a href="/project/<?php echo $project->id; ?>" class="btn btn-primary" style="color:white" target="_blank">Voir le projet</a>

<a href="/project/edit/<?php echo $project->id; ?>"  class="btn btn-primary" style="color:white" target="_blank">Editer le projet</a>
</div>
<div class="widget board">
    <?php if (!empty($images)) : ?>
    <form id="images_form" action="/admin/projects/images/<?php echo $project->id; ?>" method="post">
    
        <input type="hidden" name="id" value="<?php echo $project->id; ?>" />
        <input type="hidden" id="the_action" name="action" value="apply" />
        <input type="hidden" id="the_section" name="section" value="" />
        <input type="hidden" id="move_pos" name="move" value="" />
    

      
        <?php foreach ($sections as $sec=>$secName) : 
            if (empty($images[$sec])) continue; 
            ?>
            <center> <h3><?php echo $secName; ?> </h3> 
           
            <?php foreach ($images[$sec] as $image) : ?>     
               <div style="background-image:url(<?php echo $image->imageData->getLink(175, 100); ?>);border: 1px solid #dce4ec;border-radius: 4px;width:175px;height:100px;"></div>
          </center>
          	<div class="form-group col-lg-5">
                           <label>Section:</label><?php echo the_section($image->section, $image->image, $sections); ?>
                      <label>Lien:</label><?php echo the_link($image->url, $image->image); ?>
            
               <a href="#" onclick="move('<?php echo $image->image; ?>', 'up', '<?php echo $image->section; ?>'); return false;">[&uarr;]</a>
                <a href="#" onclick="move('<?php echo $image->image; ?>', 'down', '<?php echo $image->section; ?>'); return false;">[&darr;]</a>
         
            <?php endforeach; ?>
        <?php endforeach; ?>
      
        <input type="submit" name="apply_changes" value="Appliquer"  class="btn btn-primary" style="margin-top:10px;float:right"/>
        </div>
    </form>
    <?php else : ?>
    <p>PAS DE R&eacute;SULTAT</p>
    <?php endif; ?>
</div>
<form id="sec_form" action="/admin/projects/image_section/<?php echo $project->id; ?>" method="post">
    <input type="hidden" id="setimg" name="image" value="">
    <input type="hidden" id="setsec" name="section" value="">
</form>