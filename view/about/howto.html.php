<?php
/*
 * Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 * This file is part of Goteo.
 *
 * Goteo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Goteo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Goteo. If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */
include 'view/prologue.html.php';
include 'view/header.html.php';
$bodyClass = 'about';
?>
<link href="/view/css/custom.css" rel="stylesheet" type="text/css">



<script type="text/javascript">
$(document).ready(function(){
    // Condition d'affichage du bouton
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100){
            $('.go_top').fadeIn();
        }
        else{
            $('.go_top').fadeOut();
        }
    });
    // Evenement au clic
    $('.go_top').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
});

</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $("#accept").click(function (event) {
        if (this.checked) {
            $("#submit").removeClass('disabled').addClass('weak');
            $("#submit").removeAttr('disabled');
        } else {
            $("#submit").removeClass('weak').addClass('disabled');
            $("#submit").attr('disabled', 'disabled');
        }
    });
});
</script>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
	<div class="container">
		<div class="content-center">
			<span id="tit-slid">cr&eacute;er</span> <span id="tit-slid2"> un
				projet</span><br> <img src="/view/css/images/line.png" style="">
			<p id="content-slide">Chez Finpop, nous avons &aacute; coeur la
				r&eacute;ussite des projets de nos clients. Voil&aacute; pourquoi
				nous nous assurons de trouver la meilleure strat&eacute;gie possible
				afin de rendre leur investissement profitable.</p>
		</div>
	</div>
</div>
<html><body>
<div id="who">
	<div class="container homepage">
<a href="#" class="go_top">Remonter</a>
		<h2>
			INSTRUCTIONS POUR <br>LES PORTEURS DE PROJETS
		</h2>
		<hr>
		<p>
			<span class="finp">FINPOP</span> est une plateforme de soutien
			de projets port&eacute;s par des entrepreneurs, innovateurs sociaux et
			cr&eacute;atifs qui dans leurs objectifs, dans leur format, et dans leurs
			r&eacute;sultats int&egrave;grent des retomb&eacute;es collectives publi&eacute;es sous licence
			libre ou ouverte (Creative Commons ou GPL par exemple).
		</p>

		<p>
			<span class="finp">FINPOP</span> encourage des projets ouverts
			qui partagent information, connaissance, contenus num&eacute;riques et/ou
			autres ressources en lien avec l&acute;activit&eacute; pour laquelle le
			financement est recherch&eacute;.
		</p>

		<p>
			<span class="finp">FINPOP</span> a &eacute;tabli un guide &aacute;
			l&acute;intention des porteurs de projet qui veulent obtenir un soutien de
			la communaut&eacute; de Goteo.
		</p>
		<p style="padding-bottom: 30px">Si vous voulez avoir plus d&acute;infos
			lisez notre FAQ.</p>
		<h2>Mes engagements</h2>
		<hr>
	</div>
</div>

<div id="get-involved">
	<div class="container homepage">

		<div class="row">
			<div class="col-md-6">
				<img src="/view/css/images/engag1.png" style="padding-bottom: 10px">

				<p>Quand mon projet offre des r&eacute;compenses individuelles pour
					compenser les apports &eacute;conomiques, je m'engage a respecter mon
					compromis avec la plateforme et mes cofinanceurs si j&acute;obtiens le
					financement requis.</p>

			</div>
			<div class="col-md-6">
				<img src="/view/css/images/engag2.png" style="padding-bottom: 10px">

				<p>Je m&acute;engage d&acute;autre part &aacute; respecter mon compromis en publiant et
					donnant acc&eacute;s aux retomb&eacute;es collectives promises, ainsi qu'aux
					liens qui permettent de les localiser depuis Finpop et sous la
					licence &eacute;tablie lors de la demande de financement.</p>

			</div>


		</div>
		<div class="row" style="margin-top: 60px">
			<div class="col-md-6">
				<img src="/view/css/images/engag3.png" style="padding-bottom: 10px">

				<p>Je sollicite un financement minimum pour r&eacute;aliser mon projet, que
					je dois atteindre en 40 jours, et un financement optimum. La
					collecte du financement minimum doit co&iuml;ncider avec le d&eacute;but de la
					production, au sujet de laquelle je promets de donner
					p&eacute;riodiquement des informations, me permettant de b&eacute;n&eacute;ficier ainsi
					de l&acute;opportunit&eacute; de compl&eacute;ter le financement minimum jusqu&acute;&aacute;
					atteindre le financement optimum durant une p&eacute;riode suppl&eacute;mentaire
					de 40 jours.</p>

			</div>
			<div class="col-md-6">
				<img src="/view/css/images/engag4.png" style="padding-bottom: 10px">

				<p>La finalit&eacute; du projet n&acute;est pas la vente camoufl&eacute;e de produits et
					services d&eacute;j&aacute; produits, ni de financer une campagne ill&eacute;gale ou
					visant &aacute; attaquer la dignit&eacute; d'une personne ou d'un collectif ou
					d'une personne.</p>

			</div>

		</div>

		<div>
			<span> <img style="margin-top: 60px" src="/view/css/images/ligne.png"
				style=""></span>
		</div>



		<div class="col-lg-12 text-center">
			<h2 class="section-cond">CONDITIONS</h2>
			<hr>
</div>



			<div class="col-md-12">
			
				<p class="section-majeur">Je suis majeur(e)</p>
			</div>

			<div class="col-md-12">
				<p class="section-compte">Je dispose d'un compte bancaire</p>

			</div>
			
			<div class="col-md-12">
				<p class="section-condition">
					<input id="accept" type="checkbox"> J&acute;ai lu, compris et
					accept&eacute; les conditions et j&acute;ai pris connaissance de la
					politique de confidentialit&eacute; de la plateforme
				</p>


				<p>
					<input id="submit" type="submit" name="CONTINUER" value="CONTINUER">
					
					
				</p>
			</div>





		</div>
		<!-- /container -->
		
	</div>
 


<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>




</body></html>