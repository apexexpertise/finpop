<?php
use Goteo\Core\View, Goteo\Model\Image, Goteo\Library\Text;

$user = $this ['user'];
include 'view/prologue.html.php';
include 'view/header.html.php';
?>
<link rel="stylesheet" type="text/css"
	href="<?php echo SRC_URL ?>/view/css/deptratio/style.css" media="all" />

<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
		
			<div id="deptratio">
				<form id="msform" method="post" action="/deptratio" onsubmit="setTimeout(showResult(),5000);">
					
					<!-- progressbar -->
					<ul id="progressbar">
						<li id="step1-li" class="active">VOS REVENUS</li>
						<li id="step2-li">VOS CHARGES</li>
						<li id="step3-li">VOTRE TAUX D'ENDETTEMENT</li>
					</ul>


					<!-- fieldsets -->
					<fieldset id="step1">

						<h2 class="fs-title" style="text-align: center;">VOS REVENUS</h2>
						<h3 class="fs-subtitle" style="text-align: center;">ETAPE 1</h3>


						<input type="text" id="ib" name="income_borrower"
							placeholder="Revenus emprunteur" style="width: 35%;" required />

						&euro; &nbsp;x <select name="month_income_borrower"
							style="width: 13%;">
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
						</select> mois <br /> <label for="income_borrower" class="error"></label>
						<br /> <input type="text" name="others_income"
							placeholder="Autres revenus (Primes, pensions...)" /> &euro;
						/mois <br /> <input type="button" name="next"
							class="action-button" value="Suivant" onclick="showStep2();"/>

					</fieldset>
					<fieldset id="step2">
						<h2 class="fs-title">VOS CHARGES</h2>
						<h3 class="fs-subtitle">ETAPE 2</h3>
						<p style="padding: 15px; text-align: left;">CR&Eacute;DITS EN
							COURS :</p>
						<div id="dynamicInput"></div>
						<input type="button" value="ajouter" name="add" class="add-select"
							onclick="addInput('dynamicInput');" />




						<p style="padding: 15px; text-align: left;">AUTRES :</p>
						<input type="text" name="paid_support"
							placeholder="Pension alimentaire vers&eacute;e" /> &euro; /mois <input
							type="text" name="others_expenses"
							placeholder="Autres charges r&eacute;currentes" /> &euro; /mois <input
							type="button" name="previous" class="action-button" onclick="showStep1();"
							value="Pr&eacute;cedent" /> <input type="button" name="next"
							class="action-button" value="Calculer" onclick="showResult();"/>
					</fieldset>
					<fieldset id="result">
						<h2 class="fs-title">VOTRE TAUX D'ENDETTEMENT</h2>
						<h3 class="fs-subtitle">ETAPE 3</h3>

						<p id="msg_result" style="text-align: center;"></p>
						<p
							style="padding-top: 30px; padding-bottom: 15px; text-align: left;">PR&Eacute;SENTATION
							DE VOTRE TAUX D'ENDETTEMENT :</p>
						<div class="progress">
		
				 
  <div id="progressbar-deptratio" class="progress-bar progress-bar-success" role="progressbar" title="Taux d'endettement" data-toggle="tooltip">
   
  </div>
				
  
  <div id="progressbar-deptratio-warning" class="progress-bar progress-bar-warning" role="progressbar" title="Si vous depassez ce pourcentage , vous devez &ecirc;tre endett&eacute;" data-toggle="tooltip">
  </div>
   <div id="progressbar-deptratio-left" class="progress-bar progress-bar-warning" role="progressbar">
  </div>

						</div>
						<p id="msg-deptratio"></p>
						<input type="button" name="previous" onclick="showStep2();"
							class="previous action-button" value="Previous" /> 



					</fieldset>


				</form>

				
				<script type="text/javascript">
				function showStep1() {
				document.getElementById("step1").style.display = "block";					
				document.getElementById("step2").style.display = "none";
				document.getElementById("result").style.display = "none";
				document.getElementById("step1-li").className = "active";
				document.getElementById("step2-li").className = "";
				document.getElementById("step3-li").className = "";
				
				 }
				function showStep2() {
					document.getElementById("step1").style.display = "none";					
				document.getElementById("step2").style.display = "block";
				document.getElementById("result").style.display = "none";
				document.getElementById("step1-li").className = "";
				document.getElementById("step2-li").className = "active";
				document.getElementById("step3-li").className = "";
			
				 }
				function showResult() {
					countDeptratio();
					document.getElementById("step1").style.display = "none";					
				document.getElementById("step2").style.display = "none";
				document.getElementById("result").style.display = "block";
				document.getElementById("step1-li").className = "";
				document.getElementById("step2-li").className = "";
				document.getElementById("step3-li").className = "active";
				 }
				function countDeptratio() {				
					var ib=0;
					var mib=parseInt(document.getElementsByName('month_income_borrower')[0].value);
					var oi=0;
					var ps=0;					
					var oe=0;
					var cp1=parseInt(0);
					var cp2=parseInt(0);
					var cp3=parseInt(0);
					var cp4=parseInt(0);
					var cp5=parseInt(0);
					var cp6=parseInt(0);
					
					if (document.getElementsByName("income_borrower")[0].value!="") {
						
						ib= parseInt(document.getElementsByName('income_borrower')[0].value);
					}
					if (document.getElementsByName("others_income")[0].value!="") {
						
						oi= parseInt(document.getElementsByName('others_income')[0].value);
					}
					if (document.getElementsByName("paid_support")[0].value!="") {
						
						ps= parseInt(document.getElementsByName('paid_support')[0].value);
					}
					if (document.getElementsByName("others_expenses")[0].value!="") {
						
						oe= parseInt(document.getElementsByName('others_expenses')[0].value);
					}
					if (document.getElementsByName("credit_in_progress1")[0]) {
						if (document.getElementsByName("credit_in_progress1")[0].value!="") {
							
							cp1= parseInt(document.getElementsByName('credit_in_progress1')[0].value);
						}
						
					}
					if (document.getElementsByName("credit_in_progress2")[0]) {
						
						if (document.getElementsByName("credit_in_progress2")[0].value!="") {
							
							cp2= parseInt(document.getElementsByName('credit_in_progress2')[0].value);
						}
						
					}
					if (document.getElementsByName("credit_in_progress3")[0]) {
						if (document.getElementsByName("credit_in_progress3")[0].value!="") {
							
							cp3= parseInt(document.getElementsByName('credit_in_progress3')[0].value);
						}
						
					}
					
					if (document.getElementsByName("credit_in_progress4")[0]) {
						if (document.getElementsByName("credit_in_progress4")[0].value!="") {
							
							cp4= parseInt(document.getElementsByName('credit_in_progress4')[0].value);
						}
				}

					if (document.getElementsByName("credit_in_progress5")[0]) {
						if (document.getElementsByName("credit_in_progress5")[0].value!="") {
							
							cp5= parseInt(document.getElementsByName('credit_in_progress5')[0].value);
						}
						
					}
					if (document.getElementsByName("credit_in_progress6")[0]) {
						if (document.getElementsByName("credit_in_progress6")[0].value!="") {
							
							cp6= parseInt(document.getElementsByName('credit_in_progress6')[0].value);
						}
						
					}
					
					var total_income= ib*mib+oi;
					var total_expenses=mib*(ps + oe + cp2 + cp3 + cp4 + cp5 + cp6 + cp1);
					
					var val_deptratio= (total_expenses / total_income)* 100;
					var deptratio= Math.round(val_deptratio);
				
					document.getElementById('msg_result').innerHTML="Votre taux d'endettement est :"+deptratio+"%";
					document.getElementById("progressbar-deptratio").style.width = deptratio+"%";
					document.getElementById('progressbar-deptratio').innerHTML=deptratio+" %";
					if(deptratio>33)
					{
						var width_left= 100- deptratio;
						document.getElementById("progressbar-deptratio-left").style.width = width_left+"%";
						document.getElementById("progressbar-deptratio-left").innerHTML = width_left+"%";
						document.getElementById("progressbar-deptratio").style.background="red";
						document.getElementById('msg-deptratio').innerHTML="Vous etes endett&eacute;";
						document.getElementById("progressbar-deptratio-warning").style.width = 	"0%";
						document.getElementById('progressbar-deptratio-warning').innerHTML="0%";
					}
					else {
					var width= 33- deptratio;
					var width_left= 100-(width + deptratio);
						document.getElementById("progressbar-deptratio").style.background="#27AE60";
						document.getElementById("progressbar-deptratio-left").innerHTML = width_left+"%";
						document.getElementById("progressbar-deptratio-warning").style.width = width+"%";
						document.getElementById("progressbar-deptratio-left").style.width = width_left+"%";
						document.getElementById('progressbar-deptratio-warning').style.background="red";
						document.getElementById('progressbar-deptratio-warning').innerHTML=width+" %";
						document.getElementById('msg-deptratio').innerHTML="Vous pouvez preter de l'argent";

					}
					
					
				}
				

</script>
				

				<script type="text/javascript">
				$(document).ready(function(){
				    $('[data-toggle="tooltip"]').tooltip();   
				});
var choices = [];
choices[0] = "Credit immobilier";
choices[1] = "Credit consommation";
choices[2] = "Pret au taux zero";
choices[3] = "Pret 1 %";
choices[4] = "Credit Renouvelable";
choices[5] = "Autres";
var cpt=0;

function addInput(divName) {
	cpt=cpt+1;
    var select = $("<select style='width:36%;' name='name_credit_in_progress"+cpt+"'/>")
     var input = $("<input name='credit_in_progress"+cpt+"' type=text style='width:28%;' placeholder='valeur' />")
    $.each(choices, function(a, b) {
        select.append($("<option/>").attr("value", b).text(b));
    });
    $("#" + divName).append(select);
   
    $("#" + divName).append(input);
    $("#" + divName).append("&euro; /mois");
}
	</script>
			
			</div>
		</div>
	</div>
</div>
<?php include 'view/footer.html.php'; ?>
<?php include 'view/epilogue.html.php'; ?>
