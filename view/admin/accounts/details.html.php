<?php
/*
 *  Copyright (C) 2012 Platoniq y FundaciÃ³n Fuentes Abiertas (see README for details)
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
    Goteo\Library\Paypal,
    Goteo\Library\Tpv;

$invest = $this['invest'];
$project = $this['project'];
$calls = $this['calls'];
$droped = $this['droped'];
$user = $this['user'];

$rewards = $invest->rewards;
array_walk($rewards, function (&$reward) { $reward = $reward->reward; });
?>
<div class="widget board">
<a href="/admin/accounts/update/<?php echo $invest->id ?>" class="btn btn-default" style="color:white" onclick="return confirm(<?php echo utf8_encode("Voulez vous changer l'état de cette entrée?") ?>)" >Changer l'etat</a>
&nbsp;&nbsp;&nbsp;
<a href="/admin/rewards/edit/<?php echo $invest->id ?>" class="btn btn-info" style="color:white"><?php echo utf8_encode("Gérer la recompense/l'adresse") ?></a>
<?php if ($invest->issue) : ?>
&nbsp;&nbsp;&nbsp;
<a href="/admin/accounts/solve/<?php echo $invest->id ?>" class="btn btn-default" style="color:white" onclick="return confirm(<?php echo utf8_encode("Ce probléme sera considéré résolu.La transcaction sera annulé et la contribution se transformira en argent et son état sera changer. Voulez vous continuez ?") ?>)" class="btn btn-info" style="color:white"><?php echo utf8_encode("Nous avons fait le transfert") ?></a>
<?php endif; ?>
</div>
<div class="widget board">

    <label>
       <?php echo Text::_("Projet"); ?></label> <?php echo $project->name ?> (<?php echo $this['status'][$project->status] ?>) <br/>
       <label> <?php echo Text::_("Utilisateur"); ?>: </label><?php echo $user->name ?> [<?php echo $user->email ?>]
  
    <p>
        <?php if ($invest->status < 1 || ($invest->method == 'tpv' && $invest->status < 2) ||($invest->method == 'cash' && $invest->status < 2)) : ?>
        <a href="/admin/accounts/cancel/<?php echo $invest->id ?>" class="btn btn-info" style="color:white;margin-top:20px"
            onclick="return confirm(<?php echo utf8_encode("Voulez vous vraiment annuler cette contribution et cette approbation préalable?") ?>);"
            class="btn btn-info" style="color:white;margin-top:20px"><?php echo utf8_encode("Annuler cette contribution") ?></a>&nbsp;&nbsp;&nbsp;
        <?php endif; ?>

        <?php if ($invest->method == 'paypal' && $invest->status == 0) : ?>
        <a href="/admin/accounts/execute/<?php echo $invest->id ?>"
            onclick="return confirm(<?php echo utf8_encode("Voulez vous maintenant géré par l'approbation préalable?") ?>);"
            class="btn btn-info" style="color:white;margin-top:15px"><?php echo utf8_encode("Exécutez maintenant") ?></a>
        <?php endif; ?>

        <?php if ($invest->method != 'paypal' && $invest->status == 1) : ?>
        <a href="/admin/accounts/move/<?php echo $invest->id ?>"  class="btn btn-info" style="color:white;margin-top:15px"><?php echo utf8_encode("Repérez cette contribution") ?></a>
        <?php endif; ?>

        <?php if (!$invest->resign && $invest->status == 1 && $invest->status == 3) : ?>
        <a href="/admin/accounts/resign/<?php echo $invest->id ?>/?token=<?php echo md5('resign'); ?>"  class="btn btn-info" style="color:white;margin-top:15px"><?php echo utf8_encode("c'est don") ?></a>
        <?php endif; ?>
    </p>
    
    <center><h3><?php echo Text::_("Details de la transaction"); ?></h3> </center>
    <dl>
        <dt><?php echo Text::_("Montant de la contribution"); ?>:</dt>
        <dd><?php echo $invest->amount ?> &euro;
            <?php
                if (!empty($invest->campaign))
                    echo Text::_("CampaÃ±a: ") . $campaign->name;
            ?>
        </dd>
    </dl>

    <dl>
        <dt><?php echo Text::_("&Eacute;tat"); ?>:</dt>
        <dd><?php echo $this['investStatus'][$invest->status]; if ($invest->status < 0) echo ' <span style="font-weight:bold; color:red;">OJO! que este aporte no fue confirmado.<span>'; if ($invest->issue) echo ' <span style="font-weight:bold; color:red;">INCIDENCIA!<span>'; ?></dd>
    </dl>

    <dl>
        <dt><?php echo Text::_("Date de contribution"); ?>:</dt>
        <dd><?php echo $invest->invested . '  '; ?>
            <?php
                if (!empty($invest->charged))
                    echo Text::_("Cargo ejecutado el: ") . $invest->charged;

                if (!empty($invest->returned))
                    echo Text::_("Dinero devuelto el: ") . $invest->returned;
            ?>
        </dd>
    </dl>

    <dl>
        <dt><?php echo Text::_("donation"); ?>:</dt>
        <dd>
            <?php echo ($invest->resign) ? Text::_('SI') : Text::_('NO'); ?>
        </dd>
    </dl>

    <dl>
        <dt><?php echo Text::_("Mode de paiement"); ?>:</dt>
        <dd><?php echo $invest->method . '   '; ?>
            <?php
                if (!empty($invest->campaign))
                    echo '<br />'.Text::_('Capital riego');

                if (!empty($invest->anonymous))
                    echo '<br />'.Text::_('Aporte anÃ³nimo');

                if (!empty($invest->resign))
                    echo "<br />".Text::_('Donativo de').": {$invest->address->name} [{$invest->address->nif}]";

                if (!empty($invest->admin))
                    echo '<br />'.Text::_('Manual generado por admin').': '.$invest->admin;
            ?>
        </dd>
    </dl>

    <dl>
        <dt><?php echo Text::_("Codes de suivi"); ?>: <a href="/admin/invests/details/<?php echo $invest->id ?>"><?php echo Text::_(" Aller &agrave; la contribution"); ?></a></dt>
        <dd><?php
                if (!empty($invest->preapproval)) {
                    echo 'Preapproval: '.$invest->preapproval . '   ';
                }

                if (!empty($invest->payment)) {
                    echo 'Cargo: '.$invest->payment . '   ';
                }
            ?>
        </dd>
    </dl>

    <?php if (!empty($invest->rewards)) : ?>
    <dl>
        <dt><?php echo Text::_("Recompensas elegidas"); ?>:</dt>
        <dd>
            <?php echo implode(', ', $rewards); ?>
        </dd>
    </dl>
    <?php endif; ?>

    <dl>
        <dt><?php echo Text::_("Adresse"); ?>:</dt>
        <dd>
            <?php echo $invest->address->address; ?>,
            <?php echo $invest->address->location; ?>,
            <?php echo $invest->address->zipcode; ?>
            <?php echo $invest->address->country; ?>
        </dd>
    </dl>

    <?php if ($invest->method == 'paypal') : ?>
        <?php if (!isset($_GET['full'])) : ?>
        <p>
            <a href="/admin/accounts/details/<?php echo $invest->id; ?>/?full=show"><?php echo Text::_("Mostrar detalles tÃ©cnicos"); ?></a>
        </p>
        <?php endif; ?>

        <?php if (!empty($invest->transaction)) : ?>
        <dl>
            <dt><strong><?php echo Text::_("D&eacute;tails de retour"); ?>:</strong></dt>
            <dd><?php echo Text::_("Vous devriez aller au panneau paypal pour afficher les d&eacute;tails d&apos;un retour"); ?></dd>
        </dl>
        <?php endif ?>
    <?php elseif ($invest->method == 'tpv') : ?>
        <p><?php echo Text::_("Vous devriez aller dans le panneau de la banque pour voir les d&eacute;tails des contributions par TPV."); ?></p>
    <?php else : ?>
        <p><?php echo Text::_("Rien &apos; voir avec la saisie manuelle."); ?></p>
    <?php endif ?>

    <?php if (!empty($droped)) : ?>
    <h3><?php echo Text::_("Capital de risque associ&eacute;"); ?></h3>
    <dl>
        <dt><?php echo Text::_("Capital de risque associ&eacute;"); ?>:</dt>
        <dd><?php echo $calls[$droped->call] ?></dd>
    </dl>
    <a href="/admin/invests/details/<?php echo $droped->id ?>" target="_blank"><?php echo Text::_("Ver aporte completo de riego"); ?></a>
    <?php endif; ?>

</div>

<div class="widget">
  <center><h3>Log</h3> </center>
    <?php foreach (\Goteo\Model\Invest::getDetails($invest->id) as $log)  {
        echo "{$log->date} : {$log->log} ({$log->type})<br />";
    } ?>
</div>

<?php if (isset($_GET['full']) && $_GET['full'] == 'show') : ?>
<div class="widget">
    <h3><?php echo Text::_("D&eacute;tails techniques de la transaction"); ?></h3>
    <?php if (!empty($invest->preapproval)) :
        $details = Paypal::preapprovalDetails($invest->preapproval);
        ?>
    <dl>
        <dt><strong><?php echo Text::_("D&eacute;tails d&apos;approbation pr&eacute;alable"); ?>:</strong></dt>
        <dd><?php echo \trace($details); ?></dd>
    </dl>
    <?php endif ?>

    <?php if (!empty($invest->payment)) :
        $details = Paypal::paymentDetails($invest->payment);
        ?>
    <dl>
        <dt><strong><?php echo Text::_("D&eacute;tails de chargement"); ?>:</strong></dt>
        <dd><?php echo \trace($details); ?></dd>
    </dl>
    <?php endif; ?>
</div>
<?php endif; ?>

