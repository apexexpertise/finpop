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
    Goteo\Core\ACL;

// paginacion
require_once 'library/pagination/pagination.php';

$translator = ACL::check('/translate') ? true : false;

$filters = $this['filters'];
if (empty($filters['show'])) $filters['show'] = 'all';
$the_filters = '';
foreach ($filters as $key=>$value) {
    $the_filters .= "&{$key}={$value}";
}

$pagedResults = new \Paginated($this['posts'], 10, isset($_GET['page']) ? $_GET['page'] : 1);
?>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
 <div class="title-admin">
<p >Blog  </p>
		<hr/>
		</div>
	
<a href="/admin/blog/add" class="btn btn-default" style="color:white" ><?php echo Text::_("Nouvelle entr&eacute;e"); ?></a>
&nbsp;&nbsp;&nbsp;
<a href="/admin/blog/reorder" class="btn btn-primary" style="color:white" >Trier</a>


<div class="widget board" style="margin-top:15px;">
    <form id="filter-form" action="/admin/blog" method="get">
       	<div class="form-group col-lg-4">
            <label for="show-filter">Afficher:</label><br />
            <select id="show-filter" name="show" onchange="document.getElementById('filter-form').submit();" class="form-control">
            <?php foreach ($this['show'] as $itemId=>$itemName) : ?>
                <option value="<?php echo $itemId; ?>"<?php if ($filters['show'] == $itemId) echo ' selected="selected"';?>><?php echo $itemName; ?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <?php if ($filters['show'] == 'updates') : ?>
        <div style="float:left;margin:5px;">
            <label for="blog-filter">De projet:</label><br />
            <select id="blog-filter" name="blog" onchange="document.getElementById('filter-form').submit();" class="form-control">
                <option value="">Tout</option>
            <?php foreach ($this['blogs'] as $itemId=>$itemName) : ?>
                <option value="<?php echo $itemId; ?>"<?php if ($filters['blog'] == $itemId) echo ' selected="selected"';?>><?php echo $itemName; ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <?php if ($filters['show'] == 'entries') : ?>
        <div style="float:left;margin:5px;">
            <label for="blog-filter">De noeud:</label><br />
            <select id="blog-filter" name="blog" onchange="document.getElementById('filter-form').submit();" class="form-control">
                <option value="">Quelconque</option>
            <?php foreach ($this['blogs'] as $itemId=>$itemName) : ?>
                <option value="<?php echo $itemId; ?>"<?php if ($filters['blog'] == $itemId) echo ' selected="selected"';?>><?php echo $itemName; ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>
    </form>
</div>

<div class="widget board">
    <?php if (!empty($this['posts'])) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th><!-- published --></th>
                <th colspan="6"><?php echo Text::_("Titre"); ?></th> <!-- title -->
                <th><?php echo Text::_("Date"); ?></th> <!-- date -->
                <th>Auteur</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($post = $pagedResults->fetchPagedRow()) : ?>
            <tr >
                <td><p class="text-success"><?php if ($post->publish) echo '<strong style="font-size:10px;">Publi&eacute;</strong>'; ?></p></td>
                <td colspan="6"> <p class="text-primary"><?php
                        $style = '';
                        if (isset($this['homes'][$post->id]))
                            $style .= ' font-weight:bold;';
                        if (empty($_SESSION['admin_node']) || $_SESSION['admin_node'] == \GOTEO_NODE) {
                            if (isset($this['footers'][$post->id]))
                                $style .= ' font-style:italic;';
                        }
                            
                      echo "<span style=\"{$style}\">{$post->title}</span>";
                ?> </p></td>
                <td><p class="text-primary"><?php echo $post->fecha; ?> </p></td>
                <td><p class="text-primary"><?php echo $post->user->name . ' (' . $post->owner_name . ')'; ?> </p></td>
            </tr>
            <tr>
                <td><p class="text-success"><a href="/blog/<?php echo $post->id; ?>?preview=<?php echo $_SESSION['user']->id ?>" target="_blank">[Voir]</a></p></td>
                <td><p class="text-info"><?php if (($post->owner_type == 'node' && $post->owner_id == $node) || $node == \GOTEO_NODE) : ?>
                    <a href="/admin/blog/edit/<?php echo $post->id; ?>">[Editar]</a>
                <?php endif; ?></p></td>
                <td><p class="text-info"><?php if (isset($this['homes'][$post->id])) {
                        echo '<a href="/admin/blog/remove_home/'.$post->id.'" ">[Retirer le couvercle]</a>';
                    } elseif ($post->publish) {
                        echo '<a href="/admin/blog/add_home/'.$post->id.'" ">[Mettez le couvercle]</a>';
                    } ?></p></td>
                <td><p class="text-info"><?php if (empty($_SESSION['admin_node']) || $_SESSION['admin_node'] == \GOTEO_NODE) {
                        if (isset($this['footers'][$post->id])) {
                            echo '<a href="/admin/blog/remove_footer/'.$post->id.'" ">[Retirer de pied de page]</a>';
                        } elseif ($post->publish) {
                            echo '<a href="/admin/blog/add_footer/'.$post->id.'" ">[Ajouter au pied de page]</a>';
                        }
                    } ?></p></td>
                <td>
                <p class="text-info">
                <?php if ($translator && $node == \GOTEO_NODE) : ?><a href="/translate/post/edit/<?php echo $post->id; ?>" >[Traduire]</a><?php endif; ?>
                <?php if ($node != \GOTEO_NODE && $transNode && ($post->owner_type == 'node' && $post->owner_id == $node)) : ?><a href="/translate/node/<?php echo $node ?>/post/edit/<?php echo $post->id; ?>" target="_blank">[Traduire]</a><?php endif; ?>
               </p>
                </td>
                
                <td><p class="text-info"><?php if (!$post->publish && (($post->owner_type == 'node' && $post->owner_id == $_SESSION['admin_node']) || !isset($_SESSION['admin_node']))) : ?>
                    <a href="/admin/blog/remove/<?php echo $post->id; ?>" onclick="return confirm('Vous voulez supprimer cet enregistrement?');">[Eliminar]</a>
                <?php endif; ?>
                </p>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="9"><hr /></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<ul id="pagination" style="margin-bottom: 10px; padding-left: 150px;">
<?php   $pagedResults->setLayout(new DoubleBarLayout());
        echo $pagedResults->fetchPagedNavigation(str_replace('?', '&', $the_filters)); ?>
</ul>
<?php else : ?>
<p class="text-primary">Aucun r&eacute;sultat trouv&eacute;</p>
<?php endif; ?>
</div>

</section>
</div>
