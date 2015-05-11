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
use Goteo\Library\Text;

$posts = $this ['posts'];
?>
<link rel="stylesheet" href="<?php echo SITE_URL; ?>/view/home/css/flexslider.css" type="text/css" media="all">
<script type="text/javascript" src="<?php echo SITE_URL; ?>https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/view/home/js/jquery.flexslider.js"></script>

<script type="text/javascript">
  $(window).load(function() {
    $('.flexslider').flexslider();
  
  });

</script>
<script type="text/javascript">

$(window).load(function() {  
    var player = document.getElementById('player_1');
    $f(player).addEvent('ready', ready);
   
    function addEvent(element, eventName, callback) {
      if (element.addEventListener) {
        element.addEventListener(eventName, callback, false)
      } else {
        element.attachEvent(eventName, callback, false);
      }
    }
   
    function ready(player_id) {
      var froogaloop = $f(player_id);
      froogaloop.addEvent('play', function(data) {
        $('.flexslider').flexslider("pause");
      });
      froogaloop.addEvent('pause', function(data) {
        $('.flexslider').flexslider("play");
      });
    }
   
     
    // Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
    $(".flexslider")
      .fitVids()
      .flexslider({
        animation: "slide",
        useCSS: false,
        animationLoop: false,
        smoothHeight: true,
        before: function(slider){
          $f(player).api('pause');
        }
    });
  });
</script>
<div class="content">
<div class="row clearfix">
<div class="col-md-12 column">
<h2 class="Open Sans Light" style="text-align:center;">Nouveaut&eacute;s</h2><hr style="height: 3px; width: 88px; color: #0387f3; background-color: #0387f3;"></hr>
</div>
</div>
<div class="container">
<div class="row clearfix">
<?php $i = 1; foreach ($posts as $post) : ?>
<?php if (!empty($post->image)) : ?>
<div class="col-md-4 column">
<div class="flexslider">
<ul class="slides">
<?php $i = 1; foreach ($post->gallery as $image) : ?>
<li>	
<div class="row clearfix">
                <div class="image" <?php if(($i-1)==1) echo "style='height: auto;'"; ?>>
				<img src="<?php echo $image->getLink(500, 285); ?>" alt="Imagen" />
</div></div>
<div class="row clearfix">
<div class="blocimage">
<?php if (!empty($post->author)) : ?>
<div class="author">
<i class="fa fa-user"></i>&nbsp;&nbsp;<a href="/user/profile/<?php echo $post->author ?>"><?php echo Text::get('regular-by') ?> <?php echo $post->user->name ?></a>
</div>
<?php endif; ?>
               
<?php if (!empty($post->date)) : ?>
                    <div class="date">
					  <?php echo $post->date ?>
					</div>
                <?php endif; ?>
                  <h3><?php
									
                  if ($post->owner_type == 'project') {
										echo '<a href="/project/' . $post->owner_id . '/updates/' . $post->id . '">' . Text::get ( 'project-menu-home' ) . ' ' . $post->owner_name . '</a>: ' . $post->title;
									} else {
										echo '<a href="/blog/' . $post->id . '">' . $post->title . '</a>';
									}
									?></h3>
                 <div class="description"><?php if ($post->id == 728) echo Text::recorta($post->text, 400); else echo Text::recorta($post->text, 600); ?></div>

					<div class="read_more">
						<a
							href="<?php echo ($post->owner_type == 'project') ? '/project/'.$post->owner_id.'/updates/'.$post->id : '/blog/'.$post->id; ?>"><?php echo Text::get('regular-read_more') ?></a>
					</div>	</div>	  </div>  
</li>
<?php $i++; endforeach; ?>
</ul>
</div>
</div>
<?php endif; ?>
<?php $i++; endforeach; ?>
<?php $i = 1; foreach ($posts as $post) : ?>
<?php if (!empty($post->media->url)) : ?>
<div class="col-md-4 column">
<div class="row clearfix">
 <div class="embed" style="display: block; width:350px;height:220px;padding-top:3px;">
<?php echo $post->media->getEmbedCode(); ?>
</div></div>
<div class="row clearfix">
<div class="blocvideo">
 <?php if (!empty($post->author)) : ?>
                    <div class="author">
						<i class="fa fa-user"></i>&nbsp;&nbsp;<a href="/user/profile/<?php echo $post->author ?>"><?php echo Text::get('regular-by') ?> <?php echo $post->user->name ?></a>
					</div>
                <?php endif; ?>
               
                <?php if (!empty($post->date)) : ?>
                    <div class="date">
					  <?php echo $post->date ?>
					</div>
                <?php endif; ?>
                  <h3><?php
									
                  if ($post->owner_type == 'project') {
										echo '<a href="/project/' . $post->owner_id . '/updates/' . $post->id . '">' . Text::get ( 'project-menu-home' ) . ' ' . $post->owner_name . '</a>: ' . $post->title;
									} else {
										echo '<a href="/blog/' . $post->id . '">' . $post->title . '</a>';
									}
									?></h3>
                 <div class="description"><?php if ($post->id == 728) echo Text::recorta($post->text, 400); else echo Text::recorta($post->text, 600); ?></div>

					<div class="r_m">
						<a
							href="<?php echo ($post->owner_type == 'project') ? '/project/'.$post->owner_id.'/updates/'.$post->id : '/blog/'.$post->id; ?>"><?php echo Text::get('regular-read_more') ?></a>
			        </div>
			        </div></div>
</div>
<?php endif; ?>
<?php $i++; endforeach; ?>
<?php $i = 1; foreach ($posts as $post) : ?>
<?php if (empty($post->image) && empty($post->media->url)) : ?>
<div class="col-md-4 column">
<div class="bloctext">
<h3><?php
									
           if ($post->owner_type == 'project') {
					echo '<a href="/project/' . $post->owner_id . '/updates/' . $post->id . '">' . Text::get ( 'project-menu-home' ) . ' ' . $post->owner_name . '</a>: ' . $post->title;
					} else {
					echo '<a href="/blog/' . $post->id . '">' . $post->title . '</a>';
						}
						?></h3>	
	
			<?php if (!empty($post->date)) : ?>
                    <div class="date">
					  <?php echo $post->date ?>
					</div>
                <?php endif; ?>	    
            <div class="description"><?php if ($post->id == 728) echo Text::recorta($post->text, 400); else echo Text::recorta($post->text, 600); ?></div>
			<div class="read_m">
				<a href="<?php echo ($post->owner_type == 'project') ? '/project/'.$post->owner_id.'/updates/'.$post->id : '/blog/'.$post->id; ?>">En savoir d'avantage</a>
			</div>		
</div></div>

<?php endif; ?>
<?php $i++; endforeach; ?>

</div></div></div>






