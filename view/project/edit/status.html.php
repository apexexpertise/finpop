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
use Goteo\Library\Text, Goteo\Model\Project;
?>
<div class="status">
	<div class="widget project-score" id="project-score">
		<h3><?php echo Text::get('form-project-progress-title'); ?> <!--<code><?php echo number_format($this['progress'], 0) ?>%</code> -->
		</h3>
		<p><?php echo Text::get('explain-project-progress') ?></p>

		<script src="../../view/js/circle-progress.js"></script>

		<center><div id="circle"><strong></strong></div></center>

		<script>
    $('#circle').circleProgress({
    	value: <?php echo number_format($this['progress'], 0)/100; ?>,
        fill: { gradient: [['#0681c4', .5], ['#4ac5f8', .5]], gradientAngle: Math.PI / 4 }
    }).on('circle-animation-progress', function(event, progress) {
        $(this).find('strong').html(parseInt(<?php echo number_format($this['progress'], 0) ?> * progress) + '<i>%</i>');
    });
   
</script>
		
    </div>


	<div class="widget project-status" id="project-status">
		<h3><?php echo Text::get('form-project-status-title'); ?></h3>
		<ul>
            <?php foreach (Project::status() as $i => $s): ?>
            <li><?php if ($i == $this['status']) echo '<strong><i class="fa fa-chevron-circle-right margin-right"></i>' ?><?php echo htmlspecialchars($s) ?><?php if ($i == $this['status']) echo '</strong>' ?></li>
            <?php endforeach ?>
        </ul>
	</div>

</div>
       
        <?php
								// Old code
								
								/*
								 * <script type="text/javascript">
								 * // Animated scoremeter
								 * $(document).ready(function () {
								 *
								 * var progress = <?php echo number_format($this['progress'], 2) ?>,
								 * code = $('#project-score code'),
								 * meter = $('<div class="meter">'),
								 * done = $('<div>').addClass('done').css('width', '0');
								 * left = $('<div>').addClass('left').css('width', '100%');
								 *
								 * $('#project-score').append(meter);
								 * meter.append(done, left);
								 *
								 * $(window).load(function() {
								 * done.animate({
								 * width: progress + '%'
								 * }, {
								 * step: function (p) {
								 * left.css('width', (100 - p) + '%');
								 * code.text(Math.round(p) + '%');
								 * }
								 * }, 2500);
								 * });
								 *
								 * });
								 * </script>
								 *
								 * <noscript>
								 * <!-- Static scoremeter -->
								 * <div class="meter">
								 * <div class="done" style="width: <?php echo number_format($this['progress'], 2) ?>%"></div>
								 * <div class="left" style="width: <?php echo number_format(100 - $this['progress'], 2) ?>%"></div>
								 * </div>
								 * </noscript>
								 */
								?>




