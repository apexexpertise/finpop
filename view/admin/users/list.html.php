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

// paginacion
require_once 'library/pagination/pagination.php';

$filters = $this['filters'];
$users = $this['users'];

// la ordenación por cantidad y proyectos hay que hacerla aqui
if ($filters['order'] == 'amount') {
    uasort($users,
        function ($a, $b) {
            if ($a->namount == $b->namount) return 0;
            return ($a->namount < $b->namount) ? 1 : -1;
            }
        );
}
if ($filters['order'] == 'projects') {
    uasort($users,
        function ($a, $b) {
            if ($a->nprojs == $b->nprojs) return 0;
            return ($a->nprojs < $b->nprojs) ? 1 : -1;
            }
        );
}

$the_filters = '';
foreach ($filters as $key=>$value) {
    $the_filters .= "&{$key}={$value}";
}

$pagedResults = new \Paginated($users, 20, isset($_GET['page']) ? $_GET['page'] : 1);
?>
<a href="/admin/users/add" class="button">Cr&eacute;er un utilisateur</a>

<div class="widget board">
    <form id="filter-form" action="/admin/users" method="get">
        <table>
            <tr>
                <td>
                    <label for="role-filter">avec le r&oacute;le:</label><br />
                    <select id="role-filter" name="role" onchange="document.getElementById('filter-form').submit();">
                        <option value="">Tout r&oacute;le</option>
                    <?php foreach ($this['roles'] as $roleId=>$roleName) : ?>
                        <option value="<?php echo $roleId; ?>"<?php if ($filters['role'] == $roleId) echo ' selected="selected"';?>><?php echo $roleName; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <label for="interest-filter">Voir les utilisateurs int&eacute;ress&eacute;s par:</label><br />
                    <select id="interest-filter" name="interest" onchange="document.getElementById('filter-form').submit();">
                        <option value="">Tout int&eacute;ret</option>
                    <?php foreach ($this['interests'] as $interestId=>$interestName) : ?>
                        <option value="<?php echo $interestId; ?>"<?php if ($filters['interest'] == $interestId) echo ' selected="selected"';?>><?php echo $interestName; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <label for="role-filter">Afficher les utilisateurs avec le r&oacute;le:</label><br />
                    <select id="role-filter" name="role" onchange="document.getElementById('filter-form').submit();">
                        <option value="">Tout r&oacute;le</option>
                    <?php foreach ($this['roles'] as $roleId=>$roleName) : ?>
                        <option value="<?php echo $roleId; ?>"<?php if ($filters['role'] == $roleId) echo ' selected="selected"';?>><?php echo $roleName; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
                <td colspan="2">
                    <label for="name-filter">Par nom ou par e-mail:</label><br />
                    <input id="name-filter" name="name" value="<?php echo $filters['name']; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="filter" value="Chercher">
                </td>
                <td>
                    <label for="order-filter">Vue par:</label><br />
                    <select id="order-filter" name="order" onchange="document.getElementById('filter-form').submit();">
                    <?php foreach ($this['orders'] as $orderId=>$orderName) : ?>
                        <option value="<?php echo $orderId; ?>"<?php if ($filters['order'] == $orderId) echo ' selected="selected"';?>><?php echo $orderName; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>

    </form>
    <br clear="both" />
    <a href="/admin/users/?reset=filters">Retirer les filtres</a>
</div>

<div class="widget board">
<?php if ($filters['filtered'] != 'yes') : ?>
    <p>Vous avez besoin de mettre des filtres, trop de dossiers!</p>
<?php elseif (!empty($users)) : ?>
    <table>
        <thead>
            <tr>
                <th>Nom</th> <!-- view profile -->
                <th>Utilisateur</th>
                <th>Email</th>
                <th>Projet</th>
                <th>Quantit&eacute;</th>
                <th>Haut</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($user = $pagedResults->fetchPagedRow()) :
                $adminNode = ($user->admin) ? $user->admin_node : null;
                ?>
            <tr>
                <td><a href="/user/profile/<?php echo $user->id; ?>" target="_blank" <?php echo ($adminNode != 'goteo') ? 'style="color: green;" title="Admin nodo '.$adminNode.'"' : 'title="Voir le profil en public"'; ?>><?php echo substr($user->name, 0, 20); ?></a></td>
                <td><strong><?php echo substr($user->id, 0, 20); ?></strong></td>
                <td><a href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?></a></td>
                <td><?php echo $user->nprojs; ?></td>
                <td><?php echo \amount_format($user->namount); ?> &euro;</td>
                <td><?php echo $user->register_date; ?></td>
            </tr>
            <tr>
                <td><a href="/admin/users/manage/<?php echo $user->id; ?>" title="G&eacute;rer">[G&eacute;rer]</a></td>
                <td><?php if ($user->nprojs > 0) {
                    if (!isset($_SESSION['admin_node']) || (isset($_SESSION['admin_node']) && $user->node == $_SESSION['admin_node'])) : ?>
                <a href="/admin/accounts/?name=<?php echo $user->email; ?>" title="Voir ses apports">[Contributions]</a>
                <?php else:  ?>
                <a href="/admin/invests/?name=<?php echo $user->email; ?>" title="Voir ses apports">[Contributions]</a>
                <?php endif; } ?></td>
                <td colspan="5" style="color:blue;">
                    <?php echo (!$user->active && $user->hide) ? ' descendre ' : ''; ?>
                    <?php echo $user->active ? '' : ' inactif '; ?>
                    <?php echo $user->hide ? ' cach&eacute; ' : ''; ?>
                    <?php echo $user->checker ? ' r&eacute;viseur ' : ''; ?>
                    <?php echo $user->translator ? ' Traductor ' : ''; ?>
                    <?php echo $user->caller ? ' traducteur ' : ''; ?>
                    <?php echo $user->admin ? ' Admin ' : ''; ?>
                    <?php echo $user->manager ? ' directeur ' : ''; ?>
                    <?php echo $user->vip ? ' VIP ' : ''; ?>
                </td>
            </tr>
            <tr>
                <td colspan="6"><hr /></td>
            </tr>
            <?php endwhile; ?>
        </tbody>

    </table>
</div>
<ul id="pagination">
<?php   $pagedResults->setLayout(new DoubleBarLayout());
        echo $pagedResults->fetchPagedNavigation($the_filters); ?>
</ul>
<?php else : ?>
<p>PAS DE R&eacute;SULTAT</p>
<?php endif; ?>
