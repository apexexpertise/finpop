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
    Goteo\Library\Template;

//$templates = Template::getAllMini();
$templates = array(
    '11' => Text::_("Base"),
    '27' => Text::_("Avis &aacute; l'atelier")
);
// lista de destinatarios segun filtros recibidos, todos marcados por defecto
?>
<script type="text/javascript">
jQuery(document).ready(function ($) {

    $('#template_load').click(function () {
       if (confirm(Text::_("Le sujet et le contenu r&eacute;el est remplac&eacute; par celui du mod�le. Nous continuons?"))) {

           if ($('#template').val() == '0') {
            $('#mail_subject').val('');
            $('#mail_content').html('');
           }
            content = $.ajax({async: false, url: '<?php echo SITE_URL; ?>/ws/get_template_content/'+$('#template').val()}).responseText;
            var arr = content.split('#$#$#');
            $('#mail_subject').val(arr[0]);
            $('#mail_content').val(arr[1]);
        }
    });

});
</script>
<div class="widget">
    <p><?php echo Text::_("Les variables suivantes sont remplac&eacute;s dans le contenu:"); ?></p>
    <ul>
        <li><strong>%USERID%</strong><?php echo Text::_(" Pour acc&eacute;der &aacute; l'id du destinataire"); ?></li>
        <li><strong>%USEREMAIL%</strong><?php echo Text::_("Pour le destinataire de l'email"); ?></li>
        <li><strong>%USERNAME%</strong><?php echo Text::_(" Pour le nom du destinataire"); ?></li>
        <li><strong>%SITEURL%</strong><?php echo Text::_(" URL de cette plate-forme "); ?>(<?php echo SITE_URL ?>)</li>
        <?php if ($this['filters']['type'] == 'owner' || $this['filters']['type'] == 'investor') : ?>
            <li><strong>%PROJECTID%</strong><?php echo Text::_(" Pour l'id du projet"); ?></li>
            <li><strong>%PROJECTNAME%</strong><?php echo Text::_(" Pour le nom du projet"); ?></li>
            <li><strong>%PROJECTURL%</strong><?php echo Text::_(" Pour l'url du projet"); ?></li>
        <?php endif; ?>
    </ul>
</div>
<div class="widget">
    <p><?php echo Text::_("Nous communiquerons avec ") . $_SESSION['mailing']['filters_txt']; ?></p>
    <form action="/admin/mailing/send" method="post">
    <dl>
        <dt><?php echo Text::_("S&eacute;lectionnez un mod&eacute;le:"); ?></dt>
        <dd>
            <select id="template" name="template" >
                <option value="0"><?php echo Text::_("Sin plantilla"); ?></option>
            <?php foreach ($templates as $templateId=>$templateName) : ?>
                <option value="<?php echo $templateId; ?>"><?php echo $templateName; ?></option>
            <?php endforeach; ?>
            </select>
            <input type="button" id="template_load" value="<?php echo Text::_("Charger"); ?>" />
        </dd>
    </dl>
    <dl>
        <dt><?php echo Text::_("question:"); ?></dt>
        <dd>
            <input id="mail_subject" name="subject" value="<?php echo $_SESSION['mailing']['subject']?>" style="width:500px;"/>
        </dd>
    </dl>
    <dl>
        <dt><?php echo Text::_("Contenu: (dans le code html, les sauts de ligne doivent etre avec &lt;br /&gt;)"); ?></dt>
        <dd>
            <textarea id="mail_content" name="content" cols="100" rows="10"></textarea>
        </dd>
    </dl>
    <dl>
        <dt><?php echo Text::_("Destinataires de la liste:"); ?></dt>
        <dd>
            <ul>
                <?php foreach ($_SESSION['mailing']['receivers'] as $usrid=>$usr) : ?>
                <li>
                    <input type="checkbox"
                           name="receiver_<?php echo $usr->id; ?>"
                           id="receiver_<?php echo $usr->id; ?>"
                           value="1"
                           checked="checked" />
                    <label for="receiver_<?php echo $usr->id; ?>"><?php echo $usr->name.' ['.$usr->email.']'; if (!empty($usr->project)) echo ' Proyecto: <strong>'.$usr->project.'</strong>'; ?></label>
                </li>
                <?php endforeach; ?>
            </ul>
        </dd>
    </dl>

    <input type="submit" name="send" value="Envoyer"  onclick="return confirm(Text::_("Vous avez pass&eacute; le contenu en revue et v&eacute;rifi&eacute; les b&eacute;n&eacute;ficiaires?"));"/>

    </form>
</div>