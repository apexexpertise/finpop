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

$user = $this['user'];
$roles = $this['roles'];
$langs = $this['langs'];
?>
<div class="container-fluid">
    <section class="container">
		<div class="container-page">
<div class="widget">
    <table>
        <tr>
            <td width="140px"><p class="text-info">Nom d'utlisateur</p></td>
            <td><p class="text-muted"><a href="/user/profile/<?php echo $user->id ?>" target="_blank"><?php echo $user->name ?></a></p></td>
        </tr>
        <tr>
            <td><p class="text-info">Connexion acc&egrave;s</p></td>
            <td><p class="text-muted"><strong><?php echo $user->id ?></strong></p></td>
        </tr>
        <tr>
            <td><p class="text-info">Email</p></td>
            <td><p class="text-muted"><?php echo $user->email ?></p></td>
        </tr>
        <tr>
            <td><p class="text-info">Noeud</p></td>
            <td><p class="text-muted"><?php echo $this['nodes'][$user->node] ?></p></td>
        </tr>
        <tr>
            <td><p class="text-info">R&oacute;les actuels</p></td>
            <td><p class="text-muted">
                <?php
                foreach ($user->roles as $role=>$roleData) {
                    if (in_array($role, array('user', 'superadmin', 'root'))) {
                        echo '['.$roleData->name . ']&nbsp;&nbsp;';
                    } else {
                        // onclick="return confirm('Se le va a quitar el rol de <?php echo $roleData->name ? > a este usuario')"
                        ?>
                        [<a href="/admin/users/manage/<?php echo $user->id ?>/no<?php echo $role ?>" style="color:red;text-decoration:none;"><?php echo $roleData->name ?></a>]&nbsp;&nbsp;
                        <?php
                    }
                }
                ?>
                </p>
            </td>
        </tr>
        <tr>
            <td><p class="text-info">R&oacute;les disponibles</p></td>
            <td> <p class="text-muted">
                <?php
                foreach ($roles as $roleId=>$roleName) {
                    if (!in_array($roleId, array_keys($user->roles)) && !in_array($roleId, array('root', 'superadmin'))) {
                        // onclick="return confirm('Se le va a dar el rol de <?php echo $roleName ? > a este usuario')"
                        ?>
                        <a href="/admin/users/manage/<?php echo $user->id ?>/<?php echo $roleId ?>" style="text-decoration:none;">[<?php echo $roleName ?>]</a>&nbsp;&nbsp;
                        <?php
                    }
                }
                ?>
                </p>
            </td>
        </tr>
        <tr>
            <td><p class="text-info">Statut du compte</p></td>
            <td> <p class="text-muted">
                <?php if ($user->active) : ?>
                    <a href="<?php echo "/admin/users/manage/{$user->id}/ban"; ?>" style="text-decoration:none;font-weight:bold;">Active</a>
                <?php else : ?>
                    <a href="<?php echo "/admin/users/manage/{$user->id}/unban"; ?>" style="text-decoration:none;font-weight:bold;">Inactive</a>
                <?php endif; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td><p class="text-info">Visibilit&eacute;</p></td>
            <td> <p class="text-muted">
                <?php if (!$user->hide) : ?>
                    <a href="<?php echo "/admin/users/manage/{$user->id}/hide"; ?>" style="color:green;text-decoration:none;font-weight:bold;">Visible</a>
                <?php else : ?>
                    <a href="<?php echo "/admin/users/manage/{$user->id}/show"; ?>" style="color:red;text-decoration:none;font-weight:bold;">Cach&eacute;</a>
                <?php endif; ?>
                </p>
            </td>
        </tr>
    </table>
</div>
<div class="widget board">
    <ul>
        <li><a href="/admin/users/edit/<?php echo $user->id; ?>" class="btn btn-link">[Changer email / mot de passe]</a></li>
        <li><a href="/admin/users/move/<?php echo $user->id; ?>" class="btn btn-link">[D&eacute;placer vers un autre noeud]</a></li>
        <li><a href="/admin/users/impersonate/<?php echo $user->id; ?>" class="btn btn-link">[Remplacer]</a></li>
        <?php if (isset($_SESSION['admin_menu']['projects']['options']['accounts'])) : ?>
        <li><a href="/admin/accounts/add/?user=<?php echo $user->id; ?>" class="btn btn-link">[R&eacute;diger contribution]</a></li>
        <?php endif; ?>
        <li><a href="/admin/<?php echo (isset($_SESSION['admin_node'])) ? 'invests' : 'accounts'; ?>/?name=<?php echo $user->email; ?>" class="btn btn-link">[Historique de contributions]</a></li>
        <li><a href="/admin/sended/?user=<?php echo urlencode($user->email); ?>" class="btn btn-link">[Hsitorique d'&eacute;xp&eacute;dition]</a></li>
    </ul>




</div>

<?php if (isset($user->roles['translator'])) : ?>
<div class="widget board">
    <h3>Idiomas de traductor</h3>
    <?php if (empty($user->translangs)) : ?><p style="font-weight: bold; color:red;">Vous n'avez pas de langue publique affect&eacute;!</p><?php endif; ?>
    <form method="post" action="/admin/users/translang">
        <input type="hidden" name="user" value="<?php echo $user->id; ?>" />
        <table>
            <?php foreach ($langs as $lang) :
                $chkckd = (isset($user->translangs[$lang->id])) ? ' checked="checked"' : '';
                ?>
            <tr>
                <td><label><input type="checkbox" name="lang_<?php echo $lang->id; ?>" value="<?php echo $lang->id; ?>"<?php echo $chkckd; ?>/> <?php echo $lang->name; ?></label></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" value="Appliquer">
    </form>
</div>
<?php endif; ?>
</div>
</section>
</div>
