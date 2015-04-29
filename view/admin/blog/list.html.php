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
<p style="padding-left:20px;color:#555555;font-family:Myriad Pro Regular;;font-size:29px;">Blog  </p>
		<hr style="width:2000px;margin-top:25px;"/>
<a href="/admin/blog/add" class="button"><?php echo Text::_("Nouvelle entr&eacute;e"); ?></a>
&nbsp;&nbsp;&nbsp;
<a href="/admin/blog/reorder" class="button">Trier</a>

<div class="widget board">
    <form id="filter-form" action="/admin/blog" method="get">
        <div style="float:left;margin:5px;">
            <label for="show-filter">Afficher:</label><br />
            <select id="show-filter" name="show" onchange="document.getElementById('filter-form').submit();">
            <?php foreach ($this['show'] as $itemId=>$itemName) : ?>
                <option value="<?php echo $itemId; ?>"<?php if ($filters['show'] == $itemId) echo ' selected="selected"';?>><?php echo $itemName; ?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <?php if ($filters['show'] == 'updates') : ?>
        <div style="float:left;margin:5px;">
            <label for="blog-filter">De projet:</label><br />
            <select id="blog-filter" name="blog" onchange="document.getElementById('filter-form').submit();">
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
            <select id="blog-filter" name="blog" onchange="document.getElementById('filter-form').submit();">
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
    <table>
        <thead>
            <tr>
                <th><!-- published --></th>
                <th colspan="6"><?php echo Text::_("Titre"); ?></th> <!-- title -->
                <th><?php echo Text::_("Date"); ?></th> <!-- date -->
                <th>Auteur</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($post = $pagedResults->fetchPagedRow()) : ?>
            <tr>
                <td><?php if ($post->publish) echo '<strong style="color:#20b2b3;font-size:10px;">Publi&eacute;</sttrong>'; ?></td>
                <td colspan="6"><?php
                        $style = '';
                        if (isset($this['homes'][$post->id]))
                            $style .= ' font-weight:bold;';
                        if (empty($_SESSION['admin_node']) || $_SESSION['admin_node'] == \GOTEO_NODE) {
                            if (isset($this['footers'][$post->id]))
                                $style .= ' font-style:italic;';
                        }
                            
                      echo "<span style=\"{$style}\">{$post->title}</span>";
                ?></td>
                <td><?php echo $post->fecha; ?></td>
                <td><?php echo $post->user->name . ' (' . $post->owner_name . ')'; ?></td>
            </tr>
            <tr>
                <td><a href="/blog/<?php echo $post->id; ?>?preview=<?php echo $_SESSION['user']->id ?>" target="_blank">[Voir]</a></td>
                <td><?php if (($post->owner_type == 'node' && $post->owner_id == $node) || $node == \GOTEO_NODE) : ?>
                    <a href="/admin/blog/edit/<?php echo $post->id; ?>">[Editar]</a>
                <?php endif; ?></td>
                <td><?php if (isset($this['homes'][$post->id])) {
                        echo '<a href="/admin/blog/remove_home/'.$post->id.'" style="color:red;">[Retirer le couvercle]</a>';
                    } elseif ($post->publish) {
                        echo '<a href="/admin/blog/add_home/'.$post->id.'" style="color:blue;">[Mettez le couvercle]</a>';
                    } ?></td>
                <td><?php if (empty($_SESSION['admin_node']) || $_SESSION['admin_node'] == \GOTEO_NODE) {
                        if (isset($this['footers'][$post->id])) {
                            echo '<a href="/admin/blog/remove_footer/'.$post->id.'" style="color:red;">[Retirer de pied de page]</a>';
                        } elseif ($post->publish) {
                            echo '<a href="/admin/blog/add_footer/'.$post->id.'" style="color:blue;">[Ajouter au pied de page]</a>';
                        }
                    } ?></td>
                <td>
                <?php if ($translator && $node == \GOTEO_NODE) : ?><a href="/translate/post/edit/<?php echo $post->id; ?>" >[Traduire]</a><?php endif; ?>
                <?php if ($node != \GOTEO_NODE && $transNode && ($post->owner_type == 'node' && $post->owner_id == $node)) : ?><a href="/translate/node/<?php echo $node ?>/post/edit/<?php echo $post->id; ?>" target="_blank">[Traduire]</a><?php endif; ?>
                </td>
                <td><?php if (!$post->publish && (($post->owner_type == 'node' && $post->owner_id == $_SESSION['admin_node']) || !isset($_SESSION['admin_node']))) : ?>
                    <a href="/admin/blog/remove/<?php echo $post->id; ?>" onclick="return confirm('Vous voulez supprimer cet enregistrement?');">[Eliminar]</a>
                <?php endif; ?></td>
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
<p>Aucun r&eacute;sultat trouv&eacute;</p>
<?php endif; ?>
