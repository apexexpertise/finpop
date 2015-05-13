<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *  This file is part of Goteo.
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
    Goteo\Model\Home;

$node = isset($_SESSION['admin_node']) ? $_SESSION['admin_node'] : \GOTEO_NODE;

if ($node != \GOTEO_NODE) {
    $the_items = Home::_node_items();
    $the_side_items = Home::_node_side_items();
} else {
    $the_items = Home::_items();
}

$items = $this['items'];
$new = $this['new'];
$availables = $this['availables'];

$side_items = $this['side_items'];
$side_new = $this['side_new'];
$side_availables = $this['side_availables'];

$admins = Home::_admins();

?>
<?php /* if ($node != \GOTEO_NODE) : ?><a href="/admin/home/addside" class="button" style="margin-right: 270px;">A&ntilde;adir elemento lateral</a><?php endif; ?>
<a href="/admin/home/add" class="button">A&ntilde;adir elemento</a>
<br />
 *
 */ ?>
<?php if ($node != \GOTEO_NODE) : ?>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
<div class="widget board" style="width:350px; float:left; margin-right: 5px;">
    <h4 class="title">Laterales</h4>
    <?php if (!empty($side_items)) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th>position</th> <!-- order -->
                <th>&eacute;l&eacute;ment</th> <!-- item -->
                <th><!-- Subir --></th>
                <th><!-- Bajar --></th>
                <th><!-- Quitar--></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($side_items as $item) : ?>
            <tr>
                <td><?php echo $item->order; ?></td>
                <td><?php
                if (isset($admins[$item->item])) {
                    echo '<a href="'.$admins[$item->item].'" style="text-decoration: underline;">'.$the_side_items[$item->item].'</a>';
                } else { 
                    echo $the_side_items[$item->item]; }
                ?></td>
                <td><a href="/admin/home/up/<?php echo $item->item; ?>/side">[&uarr;]</a></td>
                <td><a href="/admin/home/down/<?php echo $item->item; ?>/side">[&darr;]</a></td>
                <td><a href="/admin/home/remove/<?php echo $item->item; ?>/side">[supprimer]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>Pas de couvercle de l'&eacute;l&eacute;ment lat&eacute;ral</p>
    <?php endif; ?>

    <?php if (!empty($side_availables)) : ?>
    <form method="post" action="/admin/home" >
    <div class="form-group col-lg-4">
    <input type="hidden" name="action" value="add" />
    <input type="hidden" name="type" value="<?php echo $side_new->type ?>" />
    <input type="hidden" name="order" value="<?php echo $side_new->order ?>" />

    <p>
        <label for="home-item">Nouveau element:</label><br />
        <select id="home-item" name="item" class="form-control">
        <?php foreach ($side_availables as $item=>$name) : ?>
            <option value="<?php echo $item; ?>"><?php echo $name; ?></option>
        <?php endforeach; ?>
        </select>
        <br />
        <input type="submit" name="save" value="Enregistrer"  class="btn btn-primary" style="float:right"/>
    </p>
</div>
    </form>
    <?php endif; ?>

</div>
<?php endif; ?>
 <div class="title-admin">
<p>&Eacute;lements de couverture  </p>
		<hr/>
		</div>
<div class="widget board" <?php if ($node != \GOTEO_NODE) : ?>style="width:350px; float:left;"<?php endif; ?>>

    <h3 class="dark-grey" style="margin-top: 0px;margin-bottom: 26px;">Central</h3>
     <?php if (!empty($availables)) : ?>
    <form method="post" action="/admin/home" >
     <div class="form-group col-lg-4">
    <input type="hidden" name="action" value="add" />
    <input type="hidden" name="type" value="<?php echo $new->type ?>" />
    <input type="hidden" name="order" value="<?php echo $new->order ?>" />

    <p>
        <label for="home-item">Nouveau &eacute;lement:</label><br />
        <select id="home-item" name="item" class="form-control">
        <?php foreach ($availables as $item=>$name) : ?>
            <option value="<?php echo $item; ?>"><?php echo $name; ?></option>
        <?php endforeach; ?>
        </select>
        <br />
        <input type="submit" name="save" value="Enregistrer" class="btn btn-primary" style="float:right"/>
    </p>
</div>
    </form>
    <?php endif; ?>
    <?php if (!empty($items)) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th>position</th> <!-- order -->
                <th>Element</th> <!-- item -->
                <th><!-- Subir --></th>
                <th><!-- Bajar --></th>
                <th><!-- Quitar--></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($items as $item) : ?>
            <tr>
                <td><?php echo $item->order; ?></td>
                <td><?php
                if (isset($admins[$item->item])) {
                    echo '<a href="'.$admins[$item->item].'" style="text-decoration: underline;">'.$the_items[$item->item].'</a>';
                } else {
                    echo $the_items[$item->item]; }
                ?></td>
                <td><a href="/admin/home/up/<?php echo $item->item; ?>/main">[&uarr;]</a></td>
                <td><a href="/admin/home/down/<?php echo $item->item; ?>/main">[&darr;]</a></td>
                <td><a href="/admin/home/remove/<?php echo $item->item; ?>/main">[supprimer]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>Pas de couvercle de l'&eacute;l&eacute;ment</p>
    <?php endif; ?>

   
    
</div>
</div>
</section>
</div>

