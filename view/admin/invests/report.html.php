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


use Goteo\Library\Text;

$project = $this['project'];
$Data = $this['reportData'];

$desglose = array();
$goteo    = array();
$proyecto = array();
$estado   = array();
$usuario  = array();

$users = array();
foreach ($this['users'] as $user) {
    $amount = $users[$user->user]->amount + $user->amount;
    $users[$user->user] = (object) array(
        'name'   => $user->name,
        'user'   => $user->user,
        'amount' => $amount
    );
}

uasort($this['users'],
    function ($a, $b) {
        if ($a->name == $b->name) return 0;
        return ($a->name > $b->name) ? 1 : -1;
        }
    );

// recorremos los aportes
foreach ($this['invests'] as $invest) {

// para cada metodo acumulamos desglose, comision * 0.08, pago * 0.092
    $desglose[$invest->method] += $invest->amount;
    $goteo[$invest->method] += ($invest->amount * 0.08);
    $proyecto[$invest->method] += ($invest->amount * 0.92);
// para cada estado
    $estado[$invest->status]['total'] += $invest->amount;
    $estado[$invest->status][$invest->method] += $invest->amount;
// para cada usuario
    $usuario[$invest->user->id]['total'] += $invest->amount;
    $usuario[$invest->user->id][$invest->method] += $invest->amount;
// por metodo
    $usuario[$invest->method]['users'][$invest->user->id] = 1;
    $usuario[$invest->method]['invests']++;

}

?>
<style type="text/css">
    td {padding: 3px 10px;}
</style>
<div class="widget report">
    <p>Rapport financement des <strong><?php echo $project->name ?></strong> du jour <?php echo date('d-m-Y') ?></p>
    <p>Il se trouve dans l&apos;&eacute;tat <strong><?php echo $this['status'][$project->status] ?></strong>
        <?php if ($project->round > 0) : ?>
            , en <?php echo $project->round . 'Âª tour' ?> et nous obtenons <strong><?php echo $project->days ?> journeacute;es</strong> mettre fin &apos; la
        <?php endif; ?>
        .</p>
    <p>Le projet a un <strong>co&ucirc;t minimum de <?php echo \amount_format($project->mincost) ?> &euro;</strong>, un co&ucirc;t  <strong>optimal de <?php echo \amount_format($project->maxcost) ?> &euro;</strong> et m&egrave;ne maintenant <strong>atteint <?php echo \amount_format($project->amount) ?> &euro;</strong>, repr&eacute;sentant un <strong><?php echo \amount_format(($project->amount / $project->mincost * 100), 2, ',', '') . '%' ?></strong> au minimum.</p>

    <h3 class="text-success"><?php echo Text::_("Contributions Rapport"); ?></h3>
    <p style="font-style:italic;"><?php echo Text::_("Montant brut (non pris en compte par les ex&eacute;cutions ou les frais)"); ?></p>

    <h4><?php echo Text::_("par le destinataire"); ?></h4>
    <table class="table table-hover">
        <tr class="active">
            <th><?php echo Text::_("m&eacute;thode"); ?></th>
            <th><?php echo Text::_("quantit&eacute;"); ?></th>
            <th>Finpop</th>
            <th><?php echo Text::_("projet"); ?></th>
        </tr>
        <tr >
            <td>PayPal</td>
            <td style="text-align:right;"><?php echo \amount_format($desglose['paypal']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($goteo['paypal'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($proyecto['paypal'], 2) ?></td>
        </tr>
        <tr>
            <td>Tpv</td>
            <td style="text-align:right;"><?php echo \amount_format($desglose['tpv']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($goteo['tpv'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($proyecto['tpv'], 2) ?></td>
        </tr>
        <tr>
            <td>Cash</td>
            <td style="text-align:right;"><?php echo \amount_format($desglose['cash']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($goteo['cash'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($proyecto['cash'], 2) ?></td>
        </tr>
        <tr>
            <td>TOTAL</td>
            <td style="text-align:right;"><?php echo \amount_format(($desglose['paypal'] + $desglose['tpv'] + $desglose['cash']), 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format(($goteo['paypal'] + $goteo['tpv'] + $goteo['cash']), 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format(($proyecto['paypal'] + $proyecto['tpv'] + $proyecto['cash']), 2) ?></td>
        </tr>
    </table>

    <h4><?php echo Text::_("Par l&apos;&eacute;tat"); ?></h4>
    <table class="table table-hover">
        <tr class="active">
            <th><?php echo Text::_("&eacute;tat"); ?></th>
            <th><?php echo Text::_("quantit&eacute;"); ?></th>
            <th>PayPal</th>
            <th>Tpv</th>
            <th>Cash</th>
        </tr>
        <?php foreach ($this['investStatus'] as $id=>$label) : if (in_array($id, array('-1', '2', '4'))) continue;?>
        <tr>
            <td><?php echo $label ?></td>
            <td style="text-align:right;"><?php echo \amount_format($estado[$id]['total']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($estado[$id]['paypal']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($estado[$id]['tpv']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($estado[$id]['cash']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h4><?php echo Text::_("Par cofinancement"); ?> (<?php echo count($this['users']) ?>)</h4>
    <table  class="table table-hover">
        <tr class="active">
            <th><?php echo Text::_("utilisateur"); ?></th>
            <th><?php echo Text::_("quantit&eacute;"); ?></th>
            <th>PayPal</th>
            <th>Tpv</th>
            <th>Cash</th>
        </tr>
        <?php foreach ($this['users'] as $user) : ?>
        <tr>
            <td><?php echo $user->name ?></td>
            <td style="text-align:right;"><?php echo \amount_format($user->amount, 0) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($usuario[$user->user]['paypal']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($usuario[$user->user]['tpv']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($usuario[$user->user]['cash']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<!-- informaciÃ³n detallada apra tratar transferencias a proyectos -->
<a name="detail">&nbsp;</a>
<div class="widget report">
    <h3 class="text-success"><?php echo Text::_("Rapport de transactions r&eacute;ussies"); ?></h3>
    <p style="font-style:italic;"><?php echo Text::_("Aucun incident sont pris en compte dans le d&eacute;compte des utilisateurs / transactions ou montants ou frais ou net."); ?></p>

<?php if (!empty($Data['tpv'])) : ?>
    <h4>TPV</h4>
    <table class="table table-hover">
        <tr class="active">
            <th></th>
            <th><?php echo Text::_("1er Tour"); ?></th>
            <th><?php echo Text::_("2&eacute;me Tour"); ?></th>
            <th>Total</th>
            <th></th>
        </tr>
        <tr>
            <th>utilisateurs Nº</th>
            <td style="text-align:right;"><?php echo count($Data['tpv']['first']['users']) ?></td>
            <td style="text-align:right;"><?php echo count($Data['tpv']['second']['users']) ?></td>
            <td style="text-align:right;"><?php echo count($Data['tpv']['total']['users']) ?></td>
            <td></td>
        </tr>
        <tr>
            <th>op&eacute;rations Nº</th>
            <td style="text-align:right;"><?php echo $Data['tpv']['first']['invests'] ?></td>
            <td style="text-align:right;"><?php echo $Data['tpv']['second']['invests'] ?></td>
            <td style="text-align:right;"><?php echo $Data['tpv']['total']['invests'] ?></td>
            <td></td>
        </tr>
        <tr>
            <th>montant</th>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['first']['amount']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['second']['amount']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['total']['amount']) ?></td>
            <td></td>
        </tr>
        <tr>
            <?php
            $Data['tpv']['first']['fee']  = $Data['tpv']['first']['amount']  * 0.008;
            $Data['tpv']['second']['fee'] = $Data['tpv']['second']['amount'] * 0.008;
            $Data['tpv']['total']['fee']  = $Data['tpv']['total']['amount']  * 0.008;
            ?>
            <th>commission</th>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['first']['fee'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['second']['fee'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['total']['fee'], 2) ?></td>
            <td>0,80% de chaque opération bancaire</td>
        </tr>
        <tr>
            <?php
            $Data['tpv']['first']['net']  = $Data['tpv']['first']['amount']  - $Data['tpv']['first']['fee'];
            $Data['tpv']['second']['net'] = $Data['tpv']['second']['amount'] - $Data['tpv']['second']['fee'];
            $Data['tpv']['total']['net']  = $Data['tpv']['total']['amount']  - $Data['tpv']['total']['fee'];
            ?>
            <th>Net</th>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['first']['net'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['second']['net'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['total']['net'], 2) ?></td>
            <td></td>
        </tr>
        <tr>
            <?php
            $Data['tpv']['first']['goteo']  = $Data['tpv']['first']['net']  * 0.08;
            $Data['tpv']['second']['goteo'] = $Data['tpv']['second']['net'] * 0.08;
            $Data['tpv']['total']['goteo']  = $Data['tpv']['total']['net']  * 0.08;
            ?>
            <th>Goteo</th>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['first']['goteo'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['second']['goteo'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['total']['goteo'], 2) ?></td>
            <td><?php echo Text::_("8% net"); ?></td>
        </tr>
        <tr>
            <?php
            $Data['tpv']['first']['project']  = $Data['tpv']['first']['net']  - $Data['tpv']['first']['goteo'];
            $Data['tpv']['second']['project'] = $Data['tpv']['second']['net'] - $Data['tpv']['second']['goteo'];
            $Data['tpv']['total']['project']  = $Data['tpv']['total']['net']  - $Data['tpv']['total']['goteo'];
            ?>
            <th><?php echo Text::_("Proyecto"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['first']['project'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['second']['project'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['tpv']['total']['project'], 2) ?></td>
            <td><?php echo Text::_("92% net"); ?></td>
        </tr>
    </table>
<?php endif; ?>

<?php if (!empty($Data['paypal'])) : ?>
    <h4>PayPal</h4>
    <table class="table table-hover">
        <tr class="active">
            <th></th>
            <th><?php echo Text::_("1er Tour"); ?></th>
            <th><?php echo Text::_("2&eacute;me Tour"); ?></th>
            <th>Total</th>
            <th></th>
        </tr>
        <tr>
            <th>utilisateurs Nº</th>
            <td style="text-align:right;"><?php echo count($Data['paypal']['first']['users']) ?></td>
            <td style="text-align:right;"><?php echo count($Data['paypal']['second']['users']) ?></td>
            <td style="text-align:right;"><?php echo count($Data['paypal']['total']['users']) ?></td>
            <td><?php echo Text::_("Aucun incident"); ?></td>
        </tr>
        <tr>
            <th>op&eacute;rations Nº</th>
            <td style="text-align:right;"><?php echo $Data['paypal']['first']['invests'] ?></td>
            <td style="text-align:right;"><?php echo $Data['paypal']['second']['invests'] ?></td>
            <td style="text-align:right;"><?php echo $Data['paypal']['total']['invests'] ?></td>
            <td><?php echo Text::_("Aucun incident"); ?></td>
        </tr>
        <tr>
            <th><?php echo Text::_("difficult&eacute;s "); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['first']['fail']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['second']['fail']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['total']['fail']) ?></td>
            <td></td>
        </tr>
        <tr>
            <?php
            $Data['paypal']['first']['ok']  = $Data['paypal']['first']['amount']  - $Data['paypal']['first']['fail'];
            $Data['paypal']['second']['ok'] = $Data['paypal']['second']['amount'] - $Data['paypal']['second']['fail'];
            $Data['paypal']['total']['ok']  = $Data['paypal']['total']['amount']  - $Data['paypal']['total']['fail'];
            ?>
            <th><?php echo Text::_("Montant"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['first']['ok']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['second']['ok']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['total']['ok']) ?></td>
            <td><?php echo Text::_("Pr&eacute;-approbation ex&eacute;cut&eacute;e correctement"); ?></td>
        </tr>
        <tr>
            <?php
            $Data['paypal']['first']['goteo']  = $Data['paypal']['first']['ok'] * 0.08;
            $Data['paypal']['second']['goteo'] = $Data['paypal']['second']['ok'] * 0.08;
            $Data['paypal']['total']['goteo']  = $Data['paypal']['total']['ok'] * 0.08;
            ?>
            <th>Goteo</th>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['first']['goteo'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['second']['goteo'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['total']['goteo'], 2) ?></td>
            <td><?php echo Text::_("8% des proc&eacute;dures correctes"); ?></td>
        </tr>
        <tr>
            <?php
            $Data['paypal']['first']['project']  = $Data['paypal']['first']['ok']  - $Data['paypal']['first']['goteo'];
            $Data['paypal']['second']['project'] = $Data['paypal']['second']['ok'] - $Data['paypal']['second']['goteo'];
            $Data['paypal']['total']['project']  = $Data['paypal']['total']['ok']  - $Data['paypal']['total']['goteo'];
            ?>
            <th><?php echo Text::_("Proyecto"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['first']['project'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['second']['project'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['total']['project'], 2) ?></td>
            <td><?php echo Text::_("92% des proc&eacute;dures correctes"); ?></td>
        </tr>
        <tr>
            <?php
            $Data['paypal']['first']['fee_goteo']  = ($Data['paypal']['first']['invests'] * 0.35) + ($Data['paypal']['first']['goteo'] * 0.034);
            $Data['paypal']['second']['fee_goteo'] = ($Data['paypal']['second']['invests'] * 0.35) + ($Data['paypal']['second']['goteo'] * 0.034);
            $Data['paypal']['total']['fee_goteo']  = ($Data['paypal']['total']['invests'] * 0.35) + ($Data['paypal']['total']['goteo'] * 0.034);
            ?>
            <th><?php echo Text::_("Fais a FinPop"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['first']['fee_goteo'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['second']['fee_goteo'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['total']['fee_goteo'], 2) ?></td>
            <td><?php echo Text::_("Op&eacute;ration 0,35 + 3,4% de goutte à goutte (8% de r&eacute;ponses correctes)"); ?></td>
        </tr>
        <tr>
            <?php
            $Data['paypal']['first']['fee_project']  = ($Data['paypal']['first']['invests'] * 0.35) + ($Data['paypal']['first']['project'] * 0.034);
            $Data['paypal']['second']['fee_project'] = ($Data['paypal']['second']['invests'] * 0.35) + ($Data['paypal']['second']['project'] * 0.034);
            $Data['paypal']['total']['fee_project']  = ($Data['paypal']['total']['invests'] * 0.35) + ($Data['paypal']['total']['project'] * 0.034);
            ?>
            <th><?php echo Text::_("Frais de Promoteur"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['first']['fee_project'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['second']['fee_project'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['total']['fee_project'], 2) ?></td>
            <td><?php echo Text::_("Op&eacute;ration 0,35 + 3,4% import&eacute; du projet (8% de r&eacute;ponses correctes)"); ?></td>
        </tr>
        <tr>
            <?php
            $Data['paypal']['first']['net_goteo']  = $Data['paypal']['first']['goteo']  - $Data['paypal']['first']['fee_goteo'];
            $Data['paypal']['second']['net_goteo'] = $Data['paypal']['second']['goteo'] - $Data['paypal']['second']['fee_goteo'];
            $Data['paypal']['total']['net_goteo']  = $Data['paypal']['total']['goteo']  - $Data['paypal']['total']['fee_goteo'];
            ?>
            <th><?php echo Text::_("Net FinPop"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['first']['net_goteo'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['second']['net_goteo'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['total']['net_goteo'], 2) ?></td>
            <td></td>
        </tr>
        <tr>
            <?php
            $Data['paypal']['first']['net_project']  = $Data['paypal']['first']['project']  - $Data['paypal']['first']['fee_project'];
            $Data['paypal']['second']['net_project'] = $Data['paypal']['second']['project'] - $Data['paypal']['second']['fee_project'];
            $Data['paypal']['total']['net_project']  = $Data['paypal']['total']['project']  - $Data['paypal']['total']['fee_project'];
            ?>
            <th><?php echo Text::_("Neto Proyecto"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['first']['net_project'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['second']['net_project'], 2) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['paypal']['total']['net_project'], 2) ?></td>
            <td></td>
        </tr>
    </table>
<?php endif; ?>

<?php if (!empty($Data['cash'])) : ?>
    <h4>CASH</h4>
    <?php
        $users_ok = count($usuarios['cash']['users']);
        $invests_ok = $usuarios['cash']['invests'];
        $incidencias = 0;
        $correcto = $desglose['cash'] - $incidencias;
    ?>
    <table class="table table-hover">
        <tr class="active">
            <th></th>
            <th><?php echo Text::_("1er tour"); ?></th>
            <th><?php echo Text::_("2&eacute;me tour"); ?></th>
            <th>Total</th>
            <th></th>
        </tr>
        <tr>
            <th><?php echo Text::_("utilisateurs Nº"); ?></th>
            <td style="text-align:right;"><?php echo count($Data['cash']['first']['users']) ?></td>
            <td style="text-align:right;"><?php echo count($Data['cash']['second']['users']) ?></td>
            <td style="text-align:right;"><?php echo count($Data['cash']['total']['users']) ?></td>
            <td></td>
        </tr>
        <tr>
            <th><?php echo Text::_("op&eacute;ration Nº"); ?></th>
            <td style="text-align:right;"><?php echo $Data['cash']['first']['invests'] ?></td>
            <td style="text-align:right;"><?php echo $Data['cash']['second']['invests'] ?></td>
            <td style="text-align:right;"><?php echo $Data['cash']['total']['invests'] ?></td>
            <td></td>
        </tr>
        <tr>
            <th><?php echo Text::_("difficult&eacute;"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['cash']['first']['fail']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['cash']['second']['fail']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['cash']['total']['fail']) ?></td>
            <td><?php echo Text::_("Contributions par PayPal, POS ou d&apos;immobilisations irrigation"); ?></td>
        </tr>
        <tr>
            <th><?php echo Text::_("Correcto"); ?></th>
            <td style="text-align:right;"><?php echo \amount_format($Data['cash']['first']['amount']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['cash']['second']['amount']) ?></td>
            <td style="text-align:right;"><?php echo \amount_format($Data['cash']['total']['amount']) ?></td>
            <td><?php echo Text::_("Tr&eacute;sorerie pr&eacute;c&eacute;dentes contributions &agrave; la campagne"); ?></td>
        </tr>
    </table>
<?php endif; ?>

<?php if (!empty($Data['note'])) : ?>
    <h4><?php echo Text::_("Remarques"); ?></h4>
    <p><?php echo implode('<br />- ', $Data['note']) ?></p>
<?php endif; ?>
</div>