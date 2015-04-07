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
					<div class="col-md-6 column newsletter">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="exampleInputEmail1" class="news-label">&nbsp;</label>
								<div class="row">
									<div class="col-xs-6">
										<input type="text" class="form-control"
											placeholder="<?php echo utf8_encode("Abonnez vous à la newsletter") ?>">
									</div>
									<button type="submit" class="btn btn-primary btn-news">Ok</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-6 column block-social">
						<div class="icons">
							<ul>
								<li class="twitter"><a
									href="<?php echo Text::get('social-account-twitter') ?>"
									target="_blank"><span class="fa fa-twitter fa-4x white"
										aria-hidden="true"></span></a></li>
								<li class="facebook"><a
									href="<?php echo Text::get('social-account-facebook') ?>"
									target="_blank"><span class="fa fa-facebook fa-4x white"
										aria-hidden="true"></span></a></li>
								<li class="identica"><a
									href="<?php echo Text::get('social-account-identica') ?>"
									target="_blank"><span class="fa fa-instagram fa-4x white"
										aria-hidden="true"></span></a></li>
								<li class="gplus"><a
									href="<?php echo Text::get('social-account-google') ?>"
									target="_blank"><span class="fa fa-google-plus fa-4x white"
										aria-hidden="true"></span></a></li>
								<li class="rss"><a rel="alternate" type="application/rss+xml"
									title="RSS" href="/rss<?php echo $lang ?>" target="_blank"><span
										class="fa fa-rss fa-4x white" aria-hidden="true"></span></a></li>

							</ul>
						</div>

					</div>

				</div>
				<div class="row clearfix shortcuts ">
					<div class="col-md-3 column">
						<div class="block categories">
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
					</div>
					<div class="col-md-3 column">
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
					</div>
					<div class="col-md-3 column">
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

							<ul>
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