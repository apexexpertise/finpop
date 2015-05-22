<?php
/*
 * Copyright (C) 2012 Platoniq y FundaciÃ³n Fuentes Abiertas (see README for details)
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
use Goteo\Library\Text, Goteo\Model\Category, Goteo\Model\Post, Goteo\Model\Sponsor;
// @NODESYS

$lang = (LANG != 'es') ? '?lang=' . LANG : '';

$categories = Category::getList (); // categorias que se usan en proyectos
$posts = Post::getList ( 'footer' );
$sponsors = Sponsor::getList ();
?>

<div class="footer">
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12 column ">
				<div class="row clearfix footer-nav">
				<div class="col-md-4 column block-text">
						<div style="width:360px;padding-top: 3px;">
						<p style="font-family:Open Sans Regular;font-size:16px;color:white;">DES QUESTIONS? </p>
						<p style="font-family:Open Sans Regular;font-size:14px;color:#0387f3;">CONTACTEZ-NOUS. NOUS SERONS HEUREUX DE  
						POUVOIR VOUS AIDER. </p>
						<p style="font-size:20px; color:white;"><img src="/view/css/icon/tel.png"> 5 31 61 62 63</img></p>
					    </div>
					</div>
					<div class="col-md-4 column block-social">
						<div class="icons">
						<p style="color:white;font-family:Open Sans Semibold;font-size:20px;margin-left: 15px;">SUIVEZ NOUS</p>
							<ul>
								<li class="twitter"><a
									href="<?php echo Text::get('social-account-facebook') ?>"
									target="_blank"><img src="/view/css/social/icon-facebook.png"></img></a></li>
								<li class="facebook"><a
									href="<?php echo Text::get('social-account-twitter') ?>"
									target="_blank"><img src="/view/css/social/icon-twitter.png"></img></a></li>
								<li class="identica"><a
									href="<?php echo Text::get('social-account-identica') ?>"
									target="_blank"><img src="/view/css/social/icon-instagram.png"></img></a></li>
								<li class="gplus"><a
									href="<?php echo Text::get('social-account-google') ?>"
									target="_blank"><img src="/view/css/social/icon-googleplus.png"></img></a></li>
								<li class="rss"><a rel="alternate" type="application/rss+xml"
									title="RSS" href="/rss<?php echo $lang ?>" target="_blank"><img src="/view/css/social/icon-rss.png"></img></a></li>

							</ul>
						</div>
					</div>
					<div class="col-md-4 column newsletter">
						<form method="post" action="/newsletter/">
							<div class="form-group">
								<label for="exampleInputEmail1" class="news-label">&nbsp;</label>
								<div class="row">
									<div class="col-xs-6">
			                        <div class="left-inner-addon">
			                        <img src="/view/home/img/msg.png" />
			                            <!--    <i class="fa fa-envelope"></i>  -->
										<input type="text" class="form-control" name="email" placeholder="<?php echo utf8_encode("INSCRIVEZ-VOUS À LA NEWSLETTER") ?>">	
									</div>
									</div>
								<!-- <button type="submit" class="btn btn-primary btn-news">Ok</button>-->
								</div>
							</div>
						</form>
					</div>

				</div>
				<div class="row clearfix shortcuts ">
					<div class="col-md-3 column">
						<div class="block categories" style="  margin-left: -51px;">
							<h8 class="title"><?php echo Text::get('footer-header-categories') ?></h8>
							<ul class="scroll-pane">
	                <?php foreach ($categories as $id=>$name) : ?>
	                    <li><a
									href="/discover/results/<?php echo $id.'/'.$name; ?>"><?php echo $name; ?></a></li>
	                <?php endforeach; ?>
	                </ul>
						</div>
					</div>
					<div class="col-md-3 column">
					<div class="block projects" style="margin-left: 55px;">
						<h8 class="title"><?php echo Text::get('footer-header-projects') ?></h8>
						<ul class="scroll-pane">
							<li><a href="/"><?php echo Text::get('home-promotes-header') ?></a></li>
							<li><a href="/discover/view/popular"><?php echo Text::get('discover-group-popular-header') ?></a></li>
							<li><a href="/discover/view/outdate"><?php echo Text::get('discover-group-outdate-header') ?></a></li>
							<li><a href="/discover/view/recent"><?php echo Text::get('discover-group-recent-header') ?></a></li>
							<li><a href="/discover/view/success"><?php echo Text::get('discover-group-success-header') ?></a></li>
							<li><a href="/discover/view/archive"><?php echo Text::get('discover-group-archive-header') ?></a></li>
							<li><a href="/project/create"><?php echo Text::get('regular-create') ?></a></li>
						</ul>
					</div></div>
					<div class="col-md-3 column">
					<div class="block ressources" style="margin-left: 130px;">
						<h8 class="title"><?php echo Text::get('footer-header-resources') ?></h8>
						<ul class="scroll-pane">
							<li><a href="/faq"><?php echo Text::get('regular-header-faq') ?></a></li>
							<li><a href="/glossary"><?php echo Text::get('footer-resources-glossary') ?></a></li>
							<li><a href="/press"><?php echo Text::get('footer-resources-press') ?></a></li>
                    <?php foreach ($posts as $id=>$title) : ?>
                    <li><a href="/blog/<?php echo $id ?>"><?php echo Text::recorta($title, 50) ?></a></li>
                    <?php endforeach; ?>
                    <li><a href="https://github.com/Goteo/Goteo"
								target="_blank"><?php echo Text::get('footer-resources-source_code') ?></a></li>
						</ul>
					</div></div>
					<div class="col-md-3 column">
					<div class="block services" style="  margin-left: 212px;">
						<h8 class="title"><?php echo Text::get('footer-header-services') ?></h8>
						<ul>
							<li><a href="/blog"><?php echo Text::get('regular-header-blog'); ?></a></li>
							<li><a href="/about"><?php echo Text::get('regular-header-about'); ?></a></li>
							<li><a href="/user/login"><?php echo Text::get('regular-login'); ?></a></li>
							<li><a href="/contact"><?php echo Text::get('regular-footer-contact'); ?></a></li>
						</ul>

					</div>
				</div>
				<div class="row clearfix copyright">
					<div class="col-md-12 column">
						<div class="w940">

							<ul style="margin-left: -39px;">
								<li><a href="/legal/terms"><?php echo Text::get('regular-footer-terms'); ?></a></li>
								<li><a href="/legal/privacy"><?php echo Text::get('regular-footer-privacy'); ?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>