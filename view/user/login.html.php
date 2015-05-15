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
use Goteo\Core\View, Goteo\Library\Text;

$bodyClass = 'user-login';
// para que el prologue ponga el código js para botón facebook en el bannerside
$fbCode = Text::widget ( Text::get ( 'social-account-facebook' ), 'fb' );
$jscrypt = true;
include 'view/prologue.html.php';
include 'view/header.html.php';

$errors = $this ['errors'];
extract ( $_POST );
if (empty ( $username ) && isset ( $this ['username'] ))
	$username = $this ['username'];
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $("#register_accept").click(function (event) {
        if (this.checked) {
            $("#register_continue").removeClass('disabled').addClass('aqua');
            $("#register_continue").removeAttr('disabled');
        } else {
            $("#register_continue").removeClass('aqua').addClass('disabled');
            $("#register_continue").attr('disabled', 'disabled');
        }
    });

    //openid
    $('.sign-in-with li.openid input').focus(function(){
		$(this).addClass('focus');
		if($(this).val() == '<?php echo Text::get('login-signin-openid'); ?>') $(this).val('');
	});
    $('.sign-in-with li.openid input').blur(function(){
		$(this).removeClass('focus');
		if($(this).val().trim() == '') $(this).val('<?php echo Text::get('login-signin-openid'); ?>');
	});
	$('.sign-in-with li.openid a').click(function(){
		$(this).attr('href',$(this).attr('href') + '?provider=' + $('.sign-in-with li.openid input').val());
		return true;
	});
	$('.sign-in-with li.openid input').keypress(function(event) {
		if ( event.which == 13 ) {
			event.preventDefault();
			location = $('.sign-in-with li.openid a').attr('href') + '?provider=' + $(this).val();
		}
	});

	//view more
	$('.sign-in-with li.more a').click(function(){
		$(this).parent().remove();
		$('.sign-in-with li:hidden').slideDown();
		return false;
	});

	$("#new-compte").click(function(){
		$("#login").css("display","none");
		$("#login").removeClass("bounceInUp");
		$("#login").addClass("bounceOutUp");
		$("#subscription").css("display","block");
		$("#subscription").removeClass("bounceOutUp");
		$("#subscription").addClass("bounceInUp");
	});
	$("#sub-btn").click(function(){
		$("#login").css("display","block");
		$("#login").removeClass("bounceOutUp");
		$("#login").addClass("bounceInUp");
		$("#subscription").css("display","none");
		$("#subscription").removeClass("bounceInUp");
		$("#subscription").addClass("bounceOutUp");
		return false;
	});
    
});
</script>

<div id="sub-header">
	<div class="clearfix">
		<div class="subhead-banner">
			<h2 class="message">Rejoignez la communaut&eacute; d'investisseurs !</h2>
		</div>
	</div>
</div>
<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>
<div class="bg_login">
	<div class="container login-form">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<div class="row clearfix">
					<div class="col-md-12 column text-center">
						<div class="box-panel animated"  id="login">
							<div class="login ">
								<h2>Identifiez-Vous</h2>
								<form action="/user/login" method="post" id="login_frm">
									<input type="hidden" name="return"
										value="<?php echo $_GET['return']; ?>" />

									<div class="form-group">
										<label><?php echo Text::get('login-access-username-field'); ?></label><input
											type="text" class="form-control" name="username"
											value="<?php echo $username?>" />
									</div>
									<div class="form-group">
										<label><?php echo Text::get('login-access-password-field'); ?></label><input
											type="password" class="form-control" id="thepw"
											name="password" value="" />
									</div>
									<p>
										<a href="/user/recover">Mot de passe oubli&eacute;</a>
									</p>
									<p>
										<a class="baja" id="new-compte" style="cursor:pointer;">Cr&eacute;er un compte</a>
									</p>
									<div style="text-align: right; clear: both;">
										<input type="submit" class="btn btn-primary" name="login"
											value="Connexion" />
									</div>

								</form>
							</div>

							<div class="external-login">
								<div>
									<h2
										style="font-size: 15px; padding-top: 16px; border-top: 1px solid rgba(192, 190, 190, 0.29); padding-bottom: 16px;">-
										Ou connectez vous via-</h2>
									<ul class="sign-in-with">
                <?php
																
																// posarem primer l'ultim servei utilitzat
																// de manera que si l'ultima vegada t'has autentificat correctament amb google, el tindras el primer de la llista
																
																// la cookie serveix per saber si ja ens hem autentificat algun cop amb "un sol click"
																$openid = $_COOKIE ['goteo_oauth_provider'];
																
																// l'ordre que es vulgui...
																$logins = array (
																		'facebook' => '<span class="fa fa-facebook fa-4x" aria-hidden="true"></span><a href="/user/oauth?provider=facebook">' . Text::get ( 'login-signin-facebook' ) . '</a>',
																		'twitter' => '<span class="fa fa-twitter fa-4x" aria-hidden="true"></span><a href="/user/oauth?provider=twitter">' . Text::get ( 'login-signin-twitter' ) . '</a>',
																		'Google' => '<span class="fa fa-google fa-4x" aria-hidden="true"></span><a href="/user/oauth?provider=Google">' . Text::get ( 'login-signin-google' ) . '</a>',
																		'Yahoo' => '<span class="fa fa-yahoo fa-4x" aria-hidden="true"></span><a href="/user/oauth?provider=Yahoo">' . Text::get ( 'login-signin-yahoo' ) . '</a>',
																		'linkedin' => '<span class="fa fa-linkedin fa-4x" aria-hidden="true"></span><a href="/user/oauth?provider=linkedin">' . Text::get ( 'login-signin-linkedin' ) . '</a>' 
																);
																/*
																 * $is_openid = ! array_key_exists ( $openid, $logins );
																 * $logins ['openid'] = '<form><input type="text" class="form-control"' . ($is_openid ? ' class="used"' : '') . ' name="openid" value="' . htmlspecialchars ( $is_openid ? $openid : Text::get ( 'login-signin-openid' ) ) . '" /><a href="/user/oauth" class="button">' . Text::get ( 'login-signin-openid-go' ) . '&rarr;</a></form>';
																 * // si se ha guardado la preferencia, lo ponemos primero
																 * $key = '';
																 * if ($openid) {
																 * $key = array_key_exists ( $openid, $logins ) ? $openid : 'openid';
																 * echo '<li class="' . strtolower ( $key ) . '">' . $logins [$key] . '</li>';
																 * echo '<li class="more">&rarr;<a href="#">' . Text::get ( 'login-signin-view-more' ) . '</a></li>';
																 * }
																 */
																foreach ( $logins as $k => $v ) {
																	if ($key != $k)
																		echo '<li class="' . strtolower ( $k ) . '"' . ($openid ? ' style="display:none"' : '') . '>' . $v . '</li>';
																}
																?>

                </ul>
								</div>
							</div>
						</div>
						<div class="box-panel animated" id="subscription" style="display: none">
							<div class="register">
								<div>
									<h2><?php echo Text::get('login-register-header'); ?></h2>
									<form action="/user/register" method="post">

										<div class="form-group">
											<label for="RegisterUserid"><?php echo Text::get('login-register-userid-field'); ?></label>
											<input type="text" class="form-control" id="RegisterUserid"
												name="userid"
												value="<?php echo htmlspecialchars($userid) ?>"
												maxlength="15" />
                    <?php if(isset($errors['userid'])) { ?><em><?php echo $errors['userid']?></em><?php } ?>
                    </div>

										<div class="form-group">
											<label for="RegisterUsername"><?php echo Text::get('login-register-username-field'); ?></label>
											<input type="text" class="form-control" id="RegisterUsername"
												name="username"
												value="<?php echo htmlspecialchars($username) ?>"
												maxlength="20" />
                    <?php if(isset($errors['username'])) { ?><em><?php echo $errors['username']?></em><?php } ?>
                    </div>

										<div class="form-group">
											<label for="RegisterEmail"><?php echo Text::get('login-register-email-field'); ?></label>
											<input type="text" class="form-control" id="RegisterEmail"
												name="email" value="<?php echo htmlspecialchars($email) ?>" />
                    <?php if(isset($errors['email'])) { ?><em><?php echo $errors['email']?></em><?php } ?>
                    </div>

										<div class="form-group">
											<label for="RegisterREmail"><?php echo Text::get('login-register-confirm-field'); ?></label>
											<input type="email" class="form-control" id="RegisterREmail"
												name="remail"
												value="<?php echo htmlspecialchars($remail) ?>" />
                    <?php if(isset($errors['remail'])) { ?><em><?php echo $errors['remail']?></em><?php } ?>
                    </div>


										<div class="form-group">
											<label for="RegisterPassword"><?php echo Text::get('login-register-password-field'); ?></label> <?php if (strlen($password) < 6) echo '<em>'.Text::get('login-register-password-minlength').'</em>'; ?>
                        <input type="password" class="form-control"
												id="RegisterPassword" name="password"
												value="<?php echo htmlspecialchars($password) ?>" />
                    <?php if(isset($errors['password'])) { ?><em><?php echo $errors['password']?></em><?php } ?>
                    </div>

										<div class="form-group">
											<label for="RegisterRPassword"><?php echo Text::get('login-register-confirm_password-field'); ?></label>
											<input type="password" class="form-control"
												id="RegisterRPassword" name="rpassword"
												value="<?php echo htmlspecialchars($rpassword) ?>" />
                    <?php if(isset($errors['rpassword'])) { ?><em><?php echo $errors['rpassword']?></em><?php } ?>
                    </div>


										<input class="checkbox" id="register_accept" name="confirm"
											type="checkbox" value="true" /> <label class="conditions"
											for="register_accept"><blockquote
												style="font-family: source sans pro; font-size: 14px;">Acceptez
												les conditions d'utilisation de la plateforme.</blockquote></label><br />
										<div style="text-align: right;">
											<button class="btn btn-default" style="padding: 7px 28px;font-family: source sans pro;font-size: 17px;" id="sub-btn">Anuuler</button> 
											<button class="disabled btn btn-primary" disabled="disabled"
												id="register_continue" name="register" type="submit"
												value="register"  data-toggle="modal" data-target="#myModal"
												style="padding: 7px 28px;font-family: source sans pro;font-size: 17px;"
												>Valider</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Information</h4>
        </div>
        <div class="modal-body">
          <p>Vous pouvez calculer votre taux d'endettement</p>
          <p>Cliquer  <a href="/deptratio/">ici</a> </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<?php include 'view/footer.html.php' ?>