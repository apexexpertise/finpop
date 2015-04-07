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
// para que el prologue ponga el c�digo js para bot�n facebook en el bannerside
$fbCode = Text::widget ( Text::get ( 'social-account-facebook' ), 'fb' );
include 'view/prologue.html.php';
include 'view/header.html.php';

$error = $this ['error'];
$message = $this ['message'];
extract ( $_POST );
?>
<div id="sub-header">
	<div class="clearfix">
		<div class="subhead-banner">
			<h2 class="message">Rejoignez la communaut&eacute; d'investisseurs !</h2>
		</div>
	</div>
</div>
<div class="bg_login">
	<div class="container login-form">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<div class="row clearfix">
					<div class="col-md-12 column text-center">
						<div class="box-panel animated fadeInDown">

							<div>

								<h2>Mot de passe oubli&eacute;e</h2>
								<blockquote
									style="font-size: 14px; font-family: source sans pro;"><?php echo Text::get('login-recover-header'); ?></blockquote>
					                <?php if (!empty($error)): ?>
					                <p class="error"><?php echo $error; ?></p>
					                <?php endif ?>
					                <?php if (!empty($message)): ?>
					                <p><?php echo $message; ?></p>
					                <?php endif ?>
					
					                <form action="/user/recover" method="post" class="form-inline">
									<div class="form-group">
										<label><?php echo Text::get('login-recover-email-field'); ?>
                       					 <input type="text" name="email" class="form-control"
											value="<?php echo $email?>" /></label>
									</div>
									<br>
									<input type="submit" name="recover" class="btn btn-primary" 
										value="<?php echo Text::get('login-recover-button'); ?>" />

									<a class="btn btn-default" style="padding: 9px 16px;" href="<?php echo SRC_URL?>user/login">Annuler</a>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include 'view/footer.html.php' ?>