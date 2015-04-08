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
    Goteo\Library\Template;

$list = $this['list'];

$templates = array(
    '33' => 'Newsletter',
    '35' => 'Test'
);

// por defecto cogemos la newsletter
$tpl = 33;

$template = Template::get($tpl);

?>
<div class="widget board">
    <p>S�lectionnez le mod�le. Le contenu traduit est utilis�, peut-�tre que vous voulez <a href="/admin/templates?group=massive" target="_blank">le revoir</a></p>
    <p><strong>NOTE:</strong> ce syst�me ne peut pas ajouter des variables dans le contenu, le m�me contenu est g�n�r� pour tous les destinataires<br/>
    Pour le contenu personnalis�, vous devez utiliser la fonctionnalit� <a href="/admin/mailing" >Communications</a>.</p>

    <form action="/admin/newsletter/init" method="post" onsubmit="return confirm('L'exp�dition sera activ� automatiquement, nous continuons?');">

    <p>
        <label>Mod�les massives: 
            <select id="template" name="template" >
            <?php foreach ($templates as $tplId=>$tplName) : ?>
                <option value="<?php echo $tplId; ?>" <?php if ( $tplId == $tpl) echo 'selected="selected"'; ?>><?php echo $tplName; ?></option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>
    <p>
        <label><input type="checkbox" name="test" value="1" checked="checked"/> C'est un test (une cible de test est envoy�)</label>
    </p>
        
    <p>
        <label><input type="checkbox" name="nolang" value="1" checked="checked"/>Seulement en espagnol (sans tenir compte utilisateur langue pr�f�r�e)</label>
    </p>
        
    <p>
        <input type="submit" name="init" value="Iniciar" />
    </p>

    </form>
</div>

<?php if (!empty($list)) : ?>
<div class="widget board">
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Date</th>
                <th>Question</th>
                <th></th>
                <th></th>
                <th></th>
                <th><!-- Si no ves --></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $item) : ?>
            <tr>
                <td><a href="/admin/newsletter/detail/<?php echo $item->id; ?>">[Detalles]</a></td>
                <td><?php echo $item->date; ?></td>
                <td><?php echo $item->subject; ?></td>
                <td><?php echo $item->active ? '<span style="color:green;font-weight:bold;">Activo</span>' : '<span style="color:red;font-weight:bold;">Inactivo</span>'; ?></td>
                <td><?php echo $item->bloqued ? 'Bloqueado' : ''; ?></td>
                <td><a href="<?php echo $item->link; ?>" target="_blank">[Si no ves]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
