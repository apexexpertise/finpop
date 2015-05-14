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
<div class="container">
		<div class="row">
		<div class="col-md-12 column">
 <div class="title-admin">
<p >Bulletin  </p>
		<hr />
		</div>
		<p class="text-primary"><?php echo utf8_encode("S�lectionnez le mod�le. Le contenu traduit est utilis�, peut-�tre que vous voulez ") ?><a href="/admin/templates?group=massive" target="_blank" class="link">le revoir</a></p>
    <p class="text-info"><strong>NOTE:</strong> </p><p class="text-primary"><?php echo utf8_encode("ce syst�me ne peut pas ajouter des variables dans le contenu, le m�me contenu est g�n�r� pour tous les destinataires<br/>
    Pour le contenu personnalis�, vous devez utiliser la fonctionnalit�  ") ?><a href="/admin/mailing" class="link">Communications</a>.</p>
 
<div class="widget board">
<div class="form-group col-lg-6">
    
    <form action="/admin/newsletter/init" method="post" onsubmit="return confirm(<?php echo utf8_encode("L'exp�dition sera activ� automatiquement, nous continuons?") ?>);">

    <p>
        <label>Mod&egrave;les massives: 
            <select id="template" name="template" class="form-control">
            <?php foreach ($templates as $tplId=>$tplName) : ?>
                <option value="<?php echo $tplId; ?>" <?php if ( $tplId == $tpl) echo 'selected="selected"'; ?>><?php echo $tplName; ?></option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>
    <p>
        <label><input type="checkbox" name="test" value="1" checked="checked"/> <?php echo utf8_encode("C'est un test (une cible de test est envoy�)") ?></label>
    </p>
        
    <p>
        <label><input type="checkbox" name="nolang" value="1" checked="checked"/><?php echo utf8_encode("Seulement en espagnol (sans tenir compte utilisateur langue pr�f�r�e)") ?></label>
    </p>
        
    <p>
        <input type="submit" name="init" value="Initialiser" class="btn btn-primary" style="float:right"/>
    </p>

    </form>
</div>
</div>
<?php if (!empty($list)) : ?>
<div class="widget board">
    <table class="table table-hover">
        <thead>
            <tr class="active">
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
                <td><a href="/admin/newsletter/detail/<?php echo $item->id; ?>">[Details]</a></td>
                <td><?php echo $item->date; ?></td>
                <td><?php echo $item->subject; ?></td>
                <td><?php echo $item->active ? '<span style="color:green;font-weight:bold;">Activ&eacute;</span>' : '<span style="color:red;font-weight:bold;">Inactivo</span>'; ?></td>
                <td><?php echo $item->bloqued ? 'Bloqueado' : ''; ?></td>
                <td><a href="<?php echo $item->link; ?>" target="_blank">[Si vous ne voyez pas]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

</div>
</div>
</div>