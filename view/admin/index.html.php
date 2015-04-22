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

		<div class="col-md-3 column" style=" width:239px;padding-left: 0px;padding-right: 0px;">
		
                <img  src="/view/css/admin/grey.png" height="51px" width="240px"/>
                <div class="panel-group" id="panel-623058" style="width:240px;">
				<div class="panel panel-default" >
				 <?php $i =  0;  ?>
				 <?php foreach ($_SESSION['admin_menu'] as $sCode=>$section) : ?>
					<div class="panel-heading" style="background-color: #85909d;height:40px;" >
					
					  <?php $i = $i + 1;  ?>
						 <a class="panel-title collapsed" style="font-size:16px;font-family:Myriad Pro,Regular;color:white" data-toggle="collapse" data-parent="#panel-623058" href="#panel-element-779446<?php echo $i ?>"><img  src="/view/css/admin/<?php echo $i ?>.png"/> &nbsp;&nbsp;&nbsp; <?php echo $section['label'] ?>
						
						 <span style="float:right;" class="fa fa-angle-right"></span>
						 <span style="float:right;" class="fa fa-angle-down"></span>
						  
						
    					</a>
					</div>
					<div id="panel-element-779446<?php echo $i ?>" class="panel-collapse in">
						<div class="panel-body" style="background-color:#f6f6f6;width:240px;padding: 0px;border-right:1px solid #c8c7cc;">
							<?php
																
																foreach ( $section ['options'] as $oCode => $option ) :
																	echo '<div class="item"><center><a href="/admin/' . $oCode . '" style="font-size:16px;font-family:Myriad Pro,Regular;" >' . $option ['label'] . '</a> </center> </div>';
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
            
           
          <ul class="bc">
          <li> <img  src="/view/css/admin/home.png" height="17px" width="18px"/>  </li>
          <?php echo ADMIN_BCPATH; ?>
          </ul>
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
       
    <?php
        // Lateral de acctividad reciente
    ?>
    </div>
            <div class="col-md-3 column" >
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
					<h3 class="text-center text-primary"><?php echo Text::_("actividad reciente"); ?></h3>
                   <p class="text-muted"> <strong><?php echo Text::_("Voir Activit&eacute;s par:"); ?>
					</strong></p>
                    <p class="text-primary"><small>
                        <?php foreach (Feed::_admin_types() as $id=>$cat) : ?>
                        <a
							href="/admin/recent/?feed=<?php echo $id ?>#feed"
							<?php echo ($feed == $id) ? 'class="'.$cat['color'].'"': 'class="hov" rel="'.$cat['color'].'"' ?>><?php echo $cat['label'] ?></a>
                        <?php endforeach; ?>
                        </small>
                    </p>

					
					<!-- fin center -->
                        <?php foreach ($items as $item) :
                            $odd = !$odd ? true : false;
                            ?>
                         <blockquote>
    <p><?php echo $item->html; ?></p>
    <small><?php echo Text::get('feed-timeago', $item->timeago); ?> </small>
</blockquote>
                        <?php endforeach; ?>
                        
                    

					<a
						href="/admin/recent/<?php echo isset($_GET['feed']) ? '?feed='.$_GET['feed'] : ''; ?>"
						style="margin-top: 10px; float: right; text-transform: uppercase">Voir
						plus</a>
<!-- fin center -->
					
						
				</div>
			</div>


        <?php endif; ?>

            </div>
            
            </div>
		<!-- fin center -->

	
	<!-- fin main -->

<?php
    include 'view/footer.html.php';
include 'view/epilogue.html.php';
