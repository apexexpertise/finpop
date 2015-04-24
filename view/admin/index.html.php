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

use Goteo\Library\Text,
    Goteo\Core\View,
    Goteo\Core\ACL,
    Goteo\Library\Feed,

    Goteo\Controller\Admin;
if (!isset($_SESSION['admin_menu'])) {
    $_SESSION['admin_menu'] = Admin::menu();
}

$bodyClass = 'admin';

// funcionalidades con autocomplete
$jsreq_autocomplete = $this['autocomplete'];


include 'view/prologue.html.php';
include 'view/header.html.php'; 
?>



<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>

<div class="container"  style="margin-left: 0px;width:100%;">
	<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-3 text-center leftspan" id="one" style="padding:0px;height:51px;width:25%;background-image: url('/view/css/admin/layer.png');"></div>
        <div class="col-xs-6 col-sm-6 col-md-3 leftspan" id="two" style="padding:0px;height:51px;width:75%;background-image: url('/view/css/admin/layer.png');">
		<ul class="bc">
          <li> <img  src="/view/css/admin/home.png" height="23px" width="19px" style="padding-bottom:7px;padding-top:0px;"/>  </li>
          <?php echo ADMIN_BCPATH; ?>
          </ul>
		</div>
	</div>
	<div class="row">

		<div class="col-md-3 column" style=" width:25%;padding-left: 0px;padding-right: 0px;">
		
               
                <div class="panel-group" id="panel-623058" style="margin-bottom:0px;">
				<div class="panel panel-default" >
				 <?php $i =  0;  ?>
				 <?php foreach ($_SESSION['admin_menu'] as $sCode=>$section) : ?>
					<div class="panel-heading" style="background-color: #85909d;height:40px;border-radius: 0px;" >
					
					  <?php $i = $i + 1;  ?>
					  <img  src="/view/css/admin/<?php echo $i ?>.png"/> &nbsp;
						 <a class="panel-title  collapsed" style="text-decoration:none;float:center;font-size:18px;font-family:Myriad Pro,Regular;color:white" data-toggle="collapse" data-parent="#panel-623058" href="#panel-element-779446<?php echo $i ?>"> <?php echo $section['label'] ?>
						<span style="float:right;" class="fa fa-angle-down"></span>
						 <span style="float:right;" class="fa fa-angle-right"></span>
						 
						  
						
    					</a>
					</div>
					<div id="panel-element-779446<?php echo $i ?>" class="panel-collapse collapse">
						<div id="collapseOne" class="panel-body" style="background-color:#f6f6f6;padding: 0px;border-right:1px solid #c8c7cc;">
							<?php
																
																foreach ( $section ['options'] as $oCode => $option ) :
																	echo '<div class="item"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 		<a href="/admin/' . $oCode . '" style="font-size:18px;font-family:Myriad Pro,Regular;" >' . $option ['label'] . '</a></div>';
																endforeach
																;
																?>
						</div>
						
					</div>
					<?php endforeach; ?> 
				</div>
				
            </div>
            </div>
            
            <?php if (isset($_SESSION['user']->roles['superadmin'])) : ?>
            <div class="col-md-6 column" style="padding-left: 0px;padding-right: 0px;">
            
           
         
            <ul class="nav nav-pills">
				
					<li><a href="/admin/projects"><strong><?php echo Text::_("Proyectos"); ?></strong></a></li>
					<li><a href="/admin/users"><strong><?php echo Text::_("Usuarios"); ?></strong></a></li>
					<li><a href="/admin/accounts"><strong><?php echo Text::_("Aportes"); ?></strong></a></li>
					<li><a href="/admin/texts"><strong><?php echo Text::_("Textos"); ?></strong></a></li>
					<li><a href="/admin/tasks"><strong><?php echo Text::_("Tareas"); ?></strong></a></li>
					<li><a href="/admin/newsletter"><strong><?php echo Text::_("Mailings"); ?></strong></a></li>
				</ul>
			
            <?php endif; ?>


<?php if (!empty($this['folder']) && !empty($this['file'])) : 
        if ($this['folder'] == 'base') {
            $path = 'view/admin/'.$this['file'].'.html.php';
        } else {
            $path = 'view/admin/'.$this['folder'].'/'.$this['file'].'.html.php';
        }

            echo new View ($path, $this);
       else :
           
            /* PORTADA ADMIN */
            $node = isset($_SESSION['admin_node']) ? $_SESSION['admin_node'] : \GOTEO_NODE;

            $feed = empty($_GET['feed']) ? 'all' : $_GET['feed'];
    $items = Feed::getAll($feed, 'admin', 50);

        // Central pendientes
    ?>
       
				<h3 class="text-center text-primary"><?php echo Text::_("LISTE DE CHOSES &Agrave; FAIRE"); ?></h3>
            <?php if (!empty($this['tasks'])) : ?>
            <table class="table table-striped table-hover ">
                <?php foreach ($this['tasks'] as $task) : ?>
                <tr class="info">
						<td><?php if (!empty($task->url)) { echo ' <a href="'.$task->url.'">[IR]</a>';} ?></td>
						<td><?php echo $task->text; ?></td>
					</tr>
                <?php endforeach; ?>
            </table>
            <br/>
             <br/>
            <?php else : ?>
            
             <p class="text-primary" style="text-align:center;"><small> <?php echo Text::_("No tienes tareas pendientes"); ?></small></p>
           <?php endif; ?>
       
   
    </div>
            <div class="col-md-3 column" >
    <?php
        // Lateral de acctividad reciente
    ?>
            <div class="admin-side">
                <a name="feed"></a>
                <div class="widget feed">
					<script type="text/javascript">
                    jQuery(document).ready(function($) {
                        $('.scroll-pane').jScrollPane({showArrows: true});

                        $('.hov').hover(
                          function () {
                            $(this).addClass($(this).attr('rel'));
                          },
                          function () {
                            $(this).removeClass($(this).attr('rel'));
                          }
                        );

                    });
                    </script>
                    <h3><?php echo Text::_("actividad reciente"); ?></h3>
                    <?php echo Text::_("Ver Feeds por:"); ?>

                    <p class="categories">
                        <?php foreach (Feed::_admin_types() as $id=>$cat) : ?>
                        <a href="/admin/recent/?feed=<?php echo $id ?>#feed" <?php echo ($feed == $id) ? 'class="'.$cat['color'].'"': 'class="hov" rel="'.$cat['color'].'"' ?>><?php echo $cat['label'] ?></a>
                        <?php endforeach; ?>
                    </p>

                    <div class="scroll-pane">
                        <?php foreach ($items as $item) :
                            $odd = !$odd ? true : false;
                            ?>
                        <div class="subitem<?php if ($odd) echo ' odd';?>">
                           <span class="datepub"><?php echo Text::get('feed-timeago', $item->timeago); ?></span>
                           <div class="content-pub"><?php echo $item->html; ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <a href="/admin/recent/<?php echo isset($_GET['feed']) ? '?feed='.$_GET['feed'] : ''; ?>" style="margin-top:10px;float:right;text-transform:uppercase">Ver más</a>
                   
                    </div>
                </div>
            </div>


        <?php endif; ?>

            </div>
            <div class="row">
		<div class="col-md-12 column">
		
<?php
    include 'view/footer.html.php';
include 'view/epilogue.html.php'; 
?>
		</div>
		</div>
            
            </div>
	

