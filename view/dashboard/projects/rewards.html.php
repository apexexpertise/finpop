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

use Goteo\Core\View,
    Goteo\Library\Text,
    Goteo\Model\Project\Reward,
    Goteo\Model\Invest;

$icons = Reward::icons('individual');

$project = $this['project'];

$rewards = $this['rewards'];
// recompensas ordenadas por importe
uasort($rewards, function ($a, $b) {
        if ($a->amount == $b->amount) return 0;
        return ($a->amount > $b->amount) ? 1 : -1;
        }
    );

$invests = $this['invests'];

$filter = $this['filter']; // al ir mostrando, quitamos los que no cumplan
// pending = solo los que tienen alguna recompensa pendientes
// fulfilled = solo los que tienen todas las recompensas cumplidas
// resign = solo los que hicieron renuncia a recompensa

$order = $this['order'];
// segun order:
switch ($order) {
    case 'date': // fecha aporte, mas reciente primero
        uasort($invests, function ($a, $b) {
                if ($a->invested == $b->invested) return 0;
                return ($a->invested > $b->invested) ? -1 : 1;
                }
            );
        break;
    case 'user': // nombre de usuario alfabetico
        uasort($invests, function ($a, $b) {
                if ($a->user->name == $b->user->name) return 0;
                return ($a->user->name > $b->user->name) ? 1 : -1;
                }
            );
        break;
    case 'reward': // importe de recompensa, mÃ¡s bajo primero
        uasort($invests, function ($a, $b) {
                if (empty($a->rewards)) return 1;
                if ($a->rewards[0]->amount == $b->rewards[0]->amount) return 0;
                return ($a->rewards[0]->amount > $b->rewards[0]->amount) ? 1 : -1;
                }
            );
        break;
    case 'amount': // importe aporte, mÃ¡s alto primero
    default:
        uasort($invests, function ($a, $b) {
                if ($a->amount == $b->amount) return 0;
                return ($a->amount > $b->amount) ? -1 : 1;
                }
            );
        break;
}


?>
<div class="widget gestrew">
    <div class="message">
	Ceci est une visualisation des options de récomponses choisies par vos cofinanceurs.<br>
	Vous n'avez pas à gérer ces récomponses avent d'avoir atteint le financement minimum souhaité.
    </div>
    <div class="rewards">
        <?php $num = 1; 
            foreach ($rewards as $rewardId=>$rewardData) :
                $who = Invest::choosed($rewardData->id); ?>
            <div class="reward <?php if(($num % 4)==0)echo " last"?>">
            	<i class="fa fa-arrow-circle-o-right margin-right"></i>
                <span class="aporte">contributions <span class="num"><?php echo $rewardData->amount; ?></span> <span class="euro">€</span><i class="fa fa-arrows-h margin-right margin-left"></i></span>
                <span class="cofinanciadores">Finpopeurs <span class="num"><?php echo count($who); ?></span></span>
                <div class="tiporec"><ul><li class="<?php echo $rewardData->icon; ?>"><?php echo Text::recorta($rewardData->reward, 40); ?></li></ul></div>
                <div class="contenedorrecompensa">	
                	<span class="recompensa"><strong style="color:#666;">Récompense:</strong><br/> <?php echo Text::recorta($rewardData->description, 100); ?></span>
                </div>
                <a class="btn btn-default" onclick="msgto('<?php echo $rewardData->id; ?>')" ><i class="fa fa-paper-plane-o margin-right"></i>Message groupé</a>
            </div>
        <?php ++$num;
            endforeach; ?>
    </div>
</div>

<?php if (!empty($invests)) : ?>
<script type="text/javascript">
    function set(what, which) {
        document.getElementById('invests-'+what).value = which;
        document.getElementById('invests-filter-form').submit();
        return false;
    }
</script><div class="widget gestrew">
    <h2 class="title">Gérez le retour</h2>
    <a name="gestrew"></a>
   <form id="invests-filter-form" name="filter_form" action="<?php echo '/dashboard/projects/rewards/filter#gestrew'; ?>" method="post">
       <input type="hidden" id="invests-filter" name="filter" value="<?php echo $filter; ?>" />
       <input type="hidden" id="invests-order" name="order" value="<?php echo $order; ?>" />
   </form>
    <div class="filters">
        <label>Voir contributions : </label><br />
        <ul>			 
        	<li<?php if ($order == 'amount' || $order == '') echo ' class="current"'; ?>><a href="#" onclick="return set('order', 'amount');">Par montant</a></li>
            <li>|</li>
        	<li<?php if ($order == 'date') echo ' class="current"'; ?>><a href="#" onclick="return set('order', 'date');">par date</a></li>
            <li>|</li>
            <li<?php if ($order == 'user') echo ' class="current"'; ?>><a href="#" onclick="return set('order', 'user');">Par utilisateur</a></li>
            <li>|</li>
            <li<?php if ($order == 'reward') echo ' class="current"'; ?>><a href="#" onclick="return set('order', 'reward');">Par retour</a></li>
            <li>|</li>
            <li<?php if ($filter == 'pending') echo ' class="current"'; ?>><a href="#" onclick="return set('filter', 'pending');">En attente</a></li>
            <li>|</li>
            <li<?php if ($filter == 'fulfilled') echo ' class="current"'; ?>><a href="#" onclick="return set('filter', 'fulfilled');">réalisé</a></li>
            <li>|</li>
            <li<?php if ($filter == 'resign') echo ' class="current"'; ?>><a href="#" onclick="return set('filter', 'resign');">Les dons</a></li>
            <li>|</li>
            <li<?php if ($filter == '') echo ' class="current"'; ?>><a href="#" onclick="return set('filter', '');">Tous</a></li>
        </ul>
    </div>
    
    <div id="invests-list">
        <form name="invests_form" action="<?php echo '/dashboard/'.$this['section'].'/'.$this['option'].'/process'; ?>" method="post">
           <input type="hidden" name="filter" value="<?php echo $filter; ?>" />
           <input type="hidden" name="order" value="<?php echo $order; ?>" />
            <?php foreach ($invests as $investId=>$investData) :

                $address = $investData->address;
                $cumplida = true; //si nos encontramos una sola no cumplida, pasa a false
                $estilo = "disabled";
                foreach ($investData->rewards as $reward) {
                    if ($reward->fulfilled != 1) {
                        $estilo = "";
                        $cumplida = false;
                    }
                }

                // filtro
                if ($filter == 'pending' && $cumplida != false) continue;
                if ($filter == 'fulfilled' && $cumplida != true) continue;
                if ($filter == 'resign' && $investData->resign != true) continue;
                ?>
                
                <div class="investor">

                	<div class="left">
                        <a href="/user/<?php echo $investData->user->id; ?>"><img src="<?php echo $investData->user->avatar->getLink(45, 45, true); ?>" /></a>
                    </div>
                    
                    <div class="left" style="width:120px;">
						<span class="username"><a href="/user/<?php echo $investData->user->id; ?>"><?php echo $investData->user->name; ?></a></span>
                        <label class="amount">contribution<?php if ($investData->anonymous) echo ' <strong>'.  Text::get('regular-anonymous').'</strong>'; ?></label>
						<span class="amount"><?php echo $investData->amount; ?> </span>
                        <span class="date"><?php echo date('d-m-Y', strtotime($investData->invested)); ?></span>
                    </div>
                   
                    <div class="left recompensas"  style="width:280px;">
                     	<span style="margin-bottom:2px;" class="<?php echo $estilo;?>"><strong>Récompenses attendus:</strong></span>
                        <?php foreach ($investData->rewards as $reward) : ?>
                        <div style="width: 250px; overflow: hidden; height: 18px;" class="<?php echo $estilo;?>">
                        <input type="checkbox"  id="ful_reward-<?php echo $investId; ?>-<?php echo $reward->id; ?>" name="ful_reward-<?php echo $investId; ?>-<?php echo $reward->id; ?>" value="1" <?php if ($reward->fulfilled == 1) echo ' checked="checked" disabled';?>  />
                        <label for="ful_reward-<?php echo $investId; ?>-<?php echo $reward->id; ?>"><?php echo Text::recorta($reward->reward, 40); ?></label>
                        </div>
                        <?php endforeach; ?>

                    </div>
                    
					<div class="left" style="width:200px;padding-right:30px;">
						<span style="margin-bottom:2px;" class="<?php echo $estilo;?>"><strong>Adresse de livraison : </strong></span>
						<span class="<?php echo $estilo;?>">
                    	<?php echo $address->address; ?>, <?php echo $address->location; ?>, <?php echo $address->zipcode; ?> <?php echo $address->country; ?>
                    	</span>
                    </div>
                    
                    <div class="left">
	                    <span class="status"><?php echo $cumplida ? '<span class="cumplida">ACCOMPLIE</span>' : '<span class="pendiente">Pendiente</span>'; ?></span>
                        <span class="profile"><a href="/user/profile/<?php echo $investData->user->id ?>" target="_blank"><?php echo Text::get('profile-widget-button'); ?></a> </span>
                        <span class="contact"><a href="/user/profile/<?php echo $investData->user->id ?>/message" target="_blank"><?php echo Text::get('regular-send_message'); ?></a></span>
                    </div>
                    
                    
                </div>
                
            <?php endforeach; ?>

            <?php if ($project->amount >= $project->mincost) : ?>
            <input type="submit" name="process" value="Aplicar marcados" class="save" onclick="return confirm('Attention!  En cochant comme remplie ne peut pas décocher . Nous continuons ?')"/>
            <?php endif; ?>
        </form>
    </div>

</div>

<div class="widget projects" id="colective-messages">
    <a name="message"></a>
    <h2 class="title">Message collectif</h2>

        <form name="message_form" method="post" action="<?php echo '/dashboard/'.$this['section'].'/'.$this['option'].'/message'; ?>">
        	<div id="checks">
               <input type="hidden" name="filter" value="<?php echo $filter; ?>" />
               <input type="hidden" name="order" value="<?php echo $order; ?>" />

                <p>
                    <input type="checkbox" id="msg_all" name="msg_all" value="1" onclick="alert('ignore le reste du étiqueté ?');" />
                    <label for="msg_all">A tout les confinanceurs de ce projet</label>
                </p>

                <p>
                    Pour les retours : <br />
                    <?php foreach ($rewards as $rewardId => $rewardData) : ?>
                        <input type="checkbox" id="msg_reward-<?php echo $rewardId; ?>" name="msg_reward-<?php echo $rewardId; ?>" value="1" />
                        <label for="msg_reward-<?php echo $rewardId; ?>"><?php echo $rewardData->amount; ?> &euro; (<?php echo Text::recorta($rewardData->reward, 40); ?>)</label>
                    <?php endforeach; ?>

                </p>
    		</div>
		    <div id="comment">
            <script type="text/javascript">
                // Mark DOM as javascript-enabled
                jQuery(document).ready(function ($) {
                    //change div#preview content when textarea lost focus
                    $("#message").blur(function(){
                        $("#preview").html($("#message").val());
                    });

                    //add fancybox on #a-preview click
                    $("#a-preview").fancybox({
                        'titlePosition'		: 'inside',
                        'transitionIn'		: 'none',
                        'transitionOut'		: 'none'
                    });
                });
            </script>
            <textarea rows="10" cols="50" name="message" id="message"></textarea>
            <div style="display:none">
                <div style="width:400px;height:300px;overflow:auto;" id="preview"></div>
            </div>
            <button type="submit" class="btn btn-default"><i class="fa fa-paper-plane-o margin-right"></i><?php echo Text::get('project-messages-send_message-button'); ?></button>
            </div>
        </form>

</div>

<?php endif; ?>
<script type="text/javascript">
    function msgto(reward) {
        document.getElementById('msg_reward-'+reward).checked = 'checked';
        document.location.href = '#message';
        $("#message").focus();
    }
</script>