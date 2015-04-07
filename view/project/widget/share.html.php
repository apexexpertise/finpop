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
use Goteo\Library\Text, Goteo\Core\View;

$project = $this ['project'];
$level = ( int ) $this ['level'] ?  : 3;

$share_title = $project->name;

$share_url = SITE_URL . '/project/' . $project->id;
if (LANG != 'es')
	$share_url .= '?lang=' . LANG;

$facebook_url = 'http://facebook.com/sharer.php?u=' . urlencode ( $share_url ) . '&t=' . urlencode ( $share_title );
$twitter_url = 'http://twitter.com/home?status=' . urlencode ( $share_title . ': ' . $share_url . ' #Goteo' );

?>
<script type="text/javascript">
            jQuery(document).ready(function ($) { 
				$("#a-proyecto").fancybox({
					'titlePosition'		: 'inside',
					'transitionIn'		: 'none',
					'transitionOut'		: 'none'
				});
			});
</script>
<div class="widget project-share">
		<h<?php echo $level+1 ?>><i class="fa fa-share-alt margin-right border-circle"></i><?php echo Text::get('project-share-header'); ?></h<?php echo $level+1 ?>>
		<div class="buttons-share">
			<ul>
				<li><section>
						<div class="button">
							<a target="_blank"
								href="<?php echo htmlentities($twitter_url) ?>"
								class="twitter-follow-button" data-show-count="false"
								data-size="large"><i class="fa fa-twitter margin-right"></i><?php echo Text::get('regular-twitter'); ?></a>
						</div>
						<div class="cover">
							<div class="innie"></div>
							<div class="spine"></div>
							<div class="outie">
								<i class="fa fa-twitter" style="position: relative; top: 4px;"></i>
							</div>
						</div>
						<div class="shadow"></div>
					</section></li>
				<li>
					<section>
						<div class="button">
							<a target="_blank"
								href="<?php echo htmlentities($facebook_url) ?>"
								class="twitter-follow-button" data-show-count="false"
								data-size="large"><i class="fa fa-facebook margin-right"></i><?php echo Text::get('regular-facebook'); ?></a>
						</div>
						<div class="cover">
							<div class="innie" style="background-color: #3a5795"></div>
							<div class="spine" style="background-color: 6BA3E4"></div>
							<div class="outie" style="background-color: #3a5795">
								<i class="fa fa-facebook" style="position: relative; top: 4px;"></i>
							</div>
						</div>
						<div class="shadow"></div>
					</section>
				</li>
				<li onclick="$(this).children('input').focus(); return false;"
					id="url-project">
						<span><i class="fa fa-link margin-right"></i>URL: </span> <input type="text" onfocus="this.select();"
							readonly="readonly" size="35"
							value="<?php echo htmlspecialchars($share_url) ?>" />
					</li>
			</ul>
		</div>
	</div>
