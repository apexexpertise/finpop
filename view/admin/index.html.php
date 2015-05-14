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


?>


	<?php
	use Goteo\Library\Text,
	Goteo\Core\View,
	Goteo\Core\ACL,
	Goteo\Library\Feed,
	
	Goteo\Controller\Admin;
	if (!isset($_SESSION['admin_menu'])) {
		$_SESSION['admin_menu'] = Admin::menu();
	}
	$path=array_pop(explode("/", $_SERVER[REQUEST_URI]));
	$bodyClass = 'admin';
	
	// funcionalidades con autocomplete
	$jsreq_autocomplete = $this['autocomplete'];
	
	
	include 'view/prologue.html.php';
	include 'view/header.html.php'; ?>
<div class="container" style="width: 100%;">
	<div class="row" style="position: fixed; width:100%;z-index: 100;margin-top: 110px;">

		<div class="col-md-2 column " style="padding:0px;height:51px;background-image: url('/view/css/admin/layer.png');"></div>
		<div class="col-md-10 column" style="padding:0px;height:51px;background-image: url('/view/css/admin/layer.png');">
					<ul class="bc">
          <li> <img  src="/view/css/admin/home.png" height="23px" width="19px" style="padding-bottom:5px;padding-top:0px;"/>  </li>
          <?php echo ADMIN_BCPATH; ?>
          </ul>
		</div>
	</div>
	<div class="row">

		<div class="col-md-2 column" style="position:fixed;top:161px;padding-left: 0px;padding-right: 0px;height:100%;  z-index: 1000;background: rgb(133, 144, 157);">
		
            
                <div class="panel-group" id="panel-623058" style="margin-bottom:0px;">
				<div class="panel panel-default" style=" box-shadow: none !important; border: none !important;">
				 <?php $i =  0;  ?>
				 <?php foreach ($_SESSION['admin_menu'] as $sCode=>$section) : ?>
					<div class="panel-heading"  style="background-color: #85909d;height:40px;border-radius: 0px;" >
					
					  <?php $i = $i + 1; $panel=0; ?>
					 
					  <img  src="/view/css/admin/<?php echo $i ?>.png"/> &nbsp;
						 <a id="<?php echo $i ?>" class="panel-title  collapsed" style="text-decoration:none;float:center;font-size:18px;font-family:Myriad Pro Regular;color:white" data-toggle="collapse" data-parent="#panel-623058" href="#panel-element-779446<?php echo $i ?>"> <?php echo $section['label'] ?>
						<span style="float:right;" class="fa fa-angle-down"></span>
						 <span style="float:right;" class="fa fa-angle-right"></span>						
    					</a> 					
					</div>
					<div id="panel-element-779446<?php echo $i ?>" class="panel-collapse collapse">
						<div id="collapseOne" class="panel-body" style="background-color:#f6f6f6;padding: 0px;">
							<?php
																
																foreach ( $section ['options'] as $oCode => $option ) :
																$class="item";
																if($oCode==$path){$class="item active";$panel=$i;}
																	echo '<div class="'.$class.'">
 		<a href="/admin/' . $oCode . '" style="font-size:18px;font-family:Myriad Pro Condensed">' . $option ['label'] . '</a></div>';
																endforeach
																;
																?>
						</div>
						
					</div>
					<script type="text/javascript">
								jQuery(document).ready(function($) {
							
									$("#<?php echo $panel;?> .fa-angle-down").trigger( "click" );
								});
					</script>  
					<?php endforeach; ?> 
				</div>
				
            </div>
           
            </div>
            <?php if (isset($_SESSION['user']->roles['superadmin'])) : ?>
            <div class="col-md-10 column" id="main-panel" style="padding-bottom: 100px;height: 80%;overflow: scroll;position: fixed;right: 0;  top: 177px;">
            <?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>
           <div class="row">
				<div class="col-md-12 column" style="padding:0px;">
				
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
       <div class="title-admin">
			<p><?php echo Text::_("Liste des t&acirc;ches &agrave; faire"); ?>
			</p>
		<hr/>
		</div>
		 </div>
    </div>
    <div class="row">
    <div class="col-md-8 column">
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
            
             <p class="text-info" style="text-align:center;margin-top:15px;"><strong> <?php echo Text::_("No tienes tareas pendientes"); ?></strong></p>
           <?php endif; ?>
       
   
   
    </div>
				<div class="col-md-4 column">
				
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
                    	<h3 class="dark-grey" style="margin-top:0px;"><?php echo Text::_("actividad reciente"); ?></h3>
                  <p class="text-info" style="margin-top:40px;">  Voir RSS par: 
                        <?php foreach (Feed::_admin_types() as $id=>$cat) : ?>
                        <a href="/admin/recent/?feed=<?php echo $id ?>#feed" <?php echo ($feed == $id) ? 'class="'.$cat['color'].'"': 'class="hov" rel="'.$cat['color'].'"' ?>><?php echo $cat['label'] ?></a>
                        <?php endforeach; ?>
                    </p>

                   <div class="scroll-pane" style="width:500px;">
            <?php foreach ($items as $item) :
                $odd = !$odd ? true : false;
                ?>
                <div class="well">  
                <blockquote>
                  <div class="content-pub" style="  width: 300px;"><?php echo $item->html; ?></div>    
 <span class="datepub"><small><?php echo Text::get('feed-timeago', $item->timeago); ?></small></span>
             
</blockquote>        
                    
            </div>
                        <?php endforeach; ?>
                    </div>

                    <a href="/admin/recent/<?php echo isset($_GET['feed']) ? '?feed='.$_GET['feed'] : ''; ?>" style="margin-top:10px;float:right;text-transform:uppercase">Voir plus</a>
                   
                    </div>
                </div>
           
</div>
</div>
</div>
</div>

        <?php endif; ?>

            </div>
        
<?php

include 'view/epilogue.html.php'; 
?>

	

