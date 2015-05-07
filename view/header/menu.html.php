<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
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

 use Goteo\Core\ACL,
    Goteo\Library\Text;
?>
<?php 
	$current_page=array_pop(explode("/", $_SERVER['REQUEST_URI']));
	if($current_page==""):
?>
<script text="javascript">
	var lastScrollTop = 0;
	var i = 0.7;
	var pathname = window.location.pathname;
	if(pathname=="/"){
		$(window).scroll(function(event){
		   var st = $(this).scrollTop();
		   if (st > lastScrollTop){
		       // downscroll code
		       if(i<1){
			       i=i+0.05;
		       		$("#header").css('background','rgba(255, 255, 255, '+i+')');	       		
		       }
		       if(st>800)
	      		{
	      			$("#header").css('box-shadow','3px 3px 4px rgb(234, 234, 234)');
	      		}
		   }else{
		      // upscroll code
			   if(i>=0.7){
				   i=i-0.05;
				   $("#header").css('background','rgba(255, 255, 255, '+i+')');	       		
				}
			   if(st<800)
	      		{
	      			$("#header").css('box-shadow','');
	      		}
			   
		   }
		   lastScrollTop = st;
		});
	}
	else{
		$("#header").css('position','relative');
	}


</script>
    <div id="menu">     
        <ul>
            <li class="home"><a href="/"><?php echo Text::get('regular-home'); ?></a></li>
            <li class="explore"><a class="" href="/discover"><?php echo Text::get('regular-discover'); ?></a></li>
            <li class="create"><a class="" href="/project/create"><?php echo Text::get('regular-create'); ?></a></li>
            <?php if (!empty($_SESSION['user'])): ?>
            <li class="community"><a href="/community"><span><?php echo Text::get('Fonctionnement'); ?></span></a>
                <div>
                    <ul>
                        <li><a href="/community/activity"><span><?php echo Text::get('Comment &#231;a marche'); ?></span></a></li>
                        <li><a href="/community/sharemates"><span><?php echo Text::get('FAQ'); ?></span></a></li>
                    </ul>
                </div>
            </li>
            <?php else: ?>
            <li class="create">
                <a href="/community"><span><?php echo Text::get('Fonctionnement'); ?></span></a>
            </li>
            <?php endif ?>

            <?php if (!empty($_SESSION['user'])): ?>            
            <li class="dashboard"><a href="/dashboard"><span><?php echo Text::get('dashboard-menu-main'); ?></span><img src="<?php echo $_SESSION['user']->avatar->getLink(28, 28, true); ?>" class="img-circle"/></a>
                <div>
                    <ul>
                        <li><a href="/dashboard/activity"><span><?php echo Text::get('dashboard-menu-activity'); ?></span></a></li>
                        <li><a href="/dashboard/profile"><span><?php echo Text::get('dashboard-menu-profile'); ?></span></a></li>
                        <li><a href="/dashboard/projects"><span><?php echo Text::get('dashboard-menu-projects'); ?></span></a></li>
                        <?php if (ACL::check('/translate')) : ?>
                        <li><a href="/translate"><span><?php echo Text::get('regular-translate_board'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if (ACL::check('/review')) : ?>
                        <li><a href="/review"><span><?php echo Text::get('regular-review_board'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if (ACL::check('/admin')) : ?>
                        <li><a href="/admin"><span><?php echo Text::get('regular-admin_board'); ?></span></a></li>
                        <?php endif; ?>
                        <li class="logout"><a href="/user/logout"><span><?php echo Text::get('regular-logout'); ?></span></a></li>
                    </ul>
                </div>
            </li>            
            <?php else: ?>            
            <li class="connexion">
                <a href="#">Inscription</a>
                <a href="/user/login"><?php echo Text::get('Connexion'); ?></a>
            </li>
            
            <?php endif ?>
        </ul>	       
    </div>
 <?php else :?>  
 
 
 <div id="menu-no-home"> 
 
 <div class="navbar navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="/view/css/images/top_logo.png"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
           <li><a class="" href="/discover">VOIR LES PROJETS</a></li>
            <li><a class="" href="/project/create">CREER UN PROJET</a></li>
             <li><a href="/community">FONCTIONNEMENT</a>
           
             
             </li>

            <li><a href="#" style="margin-left:120px">INSCRIPTION</a></li>
            <li><a href="/user/login">CONNEXION</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
 </div>
 
  
 
 
 
 <?php endif?>
   